<!DOCTYPE html>
<HTML>
<HEAD>
    <TITLE>Bitcoin Template</TITLE>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    <meta content='Bitcoin Template' name='description'>
    <link href='assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed'
          sizes='114x114'>
    <link href='assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed'
          sizes='144x144'>
    <!--[if lt IE 9]>
    <script src="assets/javascripts/html5shiv.js" type="text/javascript"></script>
    <![endif]-->
    <!-- / bootstrap [required files] -->
    <link href="assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="assets/stylesheets/bootstrap/bootstrap-responsive.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="assets/stylesheets/main.css" media="all" rel="stylesheet" type="text/css"/>

    <!-- / jquery -->
    <script src="assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/jquery/jquery.validate.min.js" type="text/javascript"></script>
    <script src="assets/javascripts/jquery/additional-methods.js" type="text/javascript"></script>
    <script src="assets/javascripts/main.js" type="text/javascript"></script>
</HEAD>
<BODY bgcolor="#ffffff">
{if ($smarty.session.user_logged)}
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="user_dashboard?page=profile">Bitcoin Template</a>
            <ul class="nav">
                <li class="{if $link == 'user_dashboard'}active{/if}"><a href="user_dashboard?page=profile">Home</a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </div>
    </div>
{else}
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="home">Bitcoin Template</a>
            <ul class="nav">
                <li class="{if $link == 'home' || $link == 'login'}active{/if}"><a href="home">Home</a></li>
                <li class="{if $link == 'register'}active{/if}"><a href="register">Register</a></li>
            </ul>
        </div>
    </div>
{/if}
<div class="container-fluid">
