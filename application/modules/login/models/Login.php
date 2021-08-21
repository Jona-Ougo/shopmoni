<?php
Class Login extends CI_Model
{

    public function __construct()
    {
        
        $customer = CI::session()->userdata('customer');

        if(empty($customer))
        {
            //If we don't have a customer, check for a cookie.
            if(isset($_COOKIE['shopmoni_customer']))
            {
                //the cookie is there, lets log the customer back in.
                $info = $this->aes256Decrypt(base64_decode($_COOKIE['shopmoni_customer']));
                $cred = json_decode($info);

                if(is_object($cred))
                {
                    $this->loginCustomer($cred->email, $cred->password, true);
                    if( ! $this->isLoggedIn() )
                    {
                        // cookie data isn't letting us login.
                        $this->logoutCustomer();
                        $this->createGuest();
                    }
                }
            }
            else
            {
                //cookie is empty
                $this->logoutCustomer();
                $this->createGuest();
            }
        }
    }

    public function customer()
    {
        return CI::session()->userdata('customer');
    }

    public function logoutCustomer()
    {
        CI::session()->unset_userdata('customer');
        CI::session()->unset_userdata('admin');
        //force expire the cookie
        $this->generateCookie('[]', time()-3600);
    }

    private function generateCookie($data, $expire)
    {
        setcookie('shopmoni_customer', $data, $expire, '/', $_SERVER['HTTP_HOST'], config_item('ssl_support'), true);
        setcookie('GoCartAdmin', $data, $expire, '/', $_SERVER['HTTP_HOST'], config_item('ssl_support'), true);
    }

    public function loginCustomer($email, $password, $remember=false, $recaptcha = '')
    {
        //Validate recaptcha
        if (!empty($recaptcha)) {
            $response = \CI::recaptcha()->verifyResponse($recaptcha);
            if(!isset($response['success']) and $response['success'] === false){
                return 3;
            }
        }else{
           return 3;
        }

        $customer = CI::db()->where('is_guest', 0)->
        where('email', $email)->
        where('password',  $password)->
        limit(1)->
        get('customers')->row();

        if($customer && $customer->active == 0)
            return 2;
        
        if ($customer && !(bool)$customer->is_guest)
        {
            //Update the last login.
            \CI::load()->helper('db');
            \DB\DB::update('customers', ['id'=>$customer->id], ['last_login'=>date('Y-m-d H:i:s')]);

            $audit = ['customer_id' => $customer->id, 'created_at' => date('Y-m-d H:i:s')];
            \DB\DB::create('login_audit', $audit);
            // Set up any group discount
            if($customer->group_id != 0)
            {
                $group = CI::Customers()->get_group($customer->group_id);
                if($group) // group might not exist
                {
                    $customer->group = $group;
                }
            }

            if($remember)
            {
                $loginCred = json_encode(array('email'=>$customer->email, 'password'=>$customer->password));
                $loginCred = base64_encode($this->aes256Encrypt($loginCred));
                //remember the user for 6 months
                $this->generateCookie($loginCred, strtotime('+6 months'));
            }


            //combine cart items
            if($this->customer())
            {
                $oldCustomer = $this->customer();
                unset($customer->password);
                CI::session()->set_userdata('customer', $customer);
                $admin['id']            = $customer->id;
                $admin['firstname']     = $customer->firstname;
                $admin['lastname']      = $customer->lastname;
                $admin['email']         = $customer->email;
                $admin['phone']         = $customer->phone;
                $admin['access']        = $customer->access;
                CI::session()->set_userdata(['admin'=>$admin]);
                \GC::combineCart($oldCustomer); // send the logged-in customer data
            }
            
            return 1;
        }else{
            return 0;
        }
    }

    public function isLoggedIn($redirect = false, $default_redirect = 'login')
    {
        //$redirect allows us to choose where a customer will get redirected to after they login
        //$default_redirect points is to the login page, if you do not want this, you can set it to false and then redirect wherever you wish.

        $customer = CI::session()->userdata('customer');

        if(!$customer)
        {
            return false;
        }

        if($customer->is_guest == 1)
        {
            if($redirect)
            {
                redirect($default_redirect);
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }

    private function createGuest()
    {
        CI::load()->helper('cookie');
        CI::load()->helper('db');
        //delete_cookie('shopmoni_guest');
        $cookie = get_cookie('shopmoni_guest');

        if($cookie == NULL || empty($cookie)){

            $hash = hash('SHA512', time()*rand());
            $cookie = [
            'name'=> 'shopmoni_guest',
            'value'=> $hash,
            'expire' => 86400*30,
            'domain'=> $_SERVER['HTTP_HOST'],
            'path'=> '/',
            'secure'=> config_item('ssl_support')
            ];

            CI::input()->set_cookie($cookie);

            $customer               = \DB\DB::firstOrNew('customers', ['id'=>0]);
            $customer->cookie       = $hash;
            $customer->is_guest     = 1;
            $customer->active       = 1;
            $customer->group_id     = 1;
            $customer->confirmed    = 1;
            $customer->advert_credit    = 500;

            $save = (array)$customer; unset($save['id']);

            \DB\DB::create('customers',$save);

        }else{

            $customer = \DB\DB::firstOrNew('customers', ['cookie'=>$cookie]);

            //to be sure, set these values so that they are 1
            $customer->is_guest     = 1;
            $customer->active       = 1;
            $customer->group_id     = 1;
            $customer->confirmed    = 1;
            $customer->advert_credit    = 500;
        }

        CI::session()->set_userdata('customer', $customer);

        return true;
    }

    private function aes256Encrypt($data)
    {
        $key = config_item('encryption_key');
        if(32 !== strlen($key))
        {
            $key = hash('SHA256', $key, true);
        }
        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
    }

    private function aes256Decrypt($data)
    {
        $key = config_item('encryption_key');
        if(32 !== strlen($key))
        {
            $key = hash('SHA256', $key, true);
        }
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
        $padding = ord($data[strlen($data) - 1]);
        return substr($data, 0, -$padding);
    }
}