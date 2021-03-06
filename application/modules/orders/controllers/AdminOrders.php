<?php namespace GoCart\Controller;

/**
 * AdminOrders Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    AdminOrders
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class AdminOrders extends Admin {

    private $customer;

    public function __construct()
    {
        parent::__construct();

        \CI::load()->model('Orders');
        \CI::load()->model('Search');
        \CI::load()->model('Locations');
        \CI::load()->helper(array('formatting'));
        \CI::lang()->load('orders');
        $this->customer = \CI::Login()->customer();
    }

    public function index($sort_by='order_number',$sort_order='desc', $code=0, $page=0, $rows=100)
    {

        //if they submitted an export form do the export
        if(\CI::input()->post('submit') == 'export')
        {
            \CI::load()->model('Customers');
            \CI::load()->helper('download_helper');
            $post = \CI::input()->post(null, false);
            $term = (object)$post;

            $data['orders'] = \CI::Orders()->getShopOrders($term);

            foreach($data['orders'] as &$o)
            {
                //Do something here.
                $o->items = \CI::Orders()->getItems($o->id, $this->customer->id);
            }

            force_download('orders.json', json_encode($data));

            return;
        }

        \CI::load()->helper('form');
        \CI::load()->helper('date');
        $data['message'] = \CI::session()->flashdata('message');
        $data['page_title'] = lang('orders');
        $data['code'] = $code;
        $term = false;

        $post = \CI::input()->post(null, false);
        if($post)
        {
            //if the term is in post, save it to the db and give me a reference
            $term = json_encode($post);
            $code = \CI::Search()->recordTerm($term);
            $data['code'] = $code;
            //reset the term to an object for use
            $term   = (object)$post;
        }
        elseif ($code)
        {
            $term = \CI::Search()->getTerm($code);
            $term = json_decode($term);
        }

        $data['term'] = $term;
        $data['orders'] = \CI::Orders()->getShopOrders($term, $sort_by, $sort_order, $rows, $page);
        $data['total'] = \CI::Orders()->getShopOrderCount($term);

        \CI::load()->library('pagination');

        $config['base_url'] = site_url('admin/orders/index/'.$sort_by.'/'.$sort_order.'/'.$code.'/');
        $config['total_rows'] = $data['total'];
        $config['per_page'] = $rows;
        $config['uri_segment'] = 7;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        \CI::pagination()->initialize($config);
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        $this->view('orders', $data);
    }

    public function export()
    {
        \CI::load()->model('Customers');
        \CI::load()->helper('download_helper');
        $post = \CI::input()->post(null, false);
        $term = (object)$post;

        $data['orders'] = \CI::Orders()->getShopOrders($term);

        foreach($data['orders'] as &$o)
        {
            $o->items = \CI::Orders()->getItems($o->id, $this->customer->id);
        }

        force_download_content('orders.xml', $this->view('orders_xml', $data, true));
    }

    public function order($orderNumber)
    {

        $data['order'] = \CI::Orders()->getOrder($orderNumber);

        if(!$data['order'])
        {
            redirect('admin/orders');
        }

        \CI::form_validation()->set_rules('notes', 'lang:notes');
        \CI::form_validation()->set_rules('status', 'lang:status', 'required');

        if (\CI::form_validation()->run() == TRUE)
        {

            $save['order_id']       = $data['order']->id;
            $save['status_notes']   = \CI::input()->post('notes');

            $status = \CI::input()->post('status');
            if(trim(strtolower($status)) != 'cart')
            {
                $save['item_status'] = \CI::input()->post('status');
            }
            
            /*
            * Because an order can have multiple products from diffrent merchants.
            * Each merchant cannot process at the same time
            * Hence, individual merchants need to do their updates separately ON A PERTICULAR ORDER THAT HAS THEIR PRODUCTS.
            * So the below updates the status of this currently logged in merchant for this order. 
            * Once all merchants tied to an order update their status to say complete, we can then consider the original order complete.
            */

            $where = ['order_id'=>$data['order']->id, 'customer_id'=>$this->customer->id];
            \DB\DB::update('order_items', $where, $save); 
            $data['message']        = lang('message_order_updated');
        }

        $this->view('order', $data);
    }

    public function packing_slip($order_number)
    {
        \CI::load()->helper('date');
        $data['order'] = \CI::Orders()->getOrder($order_number);

        $this->partial('packing_slip', $data);
    }

    public function edit_status()
    {
        \CI::auth()->isLoggedIn();
        $order['id'] = \CI::input()->post('id');
        $order['status'] = \CI::input()->post('status');

        \CI::Orders()->saveOrder($order);

        echo url_title($order['status']);
    }

    //Update status for customer on a specific order : might be a part of the parent order.
    public function edit_status_for_customer()
    {
        $order_id       = \CI::input()->post('id');
        $customer_id    = \CI::input()->post('customer_id');
        $save           = ['item_status'=>\CI::input()->post('status')];
        \DB\DB::update('order_items', ['order_id'=>$order_id, 'customer_id'=>$customer_id], $save);

        echo url_title(\CI::input()->post('status'));
    }

    public function sendNotification($order_id='')
    {
        // send the message
        $config['mailtype'] = 'html';
        \CI::load()->library('email');
        \CI::email()->initialize($config);
        \CI::email()->from(config_item('email'), config_item('company_name'));
        \CI::email()->to(\CI::input()->post('recipient'));
        \CI::email()->subject(\CI::input()->post('subject'));
        \CI::email()->message(html_entity_decode(\CI::input()->post('content')));
        \CI::email()->send();

        \CI::session()->set_flashdata('message', lang('sent_notification_message'));
        redirect('admin/orders/order/'.$order_id);
    }

    public function delete($id)
    {
        \CI::Orders()->delete($id);
        \CI::session()->set_flashdata('message', lang('message_order_deleted'));

        //redirect as to change the url
        redirect('admin/orders');
    }
}
