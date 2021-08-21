<?php namespace GoCart\Controller;
/**
 * ZeusReports Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    ZeusReports
 * @author      Olaiya Segun
 * @link        http://twitter.com/massivebrains00
 */

class ZeusReports extends Zeus {

    var $customer_id = false;

    function __construct()
    {
        parent::__construct();
        _p('viewreports', true);
        \CI::load()->model(['Orders', 'Search']);
        \CI::load()->helper(array('formatting'));
        \CI::lang()->load('reports');
    }

    function index()
    {
        $data['page_title'] = lang('reports');
        $data['years'] = \CI::Orders()->getSalesYears();
        $this->view('reports/reports', $data);
    }

    function best_sellers()
    {
        $start = \CI::input()->post('start');
        $end = \CI::input()->post('end');
        $data['best_sellers'] = \CI::Orders()->getBestSellers($start, $end);

        $this->partial('reports/best_sellers', $data);
    }

    function sales()
    {
        $data['year'] = \CI::input()->post('year');
        $data['orders'] = \CI::Orders()->getGrossMonthlySales($data['year']);

        $this->partial('reports/sales', $data);
    }
}
