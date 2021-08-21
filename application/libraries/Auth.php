<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
    public function check_access($access, $defaultRedirect=false, $redirect = false)
    {
        /*
        we could store this in the session, but by accessing it this way
        if an admin's access level gets changed while they're logged in
        the system will act accordingly.
        */
        
        $admin = CI::session()->userdata('admin');

        CI::db()->select('access');
        CI::db()->where('id', $admin['id']);
        CI::db()->limit(1);
        $result = CI::db()->get('customers');
        $result = $result->row();
        
        //result should be an object I was getting odd errors in relation to the object.
        //if $result is an array then the problem is present.
        if(!$result || is_array($result)){
            $this->logout();
            return false;
        }
        //  echo $result->access;
        if ($access){
            if ($access == $result->access){
                return true;
            }else{
                if ($redirect){
                    redirect($redirect);

                }elseif($defaultRedirect){
                    redirect('admin');
                }else{
                    return false;
                }
            }
            
        }
    }
    
    /*
    this checks to see if anyone is logged in
    we can provide a link to redirect to, and for the login page, we have $defaultRedirect,
    this way we can check if they are already logged in, but we won't get stuck in an infinite loop if it returns false.
    */
    public function isLoggedIn($redirect = false, $defaultRedirect = true)
    {

        //var_dump(CI::session()->userdata('session_id'));

        //$redirect allows us to choose where a user will get redirected to after they login
        //$defaultRedirect points is to the login page, if you do not want this, you can set it to false and then redirect wherever you wish.

        $admin = CI::session()->userdata('admin');
        
        if (!$admin){
            //check the cookie
            if(isset($_COOKIE['GoCartAdmin'])){
                //the cookie is there, lets log the customer back in.
                if($_COOKIE['GoCartAdmin']){
                    $result = CI::db()->select('*, sha1(username+password) as hash')->get('admin')->row_array();
                    if($result){
                        //unset these 2 fields
                        unset($result['password']);
                        unset($result['hash']);

                        CI::session()->set_userdata(['admin'=>$result]);

                        if ($redirect){
                            CI::session()->set_flashdata('redirect', $redirect);
                        }

                        if ($defaultRedirect){   
                            redirect(CI::uri()->uri_string());
                        }
                    }
                }
            }

            if($redirect && $defaultRedirect)
                redirect('login');

            return false;
        }
        else
        {
            return true;
        }
    }

    /*
    this checks to see if zeus is logged in
    we can provide a link to redirect to, and for the login page, we have $defaultRedirect,
    this way we can check if they are already logged in, but we won't get stuck in an infinite loop if it returns false.
    */
    public function isZeusLoggedIn($redirect = false, $defaultRedirect = true)
    {

        //var_dump(CI::session()->userdata('session_id'));

        //$redirect allows us to choose where a user will get redirected to after they login
        //$defaultRedirect points is to the login page, if you do not want this, you can set it to false and then redirect wherever you wish.

        $zeus = CI::session()->userdata('zeus');
        if (!$zeus){
            //check the cookie
            if(isset($_COOKIE['ShopmoniZeus'])){
                //the cookie is there, lets log the zeus back in.
                //See to this later.
                if($_COOKIE['ShopmoniZeus']){
                    $result = CI::db()->select('*, sha1(username+password) as hash')->get('admin')->row_array();
                    if($result){
                        //unset these 2 fields
                        unset($result['password']);
                        unset($result['hash']);

                        CI::session()->set_userdata(['zeus'=>$result]);

                        if ($redirect){
                            CI::session()->set_flashdata('redirect', $redirect);
                        }

                        if ($defaultRedirect){   
                            redirect(CI::uri()->uri_string());
                        }
                    }
                }
            }

            if($redirect && $defaultRedirect)
                redirect('zeus/login');

            return false;
        }else{
            return true;
        }
    }

    /*
    this function does the logging in.
    */
    public function loginZeus($username, $password, $remember=false)
    {
        //Validate recaptcha
        // if (!empty($recaptcha)) {

        //     $response = \CI::recaptcha()->verifyResponse($recaptcha);
        //     if (!isset($response['success']) and $response['success'] === false) {
        //         return false;
        //     }

        // }else{

        //  return false;

        // } 

       // make sure the username doesn't go into the query as false or 0
        if(!$username){
        return false;
        }

    CI::db()->select('*');
    CI::db()->where('username', $username);
    CI::db()->where('password',  sha1($password));
    CI::db()->limit(1);
    $result = CI::db()->get('admin');
    $result = $result->row_array();

    if (sizeof($result) > 0){
        if($remember){
                //generate a remember cookie
            $loginCred =  sha1($username.$result['password']);
                $this->generateZeusCookie($loginCred, strtotime('+6 months')); //remember the user for 6 months
            }

            //remove these 2 fields
            unset($result['password']);
            unset($result['hash']);

            //save the session
            CI::session()->set_userdata(['zeus'=>$result]);

            //get his group and set his permissions
            CI::load()->helper('db');
            if($zeusGroup = \DB\DB::getRow('admin_groups', ['group_id'=>$result['group_id']])){
                CI::session()->set_userdata(['zeusPermissions'=>$zeusGroup->group_permissions]);
            }else{
                CI::session()->set_userdata(['zeusPermissions'=>'[]']);
            }

            \DB\DB::create('admin_login_audit', [

                'admin_id'      => $result['id'],
                'ip'            => $_SERVER['REMOTE_ADDR'],
                'device'        => $_SERVER['HTTP_USER_AGENT'],
                'created_at'    => date('Y-m-d H:i:s')
            ]);

            return true;

        }else{
            return false;
        }
    }
    
    private function generateCookie($data, $expire)
    {
        setcookie('GoCartAdmin', $data, $expire, '/', $_SERVER['HTTP_HOST'], config_item('ssl_support'), true);
    }

    private function generateZeusCookie($data, $expire)
    {
        setcookie('ShopmoniZeus', $data, $expire, '/', $_SERVER['HTTP_HOST'], config_item('ssl_support'), true);
    }

    /*
    this function does the logging out
    */
    public function logout()
    {
        CI::session()->unset_userdata('zeus');
        CI::session()->unset_userdata('admin');
        CI::session()->unset_userdata('customer');
        //force expire the cookie
        $this->generateCookie('[]', time()-3600);
        $this->generateZeusCookie('[]', time()-3600);
    }

    /*
    This function resets the admins password and usernames them a copy
    */
    public function resetPassword($username)
    {
        $admin = $this->getAdminByUsername($username);
        if ($admin){
            CI::load()->helper('string');
            CI::load()->rary('email');
            
            $newPassword = random_string('alnum', 8);
            $admin['password'] = sha1($newPassword);
            $this->save($admin);
            
            \GoCart\Emails::resetPassword($newPassword,$admin['email']);

            return true;
        }else{
            return false;
        }
    }
    
    /*
    This function gets the admin by their username address and returns the values in an array
    it is not intended to be called outside this class
    */
    private function getAdminByUsername($username)
    {
        CI::db()->select('*');
        CI::db()->where('username', $username);
        CI::db()->limit(1);
        $result = CI::db()->get('admin');
        $result = $result->row_array();

        if (sizeof($result) > 0){
            return $result; 
        }else{
            return false;
        }
    }
    
    /*
    This function takes admin array and inserts/updates it to the database
    */
    public function save($admin)
    {
        if ($admin['id']){
            CI::db()->where('id', $admin['id']);
            CI::db()->update('admin', $admin);
        }else{
            CI::db()->insert('admin', $admin);
        }
    }
    
    
    /*
    This function gets a complete list of all admin
    */
    public function getAdminList()
    {
        CI::db()->select('*');
        CI::db()->order_by('lastname', 'ASC');
        CI::db()->order_by('firstname', 'ASC');
        CI::db()->order_by('email', 'ASC');
        CI::db()->order_by('username', 'ASC');
        $result = CI::db()->get('admin');
        $result = $result->result();
        
        return $result;
    }

    /*
    This function gets an individual admin
    */
    public function getAdmin($id)
    {
        CI::db()->select('*');
        CI::db()->where('id', $id);
        $result = CI::db()->get('admin');
        $result = $result->row();

        return $result;
    }
    
    public function checkId($str)
    {
        CI::db()->select('id');
        CI::db()->from('admin');
        CI::db()->where('id', $str);
        $count = CI::db()->count_all_results();
        
        if ($count > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function check_username($str, $id=false)
    {
        CI::db()->select('username');
        CI::db()->from('admin');
        CI::db()->where('username', $str);
        if ($id){
            CI::db()->where('id !=', $id);
        }
        $count = CI::db()->count_all_results();
        
        if ($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id)
    {
        if ($this->checkId($id)){
            $admin  = $this->getAdmin($id);
            CI::db()->where('id', $id);
            CI::db()->limit(1);
            CI::db()->delete('admin');

            return $admin->firstname.' '.$admin->lastname.' has been removed.';
        }else{
            return 'The admin could not be found.';
        }
    }
}