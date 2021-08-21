<?php namespace GoCart\Controller;



class AdminDispute extends Admin {

    private $customer;

    public function __construct()
    {
        parent::__construct();

        \CI::load()->model('DisputeConversations');
        $this->customer = \CI::Login()->customer();
    }

    public function log_conversations()
    {
        \CI::load()->helper('string');

        $inputs = \CI::input()->post();
        $order_id  = $inputs['order_id'];
        $disputeId = $inputs['dispute_id'];

        //log into dispute conversation
        $user_id  = $inputs['user_id'];
        $comment = $inputs['comment'];

        \CI::DisputeConversations()->log_conversation($user_id, $comment, $disputeId, $order_id);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully'
        ]);

    }

    public function fetch_conversations($order_id)
    {
        $disputeConversations = \CI::DisputeConversations()->fetch_dispute_conversations($order_id);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully',
            'data' => $disputeConversations
        ]);

    }
}
