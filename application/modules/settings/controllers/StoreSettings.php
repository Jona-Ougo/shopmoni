<?php namespace GoCart\Controller;
/**
 * Storesettings Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    AdminSettings
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class StoreSettings extends Admin { 

    public function __construct()
    {
        parent::__construct();

        \CI::auth()->check_access('Admin', true);
        \CI::load()->model(['Messages', 'Pages', 'Locations']);
        \CI::lang()->load('settings');
        \CI::load()->helper('inflector');
    }

    public function index()
    {
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        //set defaults
        $data = [
            'company_name' => '',
            'firstname'=>'',
            'lastname'=>'',
            'email'=>'',
            'country_id' => '',
            'city' => '',
            'address1' => '',
            'address2' => '',
            'zone_id' => '',
            'zip' => '',


            'ssl_support' => '',
            'require_login' => '',
            'new_customer_status' => '1',

            'weight_unit' => 'LB',
            'dimension_unit' => 'IN',
            'order_status' => '',
            'inventory_enabled' => '',
            'allow_os_purchase' => '',
            'tax_address' => '',
            'tax_shipping' => ''
        ];

        \CI::form_validation()->set_rules('company_name', 'lang:company_name', 'required');


        \CI::form_validation()->set_rules('country_id', 'lang:country');
        \CI::form_validation()->set_rules('address1', 'lang:address');
        \CI::form_validation()->set_rules('address2', 'lang:address');
        \CI::form_validation()->set_rules('zone_id', 'lang:state');
        \CI::form_validation()->set_rules('zip', 'lang:zip');


        \CI::form_validation()->set_rules('ssl_support', 'lang:ssl_support');
        \CI::form_validation()->set_rules('stage', 'lang:stage');
        \CI::form_validation()->set_rules('require_login', 'lang:require_login');
        \CI::form_validation()->set_rules('new_customer_status', 'lang:new_customer_status');

        \CI::form_validation()->set_rules('weight_unit', 'lang:weight_unit');
        \CI::form_validation()->set_rules('order_status', 'lang:order_status');
        \CI::form_validation()->set_rules('inventory_enabled', 'lang:inventory_enabled');
        \CI::form_validation()->set_rules('allow_os_purchase', 'lang:allow_os_purchase');
        \CI::form_validation()->set_rules('tax_address', 'lang:tax_address');
        \CI::form_validation()->set_rules('tax_shipping', 'lang:tax_shipping');

        // get the values from the DB
        $data = array_merge( $data, \CI::Settings()->get_settings('gocart'));

        $data['config'] = $data;
        //break out order statuses to an array

        
        
        

        $data['countries_menu'] = \CI::Locations()->get_countries_menu();
        if(!empty($data['country_id']))
        {
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($data['country_id']);
        }
        else
        {
            $countries_menu = array_keys($data['countries_menu']);
            $data['zones_menu'] = \CI::Locations()->get_zones_menu(array_shift($countries_menu));
        }

        $data['page_title'] = lang('common_gocart_configuration');

        $pages = \CI::Pages()->get_pages_tiered();
        $data['pages'] = [];
        foreach($pages['all'] as $page)
        {
            if(empty($page->url))
            {
                $data['pages'][$page->id] = $page->title;
            }
        }


        if (\CI::form_validation()->run() == FALSE)
        {
            $data['error'] = validation_errors();
            $this->view('settings', $data);
        }
        else
        {
            \CI::session()->set_flashdata('message', lang('config_updated_message'));

            $save = \CI::input()->post();
            //fix boolean values
            $save['ssl_support'] = (bool)\CI::input()->post('ssl_support');
            $save['require_login'] = (bool)\CI::input()->post('require_login');
            $save['new_customer_status'] = \CI::input()->post('new_customer_status');
            $save['allow_os_purchase'] = (bool)\CI::input()->post('allow_os_purchase');
            $save['tax_shipping'] = (bool)\CI::input()->post('tax_shipping');

            \CI::Settings()->save_settings('gocart', $save);

            redirect('admin/settings');
        }

    }

    public function canned_messages()
    {
        $data['canned_messages'] = \CI::Messages()->get_list();
        $data['page_title'] = lang('common_canned_messages');
        $this->view('canned_messages', $data);
    }


    public function canned_message_form($id=false)
    {
        $data['page_title'] = lang('canned_message_form');

        $data['id'] = $id;
        $data['name'] = '';
        $data['subject'] = '';
        $data['content'] = '';
        $data['deletable'] = 1;

        if($id)
        {
            $message = \CI::Messages()->get_message($id);
            $data = array_merge($data, $message);
        }

        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        \CI::form_validation()->set_rules('name', 'lang:message_name', 'trim|required|max_length[50]');
        \CI::form_validation()->set_rules('subject', 'lang:subject', 'trim|required|max_length[100]');
        \CI::form_validation()->set_rules('content', 'lang:message_content', 'trim|required');

        if (\CI::form_validation()->run() == FALSE)
        {
            $data['errors'] = validation_errors();

            $this->view('canned_message_form', $data);
        }
        else
        {

            $save['id'] = $id;
            $save['name'] = \CI::input()->post('name');
            $save['subject'] = \CI::input()->post('subject');
            $save['content'] = \CI::input()->post('content');

            //all created messages are typed to order so admins can send them from the view order page.
            if($data['deletable'])
            {
                $save['type'] = 'order';
            }
            \CI::Messages()->save_message($save);

            \CI::session()->set_flashdata('message', lang('message_saved_message'));
            redirect('admin/settings/canned_messages');
        }
    }

    public function delete_message($id)
    {
        \CI::Messages()->delete_message($id);

        \CI::session()->set_flashdata('message', lang('message_deleted_message'));
        redirect('admin/settings/canned_messages');
    }
}
