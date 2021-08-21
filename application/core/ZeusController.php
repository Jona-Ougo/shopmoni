<?php namespace GoCart\Controller;
/**
 * Zeus Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Zeus
 * @author      Olaiya Segun
 * @link        https://twitter.com/massivebrains00
 */

class Zeus extends \GoCart\Controller {

    public function __construct()
    {
        parent::__construct();
        
        \CI::lang()->load('admin_common');
        \CI::load()->helper('db');
        \CI::lang()->load('common');
        //\CI::auth()->isLoggedIn(uri_string());
        //Remember to do the cookie zeus stuff!!
        \CI::auth()->isZeusLoggedIn(uri_string());
        //\CI::output()->enable_profiler(TRUE);

        //This is kept in a property so that i can change it when i wanna load view from any view/admin path.
        $this->viewFolder = 'zeus';
    }

    public function view($view, $vars = [], $string=false)
    {
        $vars['this'] = $this;

        if($string)
        {
            $result  = $this->views->get('zeus/header', $vars);
            $result .= $this->views->get($this->viewFolder.'/'.$view, $vars);
            $result .= $this->views->get('zeus/footer', $vars);
            
            return $result;
        }
        else
        {
            $this->views->show('zeus/header', $vars);
            $this->views->show($this->viewFolder.'/'.$view, $vars);
            $this->views->show('zeus/footer', $vars);
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
            return $this->views->get('zeus/'.$view, $vars);
        }
        else
        {
            $this->views->show('zeus/'.$view, $vars);
        }
    }

}