<?php namespace GoCart\Controller;
/**
 * AdminPayments Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    AdminPayments
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class AdminPayments extends Zeus {

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'admin';
    }

    public function index()
    {

        \CI::lang()->load('settings');
        \CI::load()->helper('inflector');
        
        global $paymentModules;

        $data['payment_modules'] = $paymentModules;
        $data['enabled_modules'] = \CI::Settings()->get_settings('payment_modules');

        $data['page_title'] = lang('common_payment_modules');
        $this->view('payment_index', $data);
    }
}