<?php namespace GoCart\Controller;
/**
 * Page Class 
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Page
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class Page extends Front{

    public function homepage() 
    {

        \CI::load()->model('products');

        //Mobile Phone (395), Consumer Electronics (105), Fashion (97), 
        //Power Generator Set (111), Home Appliances (366), Computer Hardware / Software (109),
        //
        \CI::db()->where_in('id', [395, 105, 97, 111, 366, 109]);
        \CI::db()->where(['enabled_1' => \CI::Login()->customer()->group_id]);
        $data['categories'] = \CI::db()->get('categories')->result_array();

        $today = date('Y-m-d H:i:s');
        $adminStatus = 'approved';
        $data['homeSlider']         = [];
        $data['homeSliderSide']     = [];
        $data['homeBottomLong']     = [];
        $data['homeBelowTrending']  = [];

        $data['trending']           = \CI::products()->trending();
        $data['topsearched']        = \CI::products()->topSearched();
        $data['madeinnigeria']      = \CI::products()->getProducts(85, 20, 0, 'id', 'DESC');

       if($homeSlider = \DB\DB::getRow('banner_collections', ['code'=>HOME_CENTRAL])){
            $query = \CI::db()->where('banner_collection_id', $homeSlider->banner_collection_id);
            $query = \CI::db()->where('enable_date <=', $today);
            $query = \CI::db()->where('disable_date >=', $today);
           $query = \CI::db()->where('admin_status =', $adminStatus);
            $query = \CI::db()->get('banners');
            $data['homeSlider'] = $query->result();
       }

       if($homeSliderSide = \DB\DB::getRow('banner_collections', ['code'=>HOME_SIDE])){
            $query = \CI::db()->where('banner_collection_id', $homeSliderSide->banner_collection_id);
            $query = \CI::db()->where('enable_date <=', $today);
            $query = \CI::db()->where('disable_date >=', $today);
           $query = \CI::db()->where('admin_status =', $adminStatus);
            $query = \CI::db()->get('banners')->result();
            $data['homeSliderSide'] = $query;
       }

       if($homeBannerCol12 = \DB\DB::getRow('banner_collections', ['code'=>HOME_BANNER_COL_12])){
            $query = \CI::db()->where('banner_collection_id', $homeBannerCol12->banner_collection_id);
            $query = \CI::db()->where('enable_date <=', $today);
            $query = \CI::db()->where('disable_date >=', $today);
           $query = \CI::db()->where('admin_status =', $adminStatus);
            $query = \CI::db()->get('banners')->result();
            $data['homeBannerCol12'] = $query;
       } 

       if($homeBannerColX = \DB\DB::getRow('banner_collections', ['code'=>HOME_BANNER_COL_X])){
            $query = \CI::db()->where('banner_collection_id', $homeBannerColX->banner_collection_id);
            $query = \CI::db()->where('enable_date <=', $today);
            $query = \CI::db()->where('disable_date >=', $today);
           $query = \CI::db()->where('admin_status =', $adminStatus);
            $query = \CI::db()->get('banners')->result();
            $data['homeBannerColX'] = $query;
       }

       if($homeBelowTrending = \DB\DB::getRow('banner_collections', ['code'=>HOME_BANNER_BELOW_TRENDING])){
            $query = \CI::db()->where('banner_collection_id', $homeBelowTrending->banner_collection_id);
            $query = \CI::db()->where('enable_date <=', $today);
            $query = \CI::db()->where('disable_date >=', $today);
            $query = \CI::db()->where('admin_status =', $adminStatus);
            $query = \CI::db()->get('banners')->result();
            $data['homeBelowTrending'] = $query;
       }

        if(file_exists(FCPATH.'themes/'.config_item('theme').'/views/homepage.php')){
            $this->view('homepage', $data);
            return;
        }else{
            if(config_item('homepage')){
                if(isset($this->pages['all'][config_item('homepage')])){
                    $this->index($this->pages['all'][config_item('homepage')]->slug, $data);
                    return;
                }
            }
        }

        $this->view('homepage_fallback', $data);
    }

    public function show404()
    {
        $this->view('404');
    }

    public function index($slug=false, $show_title=true)
    {

        $page = false;

        //this means there's a slug, lets see what's going on.
        foreach($this->pages['all'] as $p){
            if($p->slug == $slug){
                $page = $p;
                continue;
            }
        }

        if(!$page){
            throw_404();
        }else{
            //create view variable
            $data['page_title'] = false;
            if($show_title){
                $data['page_title'] = $page->title;
            }
            $data['meta']       = $page->meta;
            $data['seo_title']  = (!empty($page->seo_title))?$page->seo_title:$page->title;
            $data['page']       = $page;

            //load the view
            $this->view('page', $data);
        }
    }

    public function api($slug)
    {
        \CI::load()->language('page');

        $page = $this->Page_model->slug($slug);

        if(!$page){
            $json = json_encode(['error'=>lang('error_page_not_found')]);
        }else{
            $json = json_encode($page);
        }

        $this->view('json', ['json'=>json_encode($json)]);
    }
}

/* End of file Page.php */
/* Location: ./GoCart/controllers/Page.php */