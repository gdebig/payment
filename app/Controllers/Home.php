<?php

namespace App\Controllers;

use App\Models\PaymentModel;

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

    public function dopayment()
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
                'paper_authors' => [
                    'label' => 'Paper Authors',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Paper Author must be filled',
                    ],
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
                $paper_authors = $this->request->getVar('paper_authors');
                $payment_type = $this->request->getVar('payment_type');

                $model = new PaymentModel();

                $data = array(
                    'paper_id' => $paper_id,
                    'paper_authors' => $paper_authors,
                    'payment_type' => $payment_type,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($data);

                $session->setFlashdata('msg', 'Payment is success.');

                return redirect()->to('/');
            } else {
                $data['title'] = "ICNERE - FTS IC Payment Page";
                $data['pagetitle'] = 'Payment Form';
                $data['validation'] = $this->validator;
                return view('formpaymentvalid', $data);
            }
        }
    }

    public function success()
    {
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Success';
        return view('mainpage', $data);
    }

    public function failed()
    {
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Failed';
        return view('mainpage', $data);
    }

    public function callback()
    {
        $data['title'] = "ICNERE - FTS IC Payment Page";
        $data['pagetitle'] = 'Payment Callback';
        return view('mainpage', $data);
    }
}
