<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>

  <script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="view/stylesheet/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="bootstrap" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link rel="slick" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
  <link rel="fancybox-css" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
  <link rel="slick-theme" href="view/stylesheet/css/slick-theme.css">
  <link rel="aos" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <link rel="font-awesome" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  <link rel="jquery" href="https://code.jquery.com/jquery-3.6.0.min.js">
  <link rel="popper" href="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
  <link rel="bootstrap" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js">
  <link rel="jquery.fancybox" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js">
  <link rel="aos" href="https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '1.0.0', true">
  <link rel="slick" href="">
  <link rel="slick" href="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
  <link rel="theme-js" href="view/javascript/js/theme.js">
  <link rel="stylesheet" href="">
  <title>Web Application</title>

<?php foreach ($styles as $style) { ?>
<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>

<section class="page1 page2">
<div class="page1-sidebar">
    <ul>
      <li class="active"><a href="http://localhost/webapplication/"><img src="view/img/ic_view_list_24px.png"></a></li>
      <li><a href="<?php echo $menu_customer; ?>"><img src="view/img/ic_group_24px.png"></a></li>
      <li><a href="<?php echo $menu_driver; ?>"><img src="view/img/Group9810.png"></a></li>
      <li><a href="http://localhost/webapplication/slide4.php"><img src="view/img/ic_directions_car_24px.png"></a></li>
      <li><a href="http://localhost/webapplication/slide6.php"><img src="view/img/ic_pin_drop_24px.png"></a></li>
      <li><a href="<?php echo $company; ?>"><img src="view/img/Group9720.png"></a></li>
      <li><a href="<?php echo $user; ?>"><img src="view/img/Group9720.png"></a></li>
      <li><a href="<?php echo $user_group; ?>"><img src="view/img/Group9720.png"></a></li>

    </ul>
  </div>

  <div class="page1-right">
    <div class="container">
