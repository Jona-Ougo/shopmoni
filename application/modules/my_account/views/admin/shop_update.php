<fieldset>
    <legend>Shop Information</legend>

    <div class="row">

        <div class="col-md-12">

            <h4>Shop Information</h4>
            <div class="row">
                <?=form_open('shop-update') ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Shop Name</label>
                        <?=form_input(['name'=>'shop_name', 'class'=>'form-control', 'value'=> assign_value('shop_name', $info['shop_name'])])?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Shop Phone One</label>
                        <?=form_input(['name'=>'phone_1', 'class'=>'form-control', 'value'=> assign_value('phone_1', $info['phone_1'])]);?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Shop Phone Two</label>
                        <?=form_input(['name'=>'phone_2', 'class'=>'form-control', 'value'=> assign_value('phone_2', $info['phone_2'])]);?>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Facebook Page Url</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-facebook-official"></i></span>
                            <?=form_input(['name'=>'facebook', 'class'=>'form-control', 'value'=> assign_value('facebook', $info['facebook'])]);?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Twitter Page Url</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-twitter-square"></i></span>
                            <?=form_input(['name'=>'twitter', 'class'=>'form-control', 'value'=> assign_value('phone_2', $info['twitter'])]);?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Website Url</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                            <?=form_input(['name'=>'website', 'class'=>'form-control', 'value'=> assign_value('website', $info['website'])]);?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Shop Info/Description/About</label>
                        <textarea name="shop_description" class="form-control"><?=trim($info['shop_description']) ?></textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Shop Descriptive Address</label>
                        <textarea name="address" class="form-control"><?=trim($info['address']) ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-success btn-sm">
            </div>
            <?=form_close() ?>

            <div class="row">

                <div class="col-sm-6">
                    <?=form_open_multipart('/dropzone/banner_images', ['id'=>'dropzone1', 'class'=>'dropzone dropzone-previews']) ?>
                    <label>Upload Shop Banner Image (Recommended Size: 1200px X 200px)</label>
                    <div class="dz-message" data-dz-message><span>Click or drop file here to upload</span></div>
                    <?=form_close(); ?>  
                    <?php if(!empty($info['banner_images'])): ?> 
                        <br> 
                        <label for="">Current Image</label><br>
                        <img src="<?=base_url('uploads/'.$info['banner_images']) ?>" class="img img-thumbnail img-responsive" style="max-width: 400px; max-height: 133.33px">
                    <?php endif; ?>         
                </div>

                <div class="col-sm-6">
                    <?=form_open_multipart('/dropzone/profile_image', ['id'=>'dropzone2', 'class'=>'dropzone dropzone-previews']) ?>
                    <label>Upload Profile Picture (Recommended Size: 500px X 500px)</label>
                    <div class="dz-message" data-dz-message><span>Click or drop file here to upload</span></div>
                    <?=form_close(); ?>   
                    <?php if(!empty($info['profile_image'])): ?>  
                        <br>
                        <label for="">Current Image</label><br>
                        <img src="<?=base_url('uploads/'.$info['profile_image']) ?>" class="img img-thumbnail img-responsive" style="max-width: 100px; max-height: 100px">
                    <?php endif; ?>                    
                </div>

                <div class="col-sm-9"></div>
            </div>




        </div>

    </div>

</fieldset>