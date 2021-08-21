<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="" />
    <meta name="keywords" content="Shopmoni" />
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <link rel="shortcut icon" href="<?=base_url() ?>assets/images/favicon.png">
    <title><?=(!empty($seo_title)) ? $seo_title .' - ' : ''; echo config_item('company_name'); ?></title>
    <?php if(isset($meta)):?>
        <?=(strpos($meta, '<meta') !== false) ? $meta : '<meta name="description" content="'.$meta.'" />';?>
    <?php else:?>
        <meta name="keywords" content="<?=config_item('default_meta_keywords');?>" />
        <meta name="description" content="<?=config_item('default_meta_description');?>" />
    <?php endif;?>

    <?=theme_file('css/reset.css', 'css') ?>
    <?=theme_file('lib/bootstrap/css/bootstrap.min.css', 'css') ?>
    <?=theme_file('font-awesome-4.7.0/css/font-awesome.min.css', 'css') ?>
    <?=theme_file('lib/owl.carousel/owl.carousel.css', 'css') ?>
    <?=theme_file('lib/jquery-ui/jquery-ui.css', 'css') ?>
    <?=theme_file('lib/fancyBox/jquery.fancybox.css', 'css') ?>
    <?=theme_file('lib/easyzoom/easyzoom.css', 'css') ?>
    <?=theme_file('lib/toastr/toastr.min.css', 'css') ?>
    <?=theme_file('css/animate.css', 'css') ?>
    <?=theme_file('css/global.css', 'css') ?>
    <?=theme_file('css/style.css', 'css') ?>
    <?=theme_file('css/responsive.css', 'css') ?>
    <?=theme_file('css/option3.css', 'css') ?>
    <?=theme_file('css/lightslider.css', 'css') ?>
    <?=theme_file('lib/tel/css/intlTelInput.css', 'css') ?>
    <?=theme_file('css/loading.css', 'css') ?>
    <?=theme_file('css/chat.css', 'css') ?>
    <?=theme_file('lib/jquery/jquery-3.1.1.min.js', 'js') ?>
    <?=theme_file('js/lightslider.js', 'js') ?>
    <?=theme_file('lib/jquerymSimpleSlider/jquery.mSimpleSlidebox.css', 'css') ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        .iti-flag {
            background-image: url("<?=theme_file('lib/tel/img/flags@2x.png') ?>");
        }
        @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {background-image: url("<?=theme_file('lib/tel/img/flags@2x.png') ?>");}

        #notification{
            animation: blinker 2s linear infinite;
        }
        @keyframes blinker{
            50% {opacity : 0;}
        }
        button{cursor:pointer;}
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#lightSlider').lightSlider({
                gallery: true,
                auto:true,
                item: 1,
                loop:true,
                slideMargin: 0,
                thumbItem: 9
            });
        });
    </script>
</head>
<body class="option3">