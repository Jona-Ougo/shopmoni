<?php $s = isset($subject) ? $subject : 'ShopMoni' ?>
<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?=$s ?></title>
  <?php 
    $view = \GoCart\Libraries\View::getInstance();
    $view->show('email_css');
  ?>
</head>
<body class="">
  <table border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
      <td>&nbsp;</td>
      <td class="container">
        <div class="content">

          <!-- START CENTERED WHITE CONTAINER -->
          <span class="preheader">Fxnownow</span>