<fieldset>
    <legend>Account Information</legend>
    <?=form_open('my-account') ?>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Shop Name</label>
                <?=form_input(['name'=>'shop_name', 'class'=>'form-control', 'value'=> assign_value('shop_name', $customer['shop_name'])])?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">First Name</label>
            <?=form_input(['name'=>'firstname', 'class'=>'form-control', 'value'=> assign_value('firstname', $customer['firstname'])]) ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Last Name</label>
             <?=form_input(['name'=>'lastname','class'=>'form-control', 'value'=> assign_value('lastname', $customer['lastname'])])?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Email</label>
                <?=form_input(['name'=>'email', 'class'=>'form-control', 'value'=> assign_value('email', $customer['email'])]);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Phone</label>
                 <?=form_input(['name'=>'phone', 'class'=>'form-control', 'value'=> assign_value('phone', $customer['phone'])]);?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="checkbox" name="email_subscribe" value="1" <?php if((bool)$customer['email_subscribe']) { ?> checked="checked" <?php } ?>/> Subscribe to our mailing list
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="alert alert-info">
            If you do not wish to change your password. Leave both fields blank.
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Password</label>
                <?=form_password(['name'=>'confirm', 'class'=>'form-control']);?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Confirm Password</label>
                <?=form_password(['name'=>'account_confirm', 'class'=>'form-control']);?>
            </div>
        </div>

        <input type="submit" value="Update" class="btn btn-success btn-sm">
    </div>
    <?=form_close() ?>
</fieldset>