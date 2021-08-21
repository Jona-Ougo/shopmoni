<?php

namespace GoCart\Controller;

use CI;

class ZeusDispute extends Zeus {

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = 'admin';
        \CI::load()->model('DisputeConversations');
    }

    public function log_conversations()
    {
        CI::load()->helper('string');

        $inputs = CI::input()->post();
        $order_id  = $inputs['order_id'];
        $disputeId = $inputs['dispute_id'];

        //log into dispute conversation
        $user_id  = $inputs['admin_id'];
        $comment = $inputs['comment'];

        CI::DisputeConversations()->log_zeus_conversation($user_id, $comment, $disputeId, $order_id);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully'
        ]);

    }

    public function fetch_conversations($order_id)
    {
        $disputeConversations = CI::DisputeConversations()->fetch_dispute_conversations($order_id);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully',
            'data' => $disputeConversations
        ]);

    }

    public function fetchCustomer($userId)
    {
        $customer = CI::Customers()->get_customer($userId);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully',
            'data' => $customer
        ]);

    }


}