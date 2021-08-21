<?php namespace GoCart\Controller;
/**
 * Account Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    shopController
 * @author      Olaiya Seguun
 * @link        https://twitter.com/massivebrains00
 */

class ShopController extends Front { 


    public function __construct()
    {
        parent::__construct(); 
        \CI::load()->model('products');       
    }

    public function index($slug = '')
    {
        
        $data['info']  = \DB\DB::getRow('customers_shop_information', ['shop_slug'=>$slug]);
        if(!$data['info'])
            redirect(site_url());

        $data['user']               = \DB\DB::getRow('customers', ['id'=>$data['info']->customer_id]);

        if(!$data['user'])
            redirect(site_url());

        $data['trending']           = \CI::products()->trending();
        $this->view('user_homepage', $data);

    }

    public function store($slug = '', $sort='id', $dir = "ASC", $page = 0) 
    {

         $shop  = \DB\DB::getRow('customers_shop_information', ['shop_slug'=>$slug]);
        if(!$shop)
            redirect(site_url());

        $data['info'] = $shop;

        \CI::lang()->load('categories');
        //define the URL for pagination
        $pagination_base_url = site_url('store/'.$slug.'/'.$sort.'/'.$dir);

        //how many products do we want to display per page?
        //this is configurable from the admin settings page.
        $per_page = config_item('products_per_page');

        //grab the categories
        $data['total_products'] = \DB\DB::numRows('products', ['customer_id'=>$shop->customer_id]);
        $data['products'] = \CI::Products()->getShopProducts($shop->customer_id, $per_page, $page, $sort, $dir);
        

        $data['sort']     = $sort;
        $data['dir']      = $dir;
        $data['slug']     = $slug;
        $data['page']     = $page;
        
        //load up the pagination library
        \CI::load()->library('pagination');
        $config['base_url']         = $pagination_base_url;
        $config['uri_segment']      = 5;
        $config['per_page']         = $per_page;
        $config['num_links']        = 3;
        $config['total_rows']       = $data['total_products'];

        $data['config']   = $config;

        //load the view
        $this->view('categories/user_products', $data);
    }

    
}
