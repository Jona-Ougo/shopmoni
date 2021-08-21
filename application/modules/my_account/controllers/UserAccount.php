<?php namespace GoCart\Controller;
/**
 * Account Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    MyAccount
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class UserAccount extends Front { 

    var $customer;

    public function __construct()
    {
        parent::__construct();
        \CI::load()->model(array('Locations'));
        $this->customer = \CI::Login()->customer();

        //Had to retrieve the logged in customer again. dont know why the $this->customer->use_shop is failing the if condition below.
        $loggedinCustomer = \DB\DB::getRow('customers', ['id'=>$this->customer->id]);
        
        //If the user already activated shop, take him to the shop dashboard.
        if($loggedinCustomer->use_shop == 1)
            redirect('admin/dashboard');
    }

    public function index($offset=0)
    {
        //make sure they're logged in
        \CI::Login()->isLoggedIn('account');

        $data['customer'] = (array)\CI::Customers()->get_customer($this->customer->id);
        $data['addresses'] = \CI::Customers()->get_address_list($this->customer->id);
        
        // load other page content
        \CI::load()->helper('directory');
        \CI::load()->helper('date');

        // paginate the orders
        \CI::load()->library('pagination');

        $config['base_url'] = site_url('my_account');
        $config['total_rows'] = \CI::Orders()->countCustomerOrders($this->customer->id);
        $config['per_page'] = '15';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
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

        $data['orders_pagination'] = \CI::pagination()->create_links();

        $data['orders'] = \CI::Orders()->getCustomerOrders($this->customer->id, $offset);
        //print_r($offset);

        \CI::load()->library('form_validation');
        \CI::form_validation()->set_rules('company', 'lang:address_company', 'trim|max_length[128]');
        \CI::form_validation()->set_rules('firstname', 'lang:address_firstname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('lastname', 'lang:address_lastname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('email', 'lang:address_email', ['trim','required','valid_email','max_length[128]', ['check_email_callable', function($str){
            return $this->check_email($str);
        }]]);
        \CI::form_validation()->set_rules('phone', 'lang:address_phone', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('email_subscribe', 'lang:account_newsletter_subscribe', 'trim|numeric|max_length[1]');

        if(\CI::input()->post('password') != '' || \CI::input()->post('confirm') != ''){
            \CI::form_validation()->set_rules('password', 'Password', 'required|min_length[6]|sha1');
            \CI::form_validation()->set_rules('confirm', 'Confirm Password', 'required|matches[password]');
        }else{
            \CI::form_validation()->set_rules('password', 'Password');
            \CI::form_validation()->set_rules('confirm', 'Confirm Password');
        }


        if (\CI::form_validation()->run() == FALSE){
            $data['errors'] = validation_errors();
            $this->view('account/my_account', $data);
        }else{
            $customer                       = [];
            $customer['id']                 = $this->customer->id;
            $customer['company']            = \CI::input()->post('company');
            $customer['firstname']          = \CI::input()->post('firstname');
            $customer['lastname']           = \CI::input()->post('lastname');
            $customer['email']              = \CI::input()->post('email');
            $customer['phone']              = \CI::input()->post('phone');
            $customer['email_subscribe']    = intval((bool)\CI::input()->post('email_subscribe'));

            if(\CI::input()->post('password') != ''){
                $customer['password'] = \CI::input()->post('password');
            }

            \GC::save_customer($this->customer);
            \CI::Customers()->save($customer);

            \CI::session()->set_flashdata('message', 'Account Updated succesfully.');

            redirect('account');
        }

    }

    public function myOrders($offset = 0)
    {
        \CI::Login()->isLoggedIn('account');
        // paginate the orders
        \CI::load()->library('pagination');

        $config['base_url'] = site_url('my-orders');
        $config['total_rows'] = \CI::Orders()->countCustomerOrders($this->customer->id);
        $config['per_page'] = '15';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
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
        \CI::load()->helper('date');
        
        $data['orders_pagination'] = \CI::pagination()->create_links();

        $data['orders'] = \CI::Orders()->getCustomerOrders($this->customer->id, $offset);
        $this->view('my_orders', $data);
        
    }



    public function check_email($str)
    {
        if(!empty($this->customer->id)){
            $email = \CI::Customers()->check_email($str, $this->customer->id);
        }else{
            $email = \CI::Customers()->check_email($str);
        }

        if ($email){
            \CI::form_validation()->set_message('check_email_callable', lang('error_email'));
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function download($link)
    {
        $filedata = \CI::DigitalProducts()->get_file_info_by_link($link);

        // missing file (bad link)
        if(!$filedata){
            show_404();
        }

        // validate download counter
        if($filedata->max_downloads > 0){
            if(intval($filedata->downloads) >= intval($filedata->max_downloads)){
                show_404();
            }
        }

        // increment downloads counter
        \CI::DigitalProducts()->touch_download($link);

        // Deliver file
        \CI::load()->helper('download');
        force_download('uploads/digital_uploads/', $filedata->filename);
    }

    public function turn_on_shop(){
        if(isset($_POST) && !empty($_POST))
        {
            $_POST['phone_1']   = $_POST['phonepref']."-".$_POST['phone_1'];
            $_POST['phone_2']   = $_POST['phonepref2']."-".$_POST['phone_2'];

            unset($_POST['phonepref']);
            unset($_POST['phonepref2']);
        }
       //make sure they're logged in
        \CI::Login()->isLoggedIn('account'); 
        $customer               = \CI::Login()->customer();

        //print_r($customer); die;
        $where                  = ['customer_id'=>$customer->id];
        $address                = \DB\DB::getRow('customers_address_bank', $where);
        $data['id']             = false;
        $data['shop_name']      = '';
        $data['company']        = '';
        $data['phone_1']        = $customer->phone;
        $data['phone_2']        = '';
        if(isset($_POST) && !empty($_POST))
        {
            $data['phone_1']    = $_POST['phone_1'];
            $data['phone_2']    = $_POST['phone_2'];
        }
        $data['address']        = $address == false ? '' : $address->address1;
        $data['city']           = '';
        $data['country_id']     = $customer->country_id;
        $data['country']        = \DB\DB::getRow('countries', ['id'=>$customer->country_id])->name;
        $data['zone_id']        = '';
        $data['zip']            = '';
        $data['zones_menu']     = \CI::Locations()->get_zones_menu($customer->country_id, true);
        $data['countries_menu'] = \CI::Locations()->get_countries_menu();


        
        if($data['id'] == 0){
            //if there is no set ID, the get the zones of the first country in the countries menu
            $arrayKeys          = array_keys($data['countries_menu']);
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($customer->country_id, true);
        }else{
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($customer->country_id, true);
        }
        
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_rules('shop_name', 'Shop Name', 'trim|alpha_numeric_spaces|required|is_unique[customers_shop_information.shop_name]');
        \CI::form_validation()->set_rules('shop_name', 'Shop Name', ['trim','alpha_numeric_spaces','required', ['check_shop_name', function($shop_name){
            return $this->check_shop_name($shop_name);
        }]]);
        \CI::form_validation()->set_rules('company', 'Company', 'trim');
        // \CI::form_validation()->set_rules('phone_1', 'Phone One', 'trim|required|numeric|max_length[32]');
        // \CI::form_validation()->set_rules('phone_2', 'Phone Two', 'trim|numeric|max_length[32]');
        \CI::form_validation()->set_rules('address', 'lang:address', 'trim|required|max_length[128]');
        \CI::form_validation()->set_rules('city', 'lang:address_city', 'trim|required|max_length[32]');
        //\CI::form_validation()->set_rules('country_id', 'lang:address_country', 'trim|required|numeric');
        \CI::form_validation()->set_rules('zone_id', 'lang:address_state', 'trim|required|numeric');

        if(\CI::form_validation()->run() == FALSE){
            $this->view('account/turn_on_shop', $data);
            
        }else{
            $post = \CI::input()->post();
            print_r($post);
            $post['customer_id'] = $this->customer->id;
            $country = \CI::Locations()->get_country($customer->country_id);
            $zone    = \CI::Locations()->get_zone(\CI::input()->post('zone_id'));
            
            if(!empty($country)){
                $post['zone']           = $zone->code; 
                $post['country']        = $country->name;
                $post['country_code']   = $country->iso_code_2;
                $post['country_id']     = $customer->country_id;
                $post['zone_id']        = \CI::input()->post('zone_id');
            }

            \CI::load()->helper('url', 'string');
            $post['shop_slug']          = strtolower(url_title($post['shop_name'])).'-'.random_string('alpha', 6);
            $post['created_at']         = date('Y-m-d H:i:s');

            \DB\DB::save('customers_shop_information', $post);
            \DB\DB::update('customers', ['id'=>$this->customer->id], ['use_shop'=>1, 'first_time'=>1]);

            //Send a proper mail here.
            $message = 'Congratulations! Your online shop has been activated. Now you are ready to start selling and making money. <a href="'.site_url('admin/setup').'" class="btn btn-info btn-sm">click here</a> to get started.';
            \CI::session()->set_flashdata('message', $message);
            redirect('admin/setup');
        }
    }

    public function check_shop_name($shop_name = '')
    {
        $found = 0;
        foreach(\DB\DB::get('customers_shop_information') as $row){
            if(strtolower($shop_name) == strtolower($row->shop_name)){
             $found = 1; 
             break;
         }
     }

     if ($found == 1){
        \CI::form_validation()->set_message('check_shop_name', '<em>'.$shop_name.'</em> is not avaliable. Please Choose a different name.');
        return FALSE;
    }
    return TRUE;
} 

public function check_shop_name_ajax()
{
    $found = 0;
    foreach(\DB\DB::get('customers_shop_information') as $row){
        if(strtolower($shop_name) == strtolower(\CI::input()->post('shopname'))){
          $found = 1;
          break;
      }
  }

  echo $found;

}
}
