<?php

namespace GoCart\Controller;

use Carbon\Carbon;
use CI;
use GoCart\Emails;
use GoCart\SwiftEmails;
use Omnipay\Omnipay;

class Dispute extends Front {

    public function log_dispute()
    {
        CI::load()->helper('string');

        $inputs = CI::input()->post();
        $order_id  = $inputs['order_id'];
        $open_by = $inputs['post_by'];

        $disputeAlreadyLogged = CI::Dispute()->getTableValueByField('dispute', 'order_id', $order_id);

        if ($disputeAlreadyLogged) {

            $disputeId = $disputeAlreadyLogged->dispute_id;

            //check dispute status
            if ($disputeAlreadyLogged->status == "closed") {

                //update it to open
                $new_status = 'open';
                CI::Dispute()->update_dispute_status($disputeAlreadyLogged->dispute_id, $new_status);
            }

        } else {

            $newDispute = CI::Dispute()->add_new_dispute($order_id, $open_by);
            CI::load()->library('email');


            //send email to customer and merchant here
            SwiftEmails::disputeCustomerEmail(\CI::Login()->customer(), $inputs['order_number']);

            //fetch merchant email
            $merchantEmail = CI::Dispute()->fetch_merchant_email($order_id);
            SwiftEmails::disputeMerchantEmail( $merchantEmail->email, \CI::Login()->customer(), $inputs['order_number']);

            //send email to customer and merchant
            $disputeId = $newDispute;

        }

        //log into dispute conversation
        $user_id  = $inputs['user_id'];
        $comment = $inputs['comment'];

        CI::DisputeConversations()->log_conversation($user_id, $comment, $disputeId, $order_id);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully'
        ]);


    }

    public function disputeConversations($orderNumber)
    {
        $order = CI::Orders()->getOrder($orderNumber);
        $orderCustomer  = CI::Customers()->get_customer($order->customer_id);

        $disputeConversations = CI::DisputeConversations()->fetch_dispute_conversations($order->id);

        $disputeId = $disputeConversations[0]->dispute_id;

        if (\CI::Login()->isLoggedIn(false,false)) {
            $customer = CI::Login()->customer();
            $this->view('disputeConversations', [
                'conversations'=>$disputeConversations,
                'customer' => $customer,
                'order_id' => $order->id,
                'dispute_id' => $disputeId
            ]);
        } else {
            throw_404();
        }
    }

    public function log_conversations()
    {
        CI::load()->helper('string');

        $inputs = CI::input()->post();
        $order_id  = $inputs['order_id'];
        $disputeId = $inputs['dispute_id'];

        //log into dispute conversation
        $user_id  = $inputs['user_id'];
        $comment = $inputs['comment'];

        CI::DisputeConversations()->log_conversation($user_id, $comment, $disputeId, $order_id);

        $disputeConversations = CI::DisputeConversations()->fetch_dispute_conversations($order_id);

        echo json_encode([
            'status' => 'success',
            'message'=> 'conversation logged successfully',
            'data' => $disputeConversations
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


}