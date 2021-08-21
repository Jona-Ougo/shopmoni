<?php namespace GoCart\Controller;
/**
 * Category Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Category
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class Category extends Front {

    public function index($slug = '', $sort='id', $dir="ASC", $page=0) {

        \CI::lang()->load('categories');
        //define the URL for pagination
        $pagination_base_url = site_url('category/'.$slug.'/'.$sort.'/'.$dir);

        //how many products do we want to display per page?
        //this is configurable from the admin settings page.
        $per_page = config_item('products_per_page');

        //grab the categories
        $categories = \CI::Categories()->get($slug, $sort, $dir, $page, $per_page);

        //no category? show 404
        if(!$categories){
            throw_404();
            return;
        }

        $customer = \CI::Login()->customer();

        \CI::db()->select('min(saleprice_'.$customer->group_id.') as minimum, max(saleprice_'.$customer->group_id.') as maximum');
        //\CI::db()->where(['primary_category'=>0]);
        $prices = \CI::db()->get('products')->row();
        

        $categories['sort']     = $sort;
        $categories['dir']      = $dir;
        $categories['slug']     = $slug;
        $categories['page']     = $page;
        $categories['min']      = $prices->minimum;
        $categories['max']      = $prices->maximum;
        
        //load up the pagination library
        \CI::load()->library('pagination');
        $config['base_url']         = $pagination_base_url;
        $config['uri_segment']      = 5;
        $config['per_page']         = $per_page;
        $config['num_links']        = 3;
        $config['total_rows']       = $categories['total_products'];

        $categories['config']   = $config;
        //$categories['category'] = $categories['category'];
        //\CI::pagination()->initialize($config);

        //load the view
        $this->view('categories/category', $categories);
    }


    public function shortcode($slug = false, $perPage = false)
    {
        if(!$perPage){
            $perPage = config_item('products_per_page');
        }

        $products = \CI::Categories()->get($slug, 'id', 'ASC', 0, $perPage);

        return $this->partial('categories/products', $products);
    }

    public function filter($slug = '', $type = '', $value = '', $sort = 'id', $dir = 'ASC', $page = 0) {

        \CI::lang()->load('categories');
        \CI::load()->model('products');
        //define the URL for pagination
        $pagination_base_url = site_url('filter/'.$type.'/'.$value.'/'.$sort.'/'.$dir);

        //how many products do we want to display per page?
        //this is configurable from the admin settings page.
        $per_page = config_item('products_per_page');
        $category = \DB\DB::get('categories', ['slug'=>$slug]); 
       
        $data['page_title'] = $value;
        $data['meta']       = '';
        $data['seo_title']  = $type;

        $data['total_products'] =\DB\DB::numRows('products', [$type=>$value]);
        $data['products']       =\CI::Products()->getProductByField($type, $value, $sort, $dir, $per_page, $page);

        $data['sort']     = $sort;
        $data['dir']      = $dir;
        $data['slug']     = $slug;
        $data['category'] = $category[0];
        
        //load up the pagination library
        \CI::load()->library('pagination');
        $config['base_url']         = $pagination_base_url;
        $config['uri_segment']      = 7;
        $config['per_page']         = $per_page;
        $config['num_links']        = 3;
        $config['total_rows']       = $data['total_products'];

        $data['config']   = $config;
        //\CI::pagination()->initialize($config);

        //load the view
        $this->view('categories/category', $data);
    }
}
