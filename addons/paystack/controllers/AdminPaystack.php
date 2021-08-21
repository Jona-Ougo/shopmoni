<?php namespace GoCart\Controller;
/**
 * Admin Class
 *
 * @package   Paystack  GoCart
 * @subpackage  Controllers
 * @category    AdminPaystack
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class AdminPaystack extends Zeus {

    public function __construct()
    {       
        parent::__construct();

        $this->viewFolder = 'admin';

        \CI::lang()->load('paystack');

        _p('manageshippingmodules', true);
    }

    //back end installation functions
    public function install()
    {
        \CI::Settings()->save_settings('payment_modules', array('paystack'=>'1'));
        \CI::Settings()->save_settings('paystack', array('public_key' => '', 'gateway_url' => '', 'enabled'=>'1'));

        redirect('admin/payments');
    }

    public function uninstall()
    {
        \CI::Settings()->delete_setting('payment_modules', 'paystack');
        \CI::Settings()->delete_settings('paystack');
        redirect('admin/payments');
    }

    //admin end form and check functions
    public function form()
    {
        //this same function processes the form
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        \CI::form_validation()->set_rules('enabled', 'lang:enabled', 'trim|numeric');
        \CI::form_validation()->set_rules('public_key', 'Hash Key', 'trim');
        \CI::form_validation()->set_rules('gateway_url', 'Gateway URL', 'trim');

        if (\CI::form_validation()->run() == FALSE)
        {
            $settings = \CI::Settings()->get_settings('paystack');

            $enabled = $settings['enabled'];
            $public_key = isset($settings['public_key']) ? $settings['public_key'] : '';
            $gateway_callback_url = isset($settings['gateway_url']) ? $settings['gateway_url'] : '';

            $this->view('paystack_form', ['enabled'=>$enabled, 'public_key' => $public_key, 'gateway_url' => $gateway_callback_url]);
        }
        else
        {
            \CI::Settings()->save_settings('paystack', array('enabled'=>$_POST['enabled'], 'public_key' => $_POST['public_key'], 'gateway_url' => $_POST['gateway_url']));
            redirect('admin/payments');
        }
    }
}