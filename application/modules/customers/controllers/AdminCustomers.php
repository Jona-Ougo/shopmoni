<?php namespace GoCart\Controller;
/**
 * AdminCustomers Class
 *
 * @package GoCart
 * @subpackage Controllers
 * @category AdminCustomers
 * @author Clear Sky Designs
 * @link http://gocartdv.com
 */

class AdminCustomers extends Admin {
    //this is used when editing or adding a customer
    var $customer_id = false; 

    public function __construct()
    { 
        parent::__construct();

        \CI::load()->model(array('Customers', 'Locations', 'Orders'));
        \CI::load()->helper('formatting_helper');
        \CI::lang()->load('customers');
    }

    /*
        Display a merchant's customers ONLY
    */
    public function index($field='lastname', $by='ASC', $page=0)
    {
        //we're going to use flash data and redirect() after form submissions to stop people from refreshing and duplicating submissions
        //\CI::session()->set_flashdata('message', 'this is our message');
        
        $data['page_title'] = lang('customers');
        $data['customers'] = \CI::Customers()->getShopCustomers(50, $page, $field, $by);
        
        \CI::load()->library('pagination');

        $config['base_url'] = site_url('/admin/customers/my-customers/'.$field.'/'.$by.'/');
        $config['total_rows'] = \CI::Customers()->countShopCustomers();
        $config['per_page'] = 50;
        $config['uri_segment'] = 6;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        \CI::pagination()->initialize($config);
        
        $data['page'] = $page;
        $data['field'] = $field;
        $data['by'] = $by;
        
        $this->view('shop_customers', $data);
    }
    

    public function export()
    {
        $customers = \CI::Customers()->get_customer_export();
        
        \CI::load()->helper('download_helper');
        force_download('customers.json', json_encode($customers));
    }
}