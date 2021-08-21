<?php namespace GoCart\Controller;
/**
 * AdminDashboard Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    AdminDashboard
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class AdminDashboard extends Admin {

    public function __construct()
    {
        parent::__construct();

        \CI::load()->model('Orders');
        \CI::load()->model('Customers');
        \CI::load()->helper('date');
        \CI::lang()->load('dashboard');
        $this->customer = \CI::Login()->customer();
    }

    public function index()
    {
        $this->view('landing');
    }

    public function setup()
    {
        $this->view('setup');
    }
    
    public function dashboard()
    {
        //check to see if shipping and payment modules are installed
        $data['payment_module_installed'] = (bool)count(\CI::Settings()->get_settings('payment_modules'));
        $data['shipping_module_installed'] = (bool)count(\CI::Settings()->get_settings('shipping_modules'));

        $data['page_title'] =  lang('dashboard');

        // get 5 latest orders
        $data['orders'] = \CI::Orders()->getShopOrders(false, 'ordered_on' , 'DESC', 5);

        
        $data['shopOrdersCount']    = \CI::Orders()->getShopOrderCount();
        $data['myOrdersCount']      = \DB\DB::numRows('orders', ['customer_id'=>$this->customer->id, 'status !='=>'cart']);
        $data['customersCount']     = count(\CI::Customers()->getShopCustomers());
        $data['productsCount']      = \DB\DB::numRows('products', ['customer_id'=>$this->customer->id]);
        $data['customer']           = \DB\DB::getRow('customers_shop_information', ['customer_id'=>$this->customer->id]);

        // I dont want them to see boring welcome messages after just the first time.
        if(\CI::session()->userdata('reloaded_dashboard') == ''){
         if((int)$this->customer->first_time == 1){
            $data['welcome_message'] = $this->customer->firstname.', Welcome to your dashboard.';
            \DB\DB::update('customers', ['id'=>$this->customer->id], ['first_time'=>0]);
        }else{
            $data['welcome_message']    = $this->customer->firstname.', Welcome back';
        }

        $data['welcome_message'].= "<a href='{site_url('get_started')}' class='btn btn-info btn-sm pull-right'>Setup Shop</a>";
    }


    $this->view('dashboard', $data);
}

}
