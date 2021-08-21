<?php namespace GoCart\Controller;
/**
 * Login Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Login
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class Login extends Front {

    var $customer;

    public function __construct()
    {
        parent::__construct(); 
        $this->customer = \CI::Login()->customer();
    }

    public function login($redirect= '')
    {
        //find out if they're already logged in
        if (\CI::Login()->isLoggedIn(false, false)){

            redirect($redirect);
        }

        $data = ['redirect'=>$redirect];
            

        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('', '');
        \CI::form_validation()->set_rules('lemail', 'lang:address_email', ['trim','required','valid_email']);
        \CI::form_validation()->set_rules('lpassword', 'Password', ['required', ['check_login_callable', function($str){
            $email      = \CI::input()->post('lemail');
            $password   = \CI::input()->post('lpassword');
            $remember   = \CI::input()->post('remember');
            $recaptcha  = \CI::input()->post('g-recaptcha-response');
            $login = \CI::Login()->loginCustomer($email, sha1($password), $remember, $recaptcha);

            switch((int)$login){
                //Recaptcha error
                case 3:
                \CI::form_validation()->set_message('check_login_callable', 'Please Confirm you are not a robot');
                return false;
                break;

                //Email not confirmed
                case 2:
                $link = site_url('/resend_email');
                \CI::form_validation()->set_message('check_login_callable', 'You Need to confirm your Email address. <a href="'.$link.'">>> Resend confirmation email here</a> ');
                \CI::session()->set_userdata('lemail', \CI::input()->post('lemail'));
                return false;
                break;

                //Invalid username or password
                case 0:
                \CI::form_validation()->set_message('check_login_callable', 'Login Failed: Wrong Shopmoni Username or Password entered.');
                return false;
                break;
            }
        }]]);

        if(\CI::form_validation()->run() == FALSE){
            $data['loginErrors'] = \CI::form_validation()->get_error_array();
            $this->view('login', $data);
        }else{
            if(\CI::input()->post('checkout_redirect'))
                redirect('checkout/address-stage');
            if(empty($redirect)){
                $customer = \CI::Login()->customer();
                if($customer->use_shop == 1){
                    redirect('admin/setup');
                }else{
                    redirect('account');
                }
            }else{
                redirect($redirect);
            }

        }
    }

    public function logout()
    {
        \CI::Login()->logoutCustomer();
        $text = '<strong>You\'ve Logged Out</strong><br>';
        $text.= 'You\'re now securely logged out. We hope to see you again soon.';
        \CI::session()->set_flashdata('logout', $text);
        redirect('login');
    }

    public function forgotPassword()
    {
        $data['page_title'] = lang('forgot_password');

        \CI::form_validation()->set_rules('email', 'lang:address_email', ['trim', 'required', 'valid_email',
            ['email_callable', function($str)
            {
                $reset = \CI::Customers()->reset_password($str);

                if(!$reset)
                {
                    \CI::form_validation()->set_message('email_callable', lang('error_no_account_record'));
                    return FALSE;
                }
                else
                {
                        //user does exist. and the password is reset.
                    return TRUE;
                }
            }
            ]
            ]);

        if (\CI::form_validation()->run() == FALSE)
        {
            $this->view('forgot_password', $data);
        }
        else
        {
            \CI::session()->set_flashdata('message', lang('message_new_password'));
            redirect('login');
        }
    }

    public function register()
    {
        
        $redirect  = \CI::Login()->isLoggedIn(false, false);
        //if they are logged in, we send them back to the my_account by default
        if ($redirect){
            redirect('my-account');
        }
        
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('','');
        
        //default values are empty if the customer is new
        $data = [
        'firstname' => '',
        'lastname' => '',
        'email' => '',
        'phone' => '',
        'address1' => '',
        'address2' => '',
        'city' => '',
        'state' => '',
        'zip' => '',

        'redirect' => \CI::session()->flashdata('redirect')
        ];

        \CI::form_validation()->set_rules('firstname', 'lang:account_firstname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('lastname', 'lang:account_lastname', 'trim|required|max_length[32]');
        \CI::form_validation()->set_rules('email', 'lang:account_email', ['trim','required','valid_email','max_length[128]', ['check_email_callable', function($str){
            return $this->check_email($str);
        }]]);
        \CI::form_validation()->set_rules('phone', 'Phone Number', 'trim|required|is_unique[customers.phone]');
        \CI::form_validation()->set_rules('email_subscribe', 'lang:email_subscribe', 'trim|max_length[1]');
        \CI::form_validation()->set_rules('country_id', 'Country', 'trim|required');
        \CI::form_validation()->set_rules('password', 'lang:account_password', 'required|min_length[6]');
        \CI::form_validation()->set_rules('confirm', 'lang:account_confirm', 'required|matches[password]');
        
        \CI::form_validation()->set_rules('terms_condition', 'Terms and Condition', 'required');
        \CI::form_validation()->set_message('is_unique', 'This %s has been taken.');

        if (\CI::form_validation()->run() == FALSE){
            //if they have submitted the form already and it has returned with errors, reset the redirect
            if (\CI::input()->post('submitted')){
                $data['redirect'] = \CI::input()->post('redirect');
            }
            
            // load other page content 
            //\CI::load()->model('banner_model');
            \CI::load()->helper('directory');

            $data['registrationErrors'] = \CI::form_validation()->get_error_array();
            $this->view('login', $data);
        }else{
            $save['id'] = false;
            $save['firstname']      = \CI::input()->post('firstname');
            $save['lastname']       = \CI::input()->post('lastname');
            $save['email']          = \CI::input()->post('email');
            $save['phone']          = \CI::input()->post('phonepref')."-".substr(\CI::input()->post('phone'),1);
            $save['country_id']     = \CI::input()->post('country_id');
            $save['active']         = (bool)config_item('new_customer_status');
            $save['email_subscribe']= intval((bool)\CI::input()->post('email_subscribe'));
            \CI::load()->helper('string');
            $save['emailconfirmcode']   = random_string('alnum', 12);
            $save['password']  = sha1(\CI::input()->post('password'));
            
            $redirect  = \CI::input()->post('redirect');
            
            //if we don't have a value for redirect
            if ($redirect == ''){
                $redirect = 'account';
            }
            
            // save the customer info and get their new id
            \CI::Customers()->save($save);
            
            //send the registration email
            \GoCart\Emails::registration($save);

            //load twig for this language string
            $loader = new \Twig_Loader_String();
            $twig = new \Twig_Environment($loader);
            
            //if they're automatically activated log them in and send them where they need to go
            if($save['active']){
                \CI::session()->set_flashdata('message', $twig->render( lang('registration_thanks'), $save) );

                //lets automatically log them in
                \CI::Login()->loginCustomer($save['email'], $save['password']);

                //to redirect them, if there is no redirect, the it should redirect to the homepage.
                redirect($redirect);
            }else{
                //redirect to the login page if they need to wait for activation
                $link = site_url('/resend_email');
                \CI::session()->set_flashdata('message', $twig->render('Your registration was succesful. Please check your email to verify your account.<br /> Didn\'t get an email?<br /><a href="'.$link.'" style="color:red;"> >> Resend confirmation email</a>', $save) );
                \CI::session()->set_userdata('lemail', \CI::input()->post('email'));
                redirect('login');

            }
        }
    }

    public function confirm_email($emailconfirmcode = '')
    {
        if(empty($emailconfirmcode))
            redirect(site_url());

        if($customer = \DB\DB::getRow('customers', ['emailconfirmcode'=>$emailconfirmcode])){
            \DB\DB::update('customers', ['emailconfirmcode'=>$emailconfirmcode], ['active'=>1]);
            \CI::session()->set_flashdata('message', 'Email confirmed succesfully. You can now login to your account');
            redirect('login');
        }else{
            redirect(site_url());
        }
    }

    public function check_email($str)
    {
        $email = \CI::Customers()->check_email($str);
        
        if ($email)
        {
            \CI::form_validation()->set_message('check_email_callable', lang('error_email'));
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function verify_email()
    {
        $email = \CI::input()->post('email');
        if(\DB\DB::itExists('customers', 'email', $email))
            echo 1;
        else 
            echo 0;
    } 

    public function verify_phone()
    {
        $phone = \CI::input()->post('phone');
        if(\DB\DB::itExists('customers', 'phone', $phone))
            echo 1;
        else 
            echo 0;
    }

    public function resend_email()
    {
        $email = \CI::session()->userdata('lemail');
        $user = (array)\DB\DB::getRow('customers', ['email'=>$email]);
        \GoCart\Emails::registration($user);
        \CI::session()->set_flashdata('logout', 'Registration Email resent succesfully.');
        redirect('login');
    }
}
