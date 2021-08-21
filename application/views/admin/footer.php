</div> <!-- end of card-box -->
</div> <!-- end of row -->

<?php 

$pageAds = [];
$today = date('Y-m-d H:i:s');

if($pageAds = \DB\DB::getRow('banner_collections', ['code'=>MERCHANT_PAGES])){
    $query  = \CI::db()->where('banner_collection_id', $pageAds->banner_collection_id);
    $query  = \CI::db()->where('enable_date <=', $today);
    $query  = \CI::db()->where('disable_date >=', $today);
    $query  = \CI::db()->get('banners');
    $pageAds = $query->result();
} 

?>
<div class="row">
    <div class="col-sm-12">
        <?php if($pageAds && count($pageAds) > 0): ?>
            <?php foreach($pageAds as $row): ?>
                <?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
                <a href="<?=$row->link ?>"  <?=$blank ?>>
                    <img src="<?=base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>" class="img img-responsive">
                </a>
            <?php endforeach; ?> 
        <?php endif; ?>
    </div>
</div>

</div> <!-- end of  container!-- >
</div> <!-- end of  wrapper-->

</body>
<!-- jQuery  included in header -->
<script type="text/javascript" src="<?=base_url('assets/js/jquery-ui.js');?>"></script>
<script src="<?=base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url() ?>assets/js/detect.js"></script>
<script src="<?=base_url() ?>assets/js/fastclick.js"></script>
<script src="<?=base_url() ?>assets/js/jquery.blockUI.js"></script>
<script src="<?=base_url() ?>assets/js/waves.js"></script>
<script src="<?=base_url() ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?=base_url() ?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/switchery/switchery.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/wizard/jquery.bootstrap.wizard.js"></script>
<script src="<?=base_url() ?>assets/plugins/wizard/prettify.js"></script>


<!-- Counter js  -->
<script src="<?=base_url() ?>assets/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="<?=base_url() ?>assets/plugins/counterup/jquery.counterup.min.js"></script>

<script src="<?=base_url() ?>assets/plugins/moment/moment.js"></script>

<!-- App js -->
<script src="<?=base_url() ?>assets/js/jquery.core.js"></script>

<script type="text/javascript" src="<?=base_url('assets/js/pickadate/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pickadate/picker.date.js');?>"></script>

<script type="text/javascript" src="<?=base_url('assets/js/redactor.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/imagemanager.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/spin.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/mustache.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/redactor_lang/'.config_item('language').'.js');?>"></script>
<script src="<?=base_url() ?>assets/plugins/dropzone/dropzone.min.js"></script>
<?php if(CI::auth()->isLoggedIn(false, false)):?>

    <script type="text/javascript">
        $(document).ready(function(){

            $('.datepicker').pickadate({formatSubmit:'yyyy-mm-dd', hiddenName:true, format:'mm/dd/yyyy'});

            $('.redactor').redactor({
                lang: '<?php echo config_item('language');?>',
                minHeight: 200,
                pastePlainText: true,
                linebreaks:true,
                imageUpload: '<?php echo site_url('admin/wysiwyg/upload_image');?>',
                imageManagerJson: '<?php echo site_url('admin/wysiwyg/get_images');?>',
                imageUploadErrorCallback: function(json)
                {
                    alert(json.error);
                },
                plugins: ['imagemanager']
            });

            Dropzone.autoDiscover = false;

            $('#dropzone1').dropzone({
              url: "<?=site_url('/dropzone/banner_images') ?>" 
          });

            $('#dropzone2').dropzone({
              url: "<?=site_url('/dropzone/profile_image') ?>"
          });


            if($('#rootwizard').length > 0){


                $('#rootwizard').bootstrapWizard();
            }
        });

    </script>
<?php endif;?>

<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
    function message(type = 'success', message='', title = '')
    {
        toastr.options = {'progressBar': true, 'timeOut': 5000};
        switch(type){
            case 'success':
            toastr.success(title, message);
            break

            case 'warning':
            toastr.warning(title, message);
            break

            case 'error':
            toastr.error(title, message);
            break;

            default:
            toastr.info(title, message);
            break;
        }
    }
</script>
