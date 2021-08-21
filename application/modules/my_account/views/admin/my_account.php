<fieldset>
    <legend>Account Information</legend>

    <div class="row">
        <div class="col-md-12">
            <?=form_open('my-account') ?>
            <h4>Personal Information</h4>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">First Name</label>
                    <?=form_input(['name'=>'firstname', 'class'=>'form-control', 'value'=> assign_value('firstname', $customer['firstname'])]) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Last Name</label>
                    <?=form_input(['name'=>'lastname','class'=>'form-control', 'value'=> assign_value('lastname', $customer['lastname'])])?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Email</label>
                    <?=form_input(['name'=>'email', 'class'=>'form-control', 'value'=> assign_value('email', $customer['email'])]);?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Phone</label>
                    <?=form_input(['name'=>'phone', 'class'=>'form-control', 'value'=> assign_value('phone', $customer['phone'])]);?>
                </div>
            </div>

            <div class="form-group">
                <input type="checkbox" name="email_subscribe" value="1" <?php if((bool)$customer['email_subscribe']) { ?> checked="checked" <?php } ?>/> Subscribe to our mailing list
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <a href="javascript:void(0)" id="password-link">Click here to change your password</a>
                </div>
            </div>

            <div class="row" id="password-row" style="display:none">
                <div class="alert alert-info">
                    If you do not wish to change your password. Leave both fields blank.
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Password</label>
                        <?=form_password(['name'=>'confirm', 'class'=>'form-control']);?>
                    </div>
                </div>
                <div class="col-md-6" id="setup">
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <?=form_password(['name'=>'account_confirm', 'class'=>'form-control']);?>
                    </div>
                </div>
            </div>

            <input type="submit" value="Update" class="btn btn-success btn-sm">
            <?=form_close() ?>
        </div>

    </div>

</fieldset>




<script type="text/javascript">
    $(function(){

        $('#password-link').click(function(){

            $('#password-row').toggle();
        })
    })
</script>