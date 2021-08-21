<?php namespace GoCart\Controller;

use DB\DB as DB;

class Banners extends Front {

    public function addadvert()
    {

        $config['upload_path']      = 'uploads';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['encrypt_name']     = true;
        \CI::load()->library('upload', $config);

        $customer = \CI::Login()->customer();

        \CI::load()->helper(array('form', 'date'));
        \CI::load()->library('form_validation');
        
        //set the default values

        \CI::form_validation()->set_rules('banner_collection_id', 'banner_collection_id', 'trim|required');
        \CI::form_validation()->set_rules('name', 'lang:name', 'trim|required|full_decode');
        \CI::form_validation()->set_rules('enable_date', 'lang:enable_date', 'trim');
        \CI::form_validation()->set_rules('disable_date', 'lang:disable_date', 'trim');
        \CI::form_validation()->set_rules('image', 'lang:image', 'trim');
        \CI::form_validation()->set_rules('link', 'lang:link', 'trim');

        if (\CI::form_validation()->run() == false) {
            echo json_encode([
                'status' => 'error',
                'message' => 'all fields are required'
            ]);
            exit;
        } else {

            $uploaded   = \CI::upload()->do_upload('image');
            
            $save['banner_collection_id'] = \CI::input()->post('banner_collection_id');
            $save['name'] = \CI::input()->post('name');
            $save['enable_date'] = \CI::input()->post('enable_date');
            $save['disable_date'] = \CI::input()->post('disable_date');
            $save['link'] = \CI::input()->post('link');
            $save['new_window'] = (bool)1;
            $save['admin_status'] = 'review';
            $save['customer_id'] = $customer->id;
            $save['sequence'] = 2;


            if(!$uploaded) {
                $data['error']  = \CI::upload()->display_errors();
                echo json_encode([
                    'status'=> 'error',
                    'message' => 'Error uploading advert image'
                ]);
                return; //end script here if there is an error
            } else {
                $image          = \CI::upload()->data();
                $save['image']  = $image['file_name'];
            }

            $response = \CI::Banners()->save_customer_banner($save, $customer->id);

            echo json_encode([
                'status'=> (!$response['status']) ? 'error': 'success' ,
                'message' => $response['message']
            ]);

        }
    }

}