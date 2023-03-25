<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\UserModel;
use CodeIgniter\Session\Session;

class Admin extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/');
        }

        $model = new PaymentModel();
        $data = $model->orderby('payment_id', 'DESC')->findall();
        if (!empty($data)) {
            $data['data_payment'] = $data;
        } else {
            $data['data_payment'] = "kosong";
        }

        $data['title'] = "ICNERE - FTS IC Administrator";
        $data['pagetitle'] = 'Admin Page';
        return view('adminpage', $data);
    }

    public function login()
    {
        $session = session();
        $logged_in = $session->get('logged_in');

        if ($logged_in) {
            return redirect()->to('/admin');
        }
        $data['title'] = "ICNERE - FTS IC Login Admin";
        $data['pagetitle'] = 'Login Form';
        return view('login', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function auth()
    {
        $submit = $this->request->getVar('submit');
        if ($submit == "cancel") {
            return redirect()->to('/');
        } else {
            helper(['form']);
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if ($this->validate($rules)) {
                $session = session();
                $model = new UserModel();
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $data = $model->where('username', $username)->first();
                if ($data) {
                    $pass = $data['password'];
                    $verify_pass = password_verify($password, $pass);
                    if ($verify_pass) {
                        $ses_data = [
                            'user_id' => $data['user_id'],
                            'username' => $data['username'],
                            'logged_in' => TRUE
                        ];
                        $session->set($ses_data);
                        return redirect()->to('/admin');
                    } else {
                        $session->setFlashdata('err', 'Wrong password');
                        return redirect()->to('/login');
                    }
                } else {
                    $session->setFlashdata('err', 'Username did not exist');
                    return redirect()->to('/login');
                }
            } else {
                $data['validation'] = $this->validator;
                $data['title'] = "ICNERE - FTS IC Login Admin";
                $data['pagetitle'] = 'Login Form';
                return view('login', $data);
            }
        }
    }

    public function verification()
    {
        $session = session();
        $model = new PaymentModel();

        //Info Ottopay
        $APIkey = "14OIOYA1490AA034339O03A0K9Y0PI01";
        $MerchantID = base64_encode("OP1E00030948");
        $timestamp = strtotime(date('Y-m-d H:i:s'));

        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/');
        } else {
            $data = $model->where('payment_status', 'Not Yet Paid')->findall();
            if (!empty($data)) {
                $i = 0;
                foreach ($data as $pay) :
                    $body = array(
                        "trxRef" => 'FTUI-ICNERE' . $pay['payment_id']
                    );

                    $jsonbody = json_encode($body);
                    $trimbody = strtolower(str_replace(array('"', '@', '-', ' '), '', $jsonbody)) . '&' . $timestamp . '&' . $APIkey;

                    $signature = hash_hmac('sha512', $trimbody, $APIkey);

                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => "http://54.169.81.53:8902/sp/service/v3.0.0/api/checkstatus",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => $jsonbody,
                        CURLOPT_HTTPHEADER => array(
                            "signature: " . $signature,
                            "Timestamp: " . $timestamp,
                            "Content-Type: application/json",
                            "Authorization: Basic " . $MerchantID,
                        ),
                    ));

                    $response = curl_exec($ch);
                    $err = curl_error($ch);

                    curl_close($ch);

                    if ($err) {
                        echo "cURL Error: ", $err;
                        echo "<br />";
                    } else {
                        $resp = json_decode($response);
                        $email = \Config\Services::email();
                        $email->setTo($pay['payment_email']);
                        $email->setBCC('icnere@eng.ui.ac.id');
                        $email->setFrom('icnere@eng.ui.ac.id', 'ICNERE Committee');

                        $email->setSubject("ICNERE 2023 Payment Status");

                        if ($resp->responseCode == "00") {
                            $i++;
                            $model->set('payment_status', 'Success');
                            $model->set('date_modified', date('Y-m-d H:i:s'));
                            $model->where('payment_id', $pay['payment_id']);
                            $model->update();

                            $message = "
                            <p>Dear Prof/Mr/Mrs " . $pay['paper_firstname'] . " " . $pay['paper_lastname'] . "</p>
                            <br />
                            <p>Thank you for you payment.</p>
                            <br />
                            Regards<br />
                            ICNERE 2023 Committee
                            ";
                            $email->setMessage($message);
                            if ($email->send()) {
                                echo 'Email successfully sent';
                            } else {
                                $data = $email->printDebugger(['headers']);
                                print_r($data);
                            }
                        } elseif ($resp->responseCode == "41") {
                            $model->set('payment_status', 'Transaction Expired');
                            $model->set('date_modified', date('Y-m-d H:i:s'));
                            $model->where('payment_id', $pay['payment_id']);
                            $model->update();

                            $message = "
                            <p>Dear Prof/Mr/Mrs " . $pay['paper_firstname'] . " " . $pay['paper_lastname'] . "</p>
                            <br />
                            <p>Your payment is expired. Please re-proceed the payment.</p>
                            <br />
                            Regards<br />
                            ICNERE 2023 Committee
                            ";
                            $email->setMessage($message);
                            if ($email->send()) {
                                echo 'Email successfully sent';
                            } else {
                                $data = $email->printDebugger(['headers']);
                                print_r($data);
                            }
                        } elseif ($resp->responseCode == "11") {
                            $model->set('payment_status', 'Transaction Fail');
                            $model->set('date_modified', date('Y-m-d H:i:s'));
                            $model->where('payment_id', $pay['payment_id']);
                            $model->update();
                            $message = "
                            <p>Dear Prof/Mr/Mrs " . $pay['paper_firstname'] . " " . $pay['paper_lastname'] . "</p>
                            <br />
                            <p>Your payment is failed. Please re-proceed the payment.</p>
                            <br />
                            Regards<br />
                            ICNERE 2023 Committee
                            ";
                            $email->setMessage($message);
                            if ($email->send()) {
                                echo 'Email successfully sent';
                            } else {
                                $data = $email->printDebugger(['headers']);
                                print_r($data);
                            }
                        } elseif ($resp->responseCode == "06") {
                            $model->set('payment_status', 'Timeout');
                            $model->set('date_modified', date('Y-m-d H:i:s'));
                            $model->where('payment_id', $pay['payment_id']);
                            $model->update();
                            $message = "
                            <p>Dear Prof/Mr/Mrs " . $pay['paper_firstname'] . " " . $pay['paper_lastname'] . "</p>
                            <br />
                            <p>Your payment is timeout. Please re-proceed the payment.</p>
                            <br />
                            Regards<br />
                            ICNERE 2023 Committee
                            ";
                            $email->setMessage($message);
                            if ($email->send()) {
                                echo 'Email successfully sent';
                            } else {
                                $data = $email->printDebugger(['headers']);
                                print_r($data);
                            }
                        }
                    }

                endforeach;

                $session->setFlashdata('msg', $i . ' payment has been succeed');
                return redirect()->to('/admin');
            } else {
                $session->setFlashdata('msg', 'There is no Not Yet Paid status');
                return redirect()->to('/admin');
            }
        }
    }
}
