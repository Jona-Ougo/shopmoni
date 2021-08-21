<?php


Class DisputeConversations extends CI_Model
{


    public function log_conversation($user, $comment, $disputeId, $orderId)
    {
        $data = [
            'reason' => $comment,
            'user_id'  => $user,
            'dispute_id' => $disputeId,
            'order_id' => $orderId
        ];

        CI::db()->insert('dispute_conversations', $data);
    }

    public function log_zeus_conversation($user, $comment, $disputeId, $orderId)
    {
        $data = [
            'reason' => $comment,
            'admin_id'  => $user,
            'dispute_id' => $disputeId,
            'order_id' => $orderId
        ];

        CI::db()->insert('dispute_conversations', $data);
    }

    public function fetch_dispute_conversations($order_id)
    {
        CI::db()->select('customers.firstname, customers.lastname, dispute_conversations.*');
        CI::db()->where('order_id', $order_id);
        CI::db()->join('customers', 'customers.id = dispute_conversations.user_id', 'left');
        return CI::db()->get('dispute_conversations')->result();

    }

}
