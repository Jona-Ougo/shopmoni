<?php namespace GoCart\Controller;
/**
 * AdminUsers Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    AdminUsers
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class AdminUsers extends Zeus {
    
    //these are used when editing, adding or deleting an admin
    var $zeus_id       = false;
    var $current_zeus  = false;

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'admin';

        //load the admin language file in
        \CI::lang()->load('users');

        $this->current_zeus = \CI::session()->userdata('zeus');

        _p('manageadministrators', true);
    }

    public function index()
    {
        $data['page_title']     = lang('admins');
        $data['admins']         = \CI::auth()->getAdminList();

        $this->view('users', $data);
    }

    public function delete($id)
    {
        //even though the link isn't displayed for an admin to delete themselves, if they try, this should stop them.
        if ($this->current_zeus['id'] == $id)
        {
            \CI::session()->set_flashdata('message', lang('error_self_delete'));
            redirect('admin/users'); 
        }

        //delete the user
        \CI::auth()->delete($id);
        \CI::session()->set_flashdata('message', lang('message_user_deleted'));
        redirect('admin/users');
    }

    public function form($id = false)
    {   
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('<div class="error">', '</div>');

        $data['page_title'] = lang('admin_form');

        //default values are empty if the customer is new
        $data['id']             = '';
        $data['firstname']      = '';
        $data['lastname']       = '';
        $data['email']          = '';
        $data['username']       = '';
        $data['group_id']       = '';

        if ($id)
        {   
            $this->zeus_id = $id;
            $admin = \CI::auth()->getAdmin($id);
            //if the administrator does not exist, redirect them to the admin list with an error
            if (!$admin)
            {
                \CI::session()->set_flashdata('message', lang('admin_not_found'));
                redirect('admin/users');
            }
            //set values to db values
            $data['id']         = $admin->id;
            $data['firstname']  = $admin->firstname;
            $data['lastname']   = $admin->lastname;
            $data['email']      = $admin->email;
            $data['username']   = $admin->username;
            $data['group_id']   = $admin->group_id;
        }
        
        \CI::form_validation()->set_rules('firstname', 'lang:firstname', 'trim|max_length[32]');
        \CI::form_validation()->set_rules('lastname', 'lang:lastname', 'trim|max_length[32]');
        \CI::form_validation()->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
        \CI::form_validation()->set_rules('username', 'lang:username', ['trim', 'required', 'max_length[128]', ['username_callable', function($str){
            $email = \CI::auth()->check_username($str, $this->zeus_id);
            if ($email)
            {
                \CI::form_validation()->set_message('username_callable', lang('error_username_taken'));
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }]]);
        
        //if this is a new account require a password, or if they have entered either a password or a password confirmation
        if (\CI::input()->post('password') != '' || \CI::input()->post('confirm') != '' || !$id)
        {
            \CI::form_validation()->set_rules('password', 'lang:password', 'required|min_length[6]|sha1');
            \CI::form_validation()->set_rules('confirm', 'lang:confirm_password', 'required|sha1|matches[password]');
        }
        
        if (\CI::form_validation()->run() == FALSE)
        {
            $this->view('user_form', $data);
        }
        else
        {
            $save['id']         = $id;
            $save['firstname']  = \CI::input()->post('firstname');
            $save['lastname']   = \CI::input()->post('lastname');
            $save['email']      = \CI::input()->post('email');
            $save['username']   = \CI::input()->post('username');
            $save['group_id']   = \CI::input()->post('group_id');
            
            if (\CI::input()->post('password') != '' || !$id)
            {
                $save['password'] = \CI::input()->post('password');
            }

            \CI::auth()->save($save);
            \CI::session()->set_flashdata('message', lang('message_user_saved'));
            
            //go back to the customer list
            redirect('admin/users');
        }
    }

    public function groups()
    {
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('<div class="error">', '</div>');

        $data['page_title'] = 'Administrators Group';
        $data['groups']     = \DB\DB::get('admin_groups');

        $this->view('user_groups', $data);
    }

    public function group_form($id = false)
    {   
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');
        \CI::form_validation()->set_error_delimiters('<div class="error">', '</div>');

        $data['page_title'] = 'Administrators Group Form';
        $data['group_id']           = '';
        $data['group_name']         = '';
        $data['group_description']  = '';

        if($id){   
           
            $group = \DB\DB::getRow('admin_groups', ['group_id'=>$id]);

            if (!$group){
                \CI::session()->set_flashdata('message', 'Group not found');
                redirect('admin/users/groups');
            }
            //set values to db values
            $data['group_id']           = $group->group_id;
            $data['group_name']         = $group->group_name;
            $data['group_description']  = $group->group_description;
    
        }
        
        \CI::form_validation()->set_rules('group_name', 'Group Name', 'trim|max_length[32]|required');
        \CI::form_validation()->set_rules('group_description', 'Group Description', 'trim');
        
        
        if (\CI::form_validation()->run() == FALSE){
            $this->view('user_groups_form', $data);
        }else{
            $save['group_name']         = \CI::input()->post('group_name');
            $save['group_description']   = \CI::input()->post('group_description');
           
            if($id){
                \DB\DB::update('admin_groups', ['group_id'=>$id], $save);
            }else{
                \DB\DB::save('admin_groups', $save);
            }
            
            \CI::session()->set_flashdata('message', 'Data saved successfully');
            
            redirect('admin/users/groups');
        }
    }

    public function group_permissions($group_id = 0)
    {
       $group = \DB\DB::getRow('admin_groups', ['group_id'=>$group_id]);
       if(!$group){
        redirect('admin/users/groups');
       }

       if(\CI::input()->post()){
        foreach(\CI::input()->post() as $post){
            $json[] = $post;
        }
        \DB\DB::update('admin_groups', ['group_id'=>$group_id], ['group_permissions'=>json_encode($json)]);
        \CI::session()->set_flashdata('message', 'Data saved successfully');
        redirect('admin/users/groups/permissions/'.$group_id);
       }

       $data['group']               = $group;
       $data['group_permissions']   = @implode(json_decode($group->group_permissions), ',');
       $data['page_title']          = 'Set Permissions for '.$group->group_name;
       $this->view('user_groups_permissions', $data);
        
    }
}