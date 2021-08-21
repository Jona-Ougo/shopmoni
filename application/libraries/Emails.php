<?php namespace GoCart;

class Emails {

    
    static function send_email($email,$subject,$msg) 
    {

        $api_key= "key-f9c101361bccf892331187a1f07120dc";/* Api Key got from https://mailgun.com/cp/my_account */
        $domain = "mg.tft-spark.co";/* Domain Name you given to Mailgun */

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages');
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'from' => 'ShopMoni <reply@shopmoni.com>',
            'to' => $email,
            'subject' => $subject,
            'html' => $msg
            ));

        //Todo: Open up so emails can go through
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    static function registration($customer)
    {
        
        $cannedMessage  = \CI::db()->where('id', '6')->get('canned_messages')->row_array();

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);

        $link = site_url('confirm-email/'.$customer['emailconfirmcode']);
        //fields for the template
        $fields = [ 'site_name'     =>config_item('company_name'),
        'customer_name' => $customer['firstname'],
        'link'          => $link, 
        'url'           =>base_url()
        ];

        //render the subject and content to a variable
        $subject = $twig->render($cannedMessage['subject'], $fields);
        $content = $twig->render($cannedMessage['content'], $fields);

        //load in the view class so we can get our order view
        $view = \GoCart\Libraries\View::getInstance();

        $data['subject']    = $subject;
        $data['link']       = $link;
        $data['content']    = $content;

        $emailBody = $view->get('email_registration', $data);

        self::send_email($customer['email'],$subject,$emailBody);
    }

    static function giftCardNotification($giftCard)
    {
        $email = \Swift_Message::newInstance();
        $cannedMessage = \CI::db()->where('id', '1')->get('canned_messages')->row_array();

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);

        //fields for the template
        $fields = [ 'site_name'=>config_item('company_name'),
        'code' => $giftCard['code'],
        'amount'=>$giftCard['beginning_amount'],
        'from'=>$giftCard['from'],
        'personal_message'=>$giftCard['personal_message'],
        'url'=>base_url()
        ];
        //render the subject and content to a variable
        $subject = $twig->render($cannedMessage['subject'], $fields);
        $content = $twig->render($cannedMessage['content'], $fields);

        self::send_email($giftCard['to_email'],$subject,$content);

    }

    /*
    This function send an email notification when the admins resets password
    */
    static function resetPassword($password, $adminEmail)
    {
        $email = \Swift_Message::newInstance();

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);


        $fields = ['site_name'=>config_item('company_name'), 'password'=>$password];

        $subject = $twig->render(lang('reset_password_subject'), $fields);
        $content = $twig->render(lang('reset_password_content'), $fields);

        self::send_email($adminEmail,$subject,$content);
    }

    /*
    This function send an email notification when the customer resets password
    */
    static function resetPasswordCustomer($password, $customerEmail)
    {
        $email = \Swift_Message::newInstance();

        $cannedMessage = \CI::db()->where('id', '2')->get('canned_messages')->row_array();

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);

        //fields for the template
        $fields = ['site_name'=>config_item('company_name'), 'email'=>$customeEmail, 'password'=>$password];

        //render the subject and content to a variable
        $subject = $twig->render($cannedMessage['subject'], $fields);
        $content = $twig->render($cannedMessage['content'], $fields);

        self::send_email($customerEmail,$subject,$content);

    }

    /*
    Order email notification
    */
    static function sendOrderNotification($order)
    {
        $email = \Swift_Message::newInstance();
        $cannedMessage['content'] = html_entity_decode($order['content']);
        $cannedMessage['subject'] = $order['subject'];

        self::send_email($order['recipient'],$cannedMessage['subject'],$cannedMessage['content']);
    }

    /*
    Place Order
    */
    static function Order($order)
    {

        if($order->is_guest)
        {
                    //if the customer is a guest, get their name from the Billing address
            $customerName = $order->billing_firstname.' '.$order->billing_lastname;
            $customerEmail = $order->billing_email;
        }
        else
        {
            $customerName = $order->firstname.' '.$order->lastname;
            $customerEmail = $order->email;
        }

        $cannedMessage = \CI::db()->where('id', '7')->get('canned_messages')->row_array();

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);

        //load in the view class so we can get our order view
        $view = \GoCart\Libraries\View::getInstance();
        
        $fields = ['customer_name'=>$customerName, 'site_name'=>config_item('company_name'), 'order_summary'=>$view->get('order_summary_email', ['order'=>$order])];
        $subject = $twig->render($cannedMessage['subject'], $fields);
        $content = $twig->render($cannedMessage['content'], $fields);

        $email = \Swift_Message::newInstance();

        self::send_email($customerEmail,$subject,$content);
    }

    static function test($data)
    {
        $email          = \Swift_Message::newInstance();
        
        $subject = 'some Subject';
        $content = 'Some content';

        
        self::send_email($data['email'],$subject,$content);
    }

}
