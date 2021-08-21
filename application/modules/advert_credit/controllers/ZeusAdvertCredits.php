<?php

namespace GoCart\Controller;

use CI;

class ZeusAdvertCredits extends Zeus {

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'admin';
        \CI::load()->model('Advertcredit');
        \CI::lang()->load('advert_credit');

        _p('viewadvertcredits', true);
    }
    
    public function get_details()
    {
        return $this->details;
    }
    
    public function index()
    {
        $data['page_title'] = 'Advert Credits';
        
        $data['advert_credit'] = \CI::AdvertCredit()->advert_credits();

        $this->view('advert_credits', $data);
    }
    
    public function advert_credit_form()
    {
        $data['page_title'] = lang('add_advert_credit');
        
        CI::load()->library('form_validation');
        
        $data['value'] = '';
        $data['amount'] = '';

        CI::form_validation()->set_rules('value', 'Value', 'trim|required');
        CI::form_validation()->set_rules('amount', 'Amount', 'trim|required');
        
        if (CI::form_validation()->run()) {

            CI::load()->helper('string');
            $value  = CI::input()->post('value');
            $amount = CI::input()->post('amount');

            $creditValueExist = CI::AdvertCredit()->getTableValueByField('advert_credit', 'value', $value);

            if ($creditValueExist) {
                CI::session()->set_flashdara('error', lang('message_advert_credit_exist'));
            } else {

                CI::AdvertCredit()->add_advert_credit($value, $amount);

                CI::session()->set_flashdata('message', lang('message_advert_credit_saved'));
            }

            redirect('zeus/advert_credits');
        }

        $this->view('advert_credit_form', $data);
    }

    public function edit_advert_credit()
    {
        $data['page_title'] = lang('edit_advert_credit');

        CI::load()->library('form_validation');

        $data['value'] = '';
        $data['amount'] = '';
        $data['advert_credit_id'] = '';

        CI::form_validation()->set_rules('value', 'Value', 'trim|required');
        CI::form_validation()->set_rules('amount', 'Amount', 'trim|required');
        CI::form_validation()->set_rules('advert_credit_id', 'Advert Credit Id', 'trim|required');

        if (CI::form_validation()->run()) {

            CI::load()->helper('string');
            $value  = CI::input()->post('value');
            $amount = CI::input()->post('amount');
            $id     = CI::input()->post('advert_credit_id');

            $creditValueExist = CI::AdvertCredit()->getTableValueByField('advert_credit', 'value', $value);

            if ($creditValueExist) {
                echo json_encode([
                    'status' => "error",
                    'message' => lang('message_advert_credit_exist')
                ]);

                exit;
            }

            CI::AdvertCredit()->update_advert_credit($id, $value, $amount);

            echo json_encode([
                'status' => "success"
            ]);
        }
    }
    
    public function delete_advert_credit($advertCreditId)
    {
        $advert_credit  = \CI::AdvertCredit()->advert_credit($advertCreditId);

        if(!$advert_credit) {
            \CI::session()->set_flashdata('error', lang('advert_credit_not_found'));
        } else {
            \CI::AdvertCredit()->remove_advert_credit($advertCreditId);
            \CI::session()->set_flashdata('message', lang('message_delete_advert_credit'));
        }
        
        redirect('zeus/advert_credits');
    }
    

}