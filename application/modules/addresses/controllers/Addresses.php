<?php namespace GoCart\Controller;


class Addresses extends Front {

    var $customer;

    public function __construct()
    {
        parent::__construct();

        \CI::load()->model(array('Locations'));
        $this->customer = \CI::Login()->customer();
    }

    public function index()
    {

        \CI::Login()->isLoggedIn('my_account/');
        $data['customer'] = $this->customer;
        $data['addresses'] = \CI::Customers()->get_address_list($this->customer->id);

        $this->partial('account/addresses', $data);
    }

    public function form($id = 0)
    {

        $data['addressCount'] = \CI::Customers()->count_addresses($this->customer->id);
        $customer = \CI::Login()->customer();
//grab the address if it's available
        $data['id']         = false;
        $data['firstname']  = $customer->firstname;
        $data['lastname']   = $customer->lastname;
        $data['email']      = $customer->email;
        $data['phone']      = $customer->phone;
        $data['address1']   = '';
        $data['address2']   = '';
        $data['city']       = '';
        $data['country_id'] = $customer->country_id;
        $data['zone_id']    = '';
        $data['zip']        = '';

        if($id != 0){
            $a  = \CI::Customers()->get_address($id);
            if($a['customer_id'] != $this->customer->id){
                redirect('addresses/form');
            }

            $data = array_merge($data, $a);
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($data['country_id']);

        }

//get the countries list for the dropdown
        $data['countries_menu'] = \CI::Locations()->get_countries_menu();

        if($id == 0){
//if there is no set ID, the get the zones of Nigeria.u
            $arrayKeys          = array_keys($data['countries_menu']);
//$data['zones_menu'] = \CI::Locations()->get_zones_menu(array_shift($arrayKeys));
            $data['zones_menu'] = \CI::Locations()->get_zones_menu(156, true);
        } else {
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($data['country_id']);
        }

        \CI::load()->library('form_validation');
        \CI::form_validation()->set_rules('firstname', 'lang:address_firstname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('lastname', 'lang:address_lastname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('email', 'lang:address_email', 'trim|required|valid_email|max_length[128]');
        \CI::form_validation()->set_rules('phone', 'lang:address_phone', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('address1', 'lang:address', 'trim|required|max_length[128]');
        \CI::form_validation()->set_rules('address2', 'lang:address2', 'trim|max_length[128]');
        \CI::form_validation()->set_rules('city', 'lang:address_city', 'trim|max_length[32]');
        \CI::form_validation()->set_rules('country_id', 'lang:address_country', 'trim|required|numeric');
        \CI::form_validation()->set_rules('zone_id', 'lang:address_state', 'trim|required|numeric');
        \CI::form_validation()->set_rules('zip', 'lang:address_zip', 'trim|max_length[32]');

        if (\CI::form_validation()->run() == FALSE){

            $this->partial('address_form', $data); 
//Added by me Tues 3/01/2017 3:52pm
        }else{
            $a                  = [];
            $a['id']            = ($id==0) ? '' : $id;
            $a['customer_id']   = $this->customer->id;
            $a['firstname']     = \CI::input()->post('firstname');
            $a['lastname']      = \CI::input()->post('lastname');
            $a['email']         = \CI::input()->post('email');
            $a['phone']         = \CI::input()->post('phone');
            $a['address1']      = \CI::input()->post('address1');
            $a['address2']      = \CI::input()->post('address2');
            $a['city']          = \CI::input()->post('city');
            $a['zip']           = \CI::input()->post('zip');

// get zone / country data using the zone id submitted as state
            $country = \CI::Locations()->get_country(assign_value('country_id'));
            $zone    = \CI::Locations()->get_zone(assign_value('zone_id'));

            if(!empty($country)){
                $a['zone']          = $zone->code; 
                $a['country']       = $country->name;
                $a['country_code']  = $country->iso_code_2; 
                $a['country_id']    = \CI::input()->post('country_id');
                $a['zone_id']       = \CI::input()->post('zone_id');
            }
//var_dump($a); die;
            \CI::Customers()->save_address($a);

            echo 1;
        }
    }

//Same as the form method in this file. jst used in the /account route because i need to reload that page on success..
    public function form_front($id = 0)
    {

        $data['addressCount'] = \CI::Customers()->count_addresses($this->customer->id);
        $customer = \CI::Login()->customer();
//grab the address if it's available
        $data['id']         = false;
        $data['firstname']  = $customer->firstname;
        $data['lastname']   = $customer->lastname;
        $data['email']      = $customer->email;
        $data['phone']      = $customer->phone;
        $data['address1']   = '';
        $data['address2']   = '';
        $data['city']       = '';
        $data['country_id'] = $customer->country_id;
        $data['zone_id']    = '';
        $data['zip']        = '';

        if($id != 0) {
            $a  = \CI::Customers()->get_address($id);
            if($a['customer_id'] != $this->customer->id){
                echo 0;
                die;
            }

            $data = array_merge($data, $a);
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($data['country_id']);
        }

//get the countries list for the dropdown
        $data['countries_menu'] = \CI::Locations()->get_countries_menu();

        if($id == 0){
//if there is no set ID, the get the zones of the first country in the countries menu
            $arrayKeys          = array_keys($data['countries_menu']);
                    //array_shift($arrayKeys)
            $data['zones_menu'] = \CI::Locations()->get_zones_menu(156, true);
//array_unshift($data['zones_menu'], ['--select--']);
        }else{
            $data['zones_menu'] = \CI::Locations()->get_zones_menu($data['country_id']);
        }

        \CI::load()->library('form_validation');
        \CI::form_validation()->set_rules('firstname', 'lang:address_firstname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('lastname', 'lang:address_lastname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('email', 'lang:address_email', 'trim|required|valid_email|max_length[128]');
        \CI::form_validation()->set_rules('phone', 'lang:address_phone', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('address1', 'lang:address', 'trim|required|max_length[128]');
        \CI::form_validation()->set_rules('address2', 'lang:address2', 'trim|max_length[128]');
        \CI::form_validation()->set_rules('city', 'lang:address_city', 'trim|max_length[32]');
        \CI::form_validation()->set_rules('country_id', 'lang:address_country', 'trim|required|numeric');
        \CI::form_validation()->set_rules('zone_id', 'lang:address_state', 'trim|required|numeric');
        \CI::form_validation()->set_rules('zip', 'lang:address_zip', 'trim|max_length[32]');

        if (\CI::form_validation()->run() == FALSE){
            $this->partial('account/address_form', $data); 
        }else{
            $a = [];
            $a['id']                = ($id==0) ? '' : $id;
            $a['customer_id']       = $this->customer->id;
            $a['firstname']         = \CI::input()->post('firstname');
            $a['lastname']          = \CI::input()->post('lastname');
            $a['email']             = \CI::input()->post('email');
            $a['phone']             = \CI::input()->post('phone');
            $a['address1']          = \CI::input()->post('address1');
            $a['address2']          = \CI::input()->post('address2');
            $a['city']              = \CI::input()->post('city');
            $a['zip']               = \CI::input()->post('zip');

            $country = \CI::Locations()->get_country(assign_value('country_id'));
            $zone    = \CI::Locations()->get_zone(assign_value('zone_id'));
            if(!empty($country)){
                $a['zone']          = $zone->code; 
                $a['country']       = $country->name;
                $a['country_code']  = $country->iso_code_2;
                $a['country_id']    = \CI::input()->post('country_id');
                $a['zone_id']       = \CI::input()->post('zone_id');
            }

            \CI::Customers()->save_address($a);
            echo 1;
        }
    }

    public function addressStage()
    {
        if(\GC::totalItems() > 0){
            $data['addresses'] = \CI::Customers()->get_address_list($this->customer->id);
            $this->view('address_stage', $data);
        }else{
            $this->view('emptyCart');
        }
    }

    public function delete($id)
    {
        \CI::Customers()->delete_address($id, $this->customer->id);
        echo 1;
    }

    public function getZoneOptions($id)
    {
        $zones  = \CI::Locations()->get_zones_menu($id);
        echo "<option value=''>--select--</option>";
        foreach($zones as $id => $z){
            echo "<option value='{$id}'>{$z}</option>";
        }
        
    }
}
