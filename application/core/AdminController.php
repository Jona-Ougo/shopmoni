<?php namespace GoCart\Controller;
/**
 * Dashboard Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Admin
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */
//\CI::Login()->customer()->id (Let me keep this here. I look for it all the time).

class Admin extends \GoCart\Controller {

    public function __construct()
    {
        parent::__construct();
        
        \CI::lang()->load('admin_common');
        \CI::load()->helper('db');
        \CI::lang()->load('common');
        //\CI::auth()->isLoggedIn(uri_string());
        //Remember to do the cookie admin stuff!!
        \CI::Login()->isLoggedIn(uri_string());
        //\CI::output()->enable_profiler(TRUE);

        //Had to retrieve the logged in customer again. dont know why the $this->customer->use_shop is failing the if condition below.
        $loggedinCustomer = \DB\DB::getRow('customers', ['id'=>\CI::Login()->customer()->id]);
        
        //If the customer hasnt activated shop, he/she should not have access to any of the admin routes.
        if($loggedinCustomer->use_shop != 1)
            redirect('account');
    }

    public function view($view, $vars = [], $string=false)
    {
        $vars['this'] = $this;

        if($string)
        {
            $result  = $this->views->get('admin/header', $vars);
            $result .= $this->views->get('admin/'.$view, $vars);
            $result .= $this->views->get('admin/footer', $vars);
            
            return $result;
        }
        else
        {
            $this->views->show('admin/header', $vars);
            $this->views->show('admin/'.$view, $vars);
            $this->views->show('admin/footer', $vars);
        }
    }
    
    /*
    This function simply calls \->view()
    */
    public function partial($view, $vars = [], $string=false)
    {
        $vars['this'] = $this;
        
        if($string)
        {
            return $this->views->get('admin/'.$view, $vars);
        }
        else
        {
            $this->views->show('admin/'.$view, $vars);
        }
    }

}