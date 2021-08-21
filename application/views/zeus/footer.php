</div> <!-- end of card-box -->
</div> <!-- end of row -->
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('.datepicker').pickadate({formatSubmit:'yyyy-mm-dd', hiddenName:true, format:'mm/dd/yyyy'});
    //$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});

    $('.redactor').redactor({
        lang: '<?=config_item('language');?>',
        minHeight: 200,
        pastePlainText: true,
        linebreaks:true,
        imageUpload: '<?=site_url('admin/wysiwyg/upload_image');?>',
        imageManagerJson: '<?=site_url('admin/wysiwyg/get_images');?>',
        imageUploadErrorCallback: function(json)
        {
            alert(json.error);
        },
        plugins: ['imagemanager']
    });
});

</script>

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

        setTimeout(() => {

           window.location = '<?=site_url('zeus/logout') ?>';

        }, 1000 * 60 * 10);
        
</script>


