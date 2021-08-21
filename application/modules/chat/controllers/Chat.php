<?php namespace GoCart\Controller;

class Chat extends Front {


    function __construct()
    {
        parent::__construct();
    } 

    public function login()
    {
        $data = \CI::input()->post();

        if(isset($data['sender_name']) && isset($data['sender_email']) && isset($data['customer_id'])){

            $where = ['sender_email' => trim(strtolower($data['sender_email'])), 'customer_id' => $data['customer_id']];

            if(\DB\DB::numRows('conversations', $where) < 1){

                \CI::load()->helper('string');
                $data['sender_code']        = random_string('alnum', 16);
                $data['recipient_code']     = random_string('alnum', 16);
                $data['created_at']         = date('Y-m-d H:i:s');

                $id = \DB\DB::create('conversations', $data);

                $this->response(['conversation_id' => $id]);

            }else{

                $conversation = \DB\DB::first('conversations', $where);

                $this->messages($conversation->id);
            }
            
        }

        $this->response([]);
    }


    public function messages($conversation_id = 0)
    {   

        $post       = \CI::input()->post();
        $lastId     = 0;
        
        if(array_key_exists('lastId', $post))
            $lastId = $post['lastId'];

        if(array_key_exists('conversation_id', $post))
            $conversation_id = $post['conversation_id'];

        $conversation = \DB\DB::first('conversations', ['id' => $conversation_id]);
        
        $data = $messages = [];

        $i = 0;

        if($conversation != null){

            \CI::db()->where(['conversation_id'=>$conversation->id]);

            if((int)$lastId != 0)
                \CI::db()->where('id >', $lastId);

            \CI::db()->order_by('created_at', 'ASC');
            \CI::db()->limit(100);

            $allmessages = \CI::db()->get('messages')->result();

            foreach($allmessages as $row){

                $messages[$i]['own']  = 0;
                $messages[$i]['name'] = 'You';

                if($row->sender == $conversation->sender_code){

                    $messages[$i]['own']    = 1;
                    $messages[$i]['name']   = $conversation->sender_name; 

                }

                $messages[$i]['message']        = $row->message;
                $messages[$i]['id']             = $row->id;
                $i++;
            }

            $data['messages']           = $messages;
            $data['sender_name']        = $conversation->sender_name;
            $data['conversation_id']    = $conversation->id;

            $this->response($data);
        }
    }

    public function savemessage($id = 0)
    {

        $data       = \CI::input()->post();

        if(!array_key_exists('conversation_id', $data) || (int)$data['conversation_id'] == 0)
            return $this->response($data);

        if(!array_key_exists('message', $data))
            return $this->response($data);

        $conversation = \DB\DB::first('conversations', ['id' => $data['conversation_id']]);

        if(\CI::Login()->customer()->id == $conversation->customer_id){

            $data['sender']     = $conversation->recipient_code;

        }else{

            $data['sender']     = $conversation->sender_code;
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['read_at']    = NULL;
        $id                 = \DB\DB::create('messages', $data);
        $data['id']         = $id;

        $this->response($data);
    }

    public function response($data = [])
    {
        \CI::output()->set_content_type('application/json');
        \CI::output()->set_status_header(200);
        \CI::output()->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        \CI::output()->set_output(json_encode($data, JSON_PRETTY_PRINT))->_display();
        exit;
    }

}
