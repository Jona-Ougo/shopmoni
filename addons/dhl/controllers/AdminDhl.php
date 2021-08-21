<?php namespace GoCart\Controller;
/**
 * AdminDhl Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    AdminDhl
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class AdminDhl extends Admin { 

    public function __construct()
    {       
        parent::__construct();
        //\CI::auth()->check_access('Admin', true);
        \CI::lang()->load('dhl');
    }

    //back end installation functions
    public function install()
    {
        //set a default blank setting for flatrate shipping
        \CI::Settings()->save_settings('shipping_modules', ['Dhl'=>'1']);
        \CI::Settings()->save_settings('Dhl', ['enabled'=>'1', 'site_id'=>'', 'password' => '']);

        redirect('admin/shipping');
    }

    public function uninstall()
    {
        \CI::Settings()->delete_setting('shipping_modules', 'Dhl');
        \CI::Settings()->delete_settings('Dhl');
        redirect('admin/shipping');
    }
    
    //admin end form and check functions
    public function form()
    {
        //this same function processes the form
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        \CI::form_validation()->set_rules('enabled', 'lang:enabled', 'trim|numeric');
        \CI::form_validation()->set_rules('site_id', 'Site ID', 'trim');
        \CI::form_validation()->set_rules('password', 'Password', 'trim');

        if (\CI::form_validation()->run() == FALSE)
        {
            $settings = \CI::Settings()->get_settings('Dhl');

            $this->view('dhl_form', $settings);
        }
        else
        {
            
            \CI::Settings()->save_settings('Dhl', \CI::input()->post());
            redirect('admin/shipping');
        }
    }
}