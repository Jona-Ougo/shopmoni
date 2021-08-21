<?php namespace GoCart\Controller;
/**
 * ZeusDashboard Class
 *
 * @package     Zeus
 * @subpackage  Controllers
 * @category    AdminDashboard
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class ZeusDashboard extends Zeus {

    public function __construct()
    {
        parent::__construct();
        \CI::load()->model('Orders');
        \CI::load()->helper('date');
        \CI::lang()->load('dashboard');
    }

    public function index()
    {
        //check to see if shipping and payment modules are installed
        $info['payment_module_installed'] 	= (bool)count(\CI::Settings()->get_settings('payment_modules'));
        $info['shipping_module_installed'] 	= (bool)count(\CI::Settings()->get_settings('shipping_modules'));

        $info['page_title'] =  lang('dashboard');

        // get 5 latest orders
        $info['orders'] 			= \CI::Orders()->getOrders(false, 'ordered_on' , 'DESC', 5);
        //$data['shopOrdersCount']    = $this->shopOrdersCount();

        // get 5 latest customers
        $info['customers'] = \CI::Customers()->get_merchants(5);

        $info['activeshops']        = \DB\DB::numRows('customers', ['active'=>1, 'use_shop'=>1, 'is_guest'=>0]);
        $info['customerscount']     = \DB\DB::numRows('customers', ['active'=>1, 'use_shop'=>0, 'is_guest'=>0]);
        $info['productscount']      = \DB\DB::numRows('products');
        $info['couponscount']       = 0;

        $this->view('dashboard/index', $info);
    }

    public function loginAudit()
    {
        

        $data['audit']          = \DB\DB::get('admin_login_audit', [], 'created_at', 'desc', 100);
        $data['page_title']     = 'Admin Login Audit';
        
        $this->view('dashboard/admin_login_audit', $data);
    }
}
