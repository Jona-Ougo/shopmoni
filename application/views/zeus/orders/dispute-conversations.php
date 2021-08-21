
<div class="page-header">
    <h1>Dispute Conversations</h1>
</div>

<div id="wrapper">
    <div id="chat">
        <div id="errors_box">
            <p class="error" style="padding: 0"></p>
        </div>

        <div id="msg_cont">
            <div id="messages">

            </div>
        </div>

        <?php
        $admin =  CI::session()->userdata('zeus');
        ?>

        <div id="input_msg">
            <div><input data-orderid="<?php echo $order_id; ?>" data-userid="<?php echo $admin['id']; ?>" data-disputeid="<?php echo $dispute_id; ?>" id="zeus-conversation" placeholder="Add new conversation here" style="width: 82%; height: 35px; padding-left: 5px;"> <button id="submit-zeus-conversation" class="btn btn-success" style="width: 17%; height: 35px;">send>></button></div>
        </div>
    </div>
</div>
