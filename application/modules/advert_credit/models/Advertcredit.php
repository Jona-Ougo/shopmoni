<?php


Class AdvertCredit extends CI_Model
{

    public function advert_credits()
    {
        return CI::db()->order_by('advert_credit_id', 'ASC')->get('advert_credit')->result();
    }

    public function enabled_advert_credits($status = 'enabled')
    {
        return CI::db()->where('status', $status)->order_by('advert_credit_id', 'ASC')->get('advert_credit')->result();
    }
    
    public function advert_credit($advertCreditId)
    {
        return CI::db()->where('advert_credit_id', $advertCreditId)->get('advert_credit')->row();
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

    public function update_advert_credit($id, $value, $amount)
    {
        if (!empty($value) && !empty($amount)) {

            CI::db()->where('advert_credit_id', $id);

            $insertParams = [
                'value' => $value,
                'amount' => $amount
            ];

            CI::db()->update('advert_credit', $insertParams);
        }

    }

    public function remove_advert_credit($advertCreditId)
    {
        CI::db()->where('advert_credit_id', $advertCreditId);

        $insertParams = [
            'status' => 'disabled'
        ];

        CI::db()->update('advert_credit', $insertParams);
    }

}