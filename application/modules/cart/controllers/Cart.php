<?php namespace GoCart\Controller;
/**
 * Cart Class
 *
 * @package     GoCart
 * @subpackage  Controllers
 * @category    Cart
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */

class Cart extends Front {

    public function summary()
    {
        $data['inventoryCheck'] = \GC::checkInventory();
        $this->partial('cart_summary', $data);
    }

    public function addToCart()
    {
        // Get our inputs
        $productId  = intval( \CI::input()->post('id') );
        $quantity   = intval( \CI::input()->post('quantity') );
        $options    = \CI::input()->post('option');
        //echo $productId.' '.$quantity.' '.$options; die;
        $message = \GC::insertItem(['product'=>$productId, 'quantity'=>$quantity, 'postedOptions'=>$options]);
        
        //save the cart
        \GC::saveCart();

        $delete = [
        'customer_id'=>\CI::Login()->customer()->id,
        'product_id'=>$productId
        ];

        //Incase the product is in the wishlist, delete it.
        \DB\DB::delete('customer_wishlist', $delete);

        echo $message;
    }

    public function updateCart()
    {
        // see if we have an update for the cart
        $product_id     = \CI::input()->post('product_id');
        $quantity       = \CI::input()->post('quantity');
        $item           = \GC::getCartItem($product_id);
        
        if(!$item){
            echo json_encode(['error'=>lang('error_product_not_found')]);
        }
        
        if(intval($quantity) === 0){
            \GC::removeItem($product_id);
            echo json_encode(['success'=>true]);
        }else{
            //create a new list of relevant items
            $item->quantity = $quantity;
            $insert = \GC::insertItem(['product'=>$item, 'quantity'=>$quantity]);
            echo $insert;
        }

        //save the cart updates
        \GC::saveCart();
        return true;
    }

    public function submitCoupon()
    {
        $coupon = \GC::addCoupon(\CI::input()->post('coupon'));
        \GC::saveCart();
        echo $coupon;
    }

    public function submitGiftCard()
    {
        //get the giftcards from the database
        $giftCard = \CI::GiftCards()->getGiftCard(\CI::input()->post('gift_card'));

        if(!$giftCard)
        {
            echo json_encode(['error'=>lang('gift_card_not_exist')]);
        }
        else
        {
            //does the giftcard have any value left?
            if(\CI::GiftCards()->isValid($giftCard))
            {
                $message = \GC::addGiftCard($giftCard);
                if($message['success'])
                {
                    \GC::saveCart();
                    echo json_encode(['message'=>lang('gift_card_balance_applied')]);
                }
                else
                {
                    echo json_encode($message);
                }
            }
            else
            {
                echo json_encode(['error'=>lang('gift_card_zero_balance')]);
            }
        }
    }

    public function addToWishList($product_id = 0)
    {
      if($product_id <= 0){
        echo 0;
      }else{
        $where = [
        'customer_id'=>\CI::Login()->customer()->id,
        'product_id'=>$product_id
        ];

        if(\DB\DB::numRows('customer_wishlist', $where) > 0){
            echo 2;
            die;
        } 
         
        $save = [
        'customer_id'=>\CI::Login()->customer()->id,
        'product_id'=>$product_id,
        'created_at'=>date('Y-m-d H:i:s')
        ];
        \DB\DB::save('customer_wishlist', $save);
        echo 1;
      }
    }

    public function myWishList($sort='id', $dir="ASC", $page=0) {

        //define the URL for pagination
        $pagination_base_url = site_url('cart/wishlist/'.$sort.'/'.$dir);

        \CI::load()->model('products');
        //this is configurable from the admin settings page.
        $per_page = config_item('products_per_page');
        $ids = [0];
        $wishlist = \DB\DB::get('customer_wishlist', ['customer_id'=>\CI::Login()->customer()->id]);
        foreach($wishlist as $row){
            $ids[] = $row->product_id;
        }
        //getByProductIds($ids = [], $limit = 50, $offset = 0, $by = 'name', $sort = 'DESC')
        $products = \CI::Products()->getByProductIds($ids, $per_page, $page, $sort, $dir);


        $list['sort']     = $sort;
        $list['dir']      = $dir;
        $list['page']     = $page;
        $list['products'] = $products;
        
        //load up the pagination library
        \CI::load()->library('pagination');
        $config['base_url']         = $pagination_base_url;
        $config['uri_segment']      = 3;
        $config['per_page']         = $per_page;
        $config['num_links']        = 3;
        $config['total_rows']       = count($wishlist);

        $list['config']   = $config;

        //load the view
        $this->view('wishlist', $list);
    }

}

