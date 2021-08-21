<div class="container">

    <div class="st-default main-wrapper clearfix">
        <div class="block block-breadcrumbs clearfix">
            <ul>
                <li class="home">
                    <a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
                    <span></span>
                </li>
                <li>Dispute Conversations</li>
            </ul>
        </div>
        <div class="main-page">

            <div id="msg_cont">
                <div id="messages">

                </div>
            </div>

            <?php
            $admin =  CI::session()->userdata('zeus');
            ?>

            <div id="input_msg">
                <div><input data-orderid="<?php echo $order_id; ?>" data-userid="<?php echo $customer->id; ?>" data-disputeid="<?php echo $dispute_id; ?>" id="conversation" placeholder="Add new conversation here" style="width: 82%; height: 35px; border: thin solid #4d4d4d; padding-left: 5px;"> <button id="submit-conversation" class="btn btn-success" style="width: 17%; height: 35px;">send>></button></div>
            </div>

        </div>  
    </div>
</div>
