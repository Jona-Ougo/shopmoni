<?php


Class Dispute extends CI_Model
{


    public function add_new_dispute($orderId, $customerId)
    {
        $data = [
                    'order_id' => $orderId,
                    'open_by'  => $customerId
                ];

        CI::db()->insert('dispute', $data);
        $insert_id = CI::db()->insert_id();

        return  $insert_id;


    }

    public function check_dispute_already_logged($order_id)
    {
        $checkDispute = CI::db()->where('order_id', $order_id)->get('dispute')->result();

        if ($checkDispute) {
            return true;
        }

        return false;
    }


    public function getTableValueByField($table, $field, $value)
    {
        return CI::db()->where($field, $value)->get($table)->row();
    }


    public function add_advert_credit($value, $amount)
    {
        if (!empty($value) && !empty($amount)) {

            $insertParams = [
                'value' => $value,
                'amount' => $amount
            ];

            CI::db()->insert('advert_credit', $insertParams);
        }

    }

    public function update_dispute_status($id, $status)
    {
        if (!empty($id) && !empty($status)) {

            CI::db()->where('dispute_id', $id);

            $insertParams = [
                'status' => $status
            ];

            CI::db()->update('dispute', $insertParams);
        }

    }

    public function fetch_merchant_email($order_id)
    {
        CI::db()->select('customers.email');
        CI::db()->where('dispute.order_id', $order_id);
        CI::db()->join('order_items', 'order_items.order_id = dispute.order_id', 'left');
        CI::db()->join('customers', 'customers.id = order_items.customer_id', 'left');
        return CI::db()->get('dispute')->row();

    }



}