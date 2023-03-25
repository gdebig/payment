<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use CodeIgniter\Session\Session;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Page';
        return view('mainpage', $data);
    }

    public function formpayment($type = false)
    {
        if (!$type) {
            $data['typepayment'] = '';
        } else {
            $data['typepayment'] = $type;
        }
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Form';
        return view('formpayment', $data);
    }

    public function rekappayment()
    {
        $session = session();
        $button = $this->request->getVar('submit');
        if ($button == "Cancel") {
            return redirect()->to('/');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'paper_id' => [
                    'label' => 'Paper ID',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Paper ID must be filled',
                    ],
                ],
                'paper_title' => [
                    'label' => 'Paper Title',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Paper Title must be filled',
                    ],
                ],
                'paper_authors' => [
                    'label' => 'Paper Authors',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Paper Author must be filled',
                    ],
                ],
                'paper_firstname' => [
                    'label' => 'Firstname',
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Field Firstname must be filled",
                    ],
                ],
                'paper_lastname' => [
                    'label' => 'Lastname',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Lastname must be filled',
                    ],
                ],
                'payment_email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Field Email must be filled',
                        'valid_email' => 'Field Email must be valid'
                    ]
                ],
                'payment_phone' => [
                    'label' => 'Phone Number',
                    'rules' => 'required|min_length[9]',
                    'errors' => [
                        'required' => 'Field Phone Number must be filled',
                        'min_length' => 'Field Phone Number minimum 9 digits'
                    ]
                ],
                'payment_type' => [
                    'label' => 'Type Payment',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Type Payment must be filled',
                    ],
                ]
            ]);

            if ($formvalid) {

                $paper_id = $this->request->getVar('paper_id');
                $paper_title = $this->request->getVar('paper_title');
                $paper_authors = $this->request->getVar('paper_authors');
                $paper_firstname = $this->request->getVar('paper_firstname');
                $paper_lastname = $this->request->getVar('paper_lastname');
                $payment_email = $this->request->getVar('payment_email');
                $payment_phone = $this->request->getVar('payment_phone');
                $payment_type = $this->request->getVar('payment_type');
                $payment_type_string = implode(",", $payment_type);

                $model = new PaymentModel();

                $data = array(
                    'paper_id' => $paper_id,
                    'paper_title' => $paper_title,
                    'paper_authors' => $paper_authors,
                    'paper_firstname' => $paper_firstname,
                    'paper_lastname' => $paper_lastname,
                    'payment_email' => $payment_email,
                    'payment_phone' => $payment_phone,
                    'payment_type' => $payment_type_string,
                    'payment_status' => "Not Yet Paid",
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($data);

                $session->setFlashdata('msg', 'Payment is proceed.');

                $payment_id = $model->getInsertID();

                return redirect()->to('/rekappage/' . $payment_id);
            } else {
                $data['title'] = "ICNERE - FTS IC Payment Page";
                $data['pagetitle'] = 'Payment Form';
                $data['validation'] = $this->validator;
                return view('formpaymentvalid', $data);
            }
        }
    }

    public function rekappage($payment_id)
    {
        $session = session();
        $model = new PaymentModel();
        $payment = $model->where('payment_id', $payment_id)->first();

        if ($payment) {
            $data = [
                'payment_id' => $payment['payment_id'],
                'paper_id' => $payment['paper_id'],
                'paper_title' => $payment['paper_title'],
                'paper_authors' => $payment['paper_authors'],
                'paper_firstname' => $payment['paper_firstname'],
                'paper_lastname' => $payment['paper_lastname'],
                'payment_email' => $payment['payment_email'],
                'payment_phone' => $payment['payment_phone'],
                'payment_type' => $payment['payment_type'],
                'date_created' => $payment['date_created']
            ];
        } else {
            $data['kosong'] = "kosong";
        }
        $data['title'] = "ICNERE - FTS IC Rekap Payment";
        $data['pagetitle'] = 'Rekap Payment Information';
        return view('rekappayment', $data);
    }

    public function dopayment($id)
    {
        $model = new PaymentModel();
        $payment = $model->where('payment_id', $id)->first();

        $payment_string = explode(",", $payment['payment_type']);
        $total = 0;
        foreach ($payment_string as $type) {
            switch ($type) {
                case "earlyRegIEEE":
                    $total = $total + 3500000;
                    break;
                case "earlyRegNonIEEE":
                    $total = $total + 4000000;
                    break;
                case "earlyStudentIEEE":
                    $total = $total + 2000000;
                    break;
                case "earlyStudentNonIEEE":
                    $total = $total + 2500000;
                    break;
                case "lateRegIEEE":
                    $total = $total + 4000000;
                    break;
                case "lateRegNonIEEE":
                    $total = $total + 4500000;
                    break;
                case "lateStudentIEEE":
                    $total = $total + 2500000;
                    break;
                case "lateStudentNonIEEE":
                    $total = $total + 3000000;
                    break;
                case "NonAuthor":
                    $total = $total + 1500000;
                    break;
                case "SocialTour":
                    $total = $total + 2500000;
                    break;
            }
        }

        //Info Ottopay
        $APIkey = "14OIOYA1490AA034339O03A0K9Y0PI01";
        $MerchantID = base64_encode("OP1E00030948");
        $timestamp = strtotime($payment['date_created']);
        $totalpay = floatval($total);

        $body = array(
            'customerDetails' => array(
                'email' => $payment['payment_email'],
                'firstName' => $payment['paper_firstname'],
                'lastName' => $payment['paper_lastname'],
                'phone' => '02177655805'
            ),
            'expiryduration' => '720h',
            'transactionDetails' => array(
                'amount' => $totalpay,
                'currency' => 'IDR',
                'orderId' => "FTUI-ICNERE" . $id
            )
        );

        $jsonbody = json_encode($body);
        $trimbody = strtolower(str_replace(array('"', '@', '-', ' '), '', $jsonbody)) . '&' . $timestamp . '&' . $APIkey;

        $signature = hash_hmac('sha512', $trimbody, $APIkey);

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => "http://54.169.81.53:8955/payment-services/v2.1.0/api/token",
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
            echo "cURL Error : ", $err;
        } else {
            $resp = json_decode($response);
            print_r($resp);
            if (!empty($resp->responseData)) {
                return redirect()->to($resp->responseData->endpointUrl);
            } else {
                return redirect()->to('/failed');
            }
        }
    }

    public function cancelpayment($id)
    {
        $session = session();
        $model = new PaymentModel();
        $model->delete($id);

        $session->setFlashdata('err', 'Payment is cancelled by the user.');

        return redirect()->to('/');
    }

    public function success()
    {
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Success';

        return view('successpage', $data);
    }

    public function failed()
    {
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Failed';
        return view('failpage', $data);
    }

    public function callback()
    {
        $model = new PaymentModel();
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Callback';

        $post_data = json_decode(file_get_contents('php://input'), true);
        $resp = json_decode($post_data, true);

        $payment_id = trim($resp['trxRef'], "ICNERE-");

        $data = $model->where('payment_id', $payment_id)->first();
        if ($data) {
            $paper_firstname = $data['paper_firstname'];
            $paper_lastname = $data['paper_lastname'];
            $payment_email = $data['payment_email'];
        }

        $email = \Config\Services::email();
        $email->setTo($payment_email);
        $email->setBCC('icnere@eng.ui.ac.id');
        $email->setFrom('icnere@eng.ui.ac.id', 'ICNERE Committee');

        $email->setSubject("ICNERE 2023 Payment Status");

        $resp_code = $resp['responseCode'];

        if ($resp_code == "00") {
            $data = array(
                'payment_status' => "Paid",
                'date_modified' => date('Y-m-d H:i:s')
            );

            $message = "
            <p>Dear Prof/Mr/Mrs " . $paper_firstname . " " . $paper_lastname . "</p>
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
        } else {
            $data = array(
                'payment_status' => "Fail",
                'date_modified' => date('Y-m-d H:i:s')
            );
            $message = "
            <p>Dear Prof/Mr/Mrs " . $paper_firstname . " " . $paper_lastname . "</p>
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
        }

        $model->where('payment_id', $payment_id);
        $model->update($data);
    }
}
