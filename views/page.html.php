<?php defined("SYSPATH") or die("No direct script access."); ?>

<!DOCTYPE html >
<? $theme->load_sessioninfo(); ?>
<html <?= $theme->html_attributes() ?> xml:lang="en" lang="en" <?= ($theme->is_rtl)? "dir=rtl" : null; ?> >
<?
  $item = $theme->item();
  if (($theme->enable_pagecache) and (isset($item))):
    // Page will expire in 60 seconds
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60).'GMT');  
    header("Cache-Control: public");
    header("Cache-Control: post-check=3600, pre-check=43200", false);
    header("Content-Type: text/html; charset=UTF-8");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  endif;
?>
<!-- <?= $theme->themename ?> v.<?= $theme->themeversion ?> (<?= $theme->colorpack ?> : <?= $theme->framepack ?>) - Copyright (c) 2009-2012 Serguei Dosyukov - All Rights Reserved -->
<!-- <?= $theme->page_subtype ?> -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mr. B">
    <link rel="icon" href="http://mrbsdomain.com/favicon.ico">
<? $theme->start_combining("script,css") ?>
<? if ($page_title): ?>
<?   $_title = $page_title ?> 
<? else: ?>
<?   if ($theme->item()): ?>
<?     $_title = $theme->get_item_title($theme->item()); ?>
<?   elseif ($theme->tag()): ?>
<?     $_title = t("Photos tagged with %tag_title", array("tag_title" => $theme->bb2html($theme->tag()->name, 2))) ?>
<?   else: /* Not an item, not a tag, no page_title specified.  Help! */ ?>
<?     $_title = $theme->bb2html(item::root()->title, 2); ?>
<?   endif ?>
<? endif ?>
<title>Mr. B's Domain - <?= $_title ?></title>
<? if ($theme->disable_seosupport): ?>
<meta name="robots" content="noindex, nofollow, noarchive" />
<meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate" />
<meta name="slurp" content="noindex, nofollow, noarchive, nosnippet, noodp, noydir" />
<meta name="msnbot" content="noindex, nofollow, noarchive, nosnippet, noodp" />
<meta name="teoma" content="noindex, nofollow, noarchive" />
<? endif; ?>
<!-- ?= $theme->script("jquery-ui.js") ? -->
<link rel="shortcut icon" href="<?= $theme->favicon ?>" type="image/x-icon" />
<? if ($theme->appletouchicon): ?>
<link rel="apple-touch-icon" href="<?= $theme->appletouchicon; ?>"/>
<? endif; ?>

<?= $theme->script("jquery.min.js"); ?>
<?= $theme->script("jquery.json.min.js"); ?>
<?= $theme->script("jquery.form.custom.js"); ?>
<?= $theme->script("jquery-ui.min.js"); ?>

<?= $theme->script("gallery.common.js") ?>
<? /* MSG_CANCEL is required by gallery.dialog.js */ ?>
<script type="text/javascript">
  var MSG_CANCEL = <?= t('Cancel')->for_js() ?>;
</script>

<?= $theme->script("gallery.ajax.custom.js") ?>
<?= $theme->script("gallery.dialog.custom.js"); ?>

<? /* These are page specific but they get combined */ ?>
<? if ($theme->page_subtype == "photo"): ?>
<?=  $theme->script("jquery.scrollTo.js"); ?>
<? elseif ($theme->page_subtype == "movie"): ?>
<?=  $theme->script("flowplayer.js") ?>
<? endif ?>

<?= $theme->head() ?>

<? // Theme specific CSS/JS goes last so that it can override module CSS/JS ?>
<?= $theme->theme_js_inject(); ?>
<?= $theme->theme_css_inject(); ?>
<?= $theme->get_combined("css");          // LOOKING FOR YOUR CSS? It's all been combined into the link ?>
<?= $theme->custom_css_inject(TRUE); ?>
<?= $theme->get_combined("script")        // LOOKING FOR YOUR JAVASCRIPT? It's all been combined into the link ?>

<? if ($theme->thumb_inpage): ?>
<style type="text/css"> 
  #g-column-bottom #g-thumbnav-block, #g-column-top #g-thumbnav-block { display: none; } 
<? if (((!$user->guest) or ($theme->show_guest_menu)) and ($theme->mainmenu_position == "bar")): ?>
  html { margin-top: 30px !important; }
<? endif; ?>
</style>
<? endif; ?>
    <link href="http://mrbsdomain.com/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://mrbsdomain.com/css/darkstrap.min.css" rel="stylesheet"> 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<? if ($theme->item()):
     $item = $theme->item();
   else:
     $item = item::root();
   endif; ?>
<body role="document" id="gallery" <?= $theme->body_attributes() ?><?= ($theme->show_root_page)? ' id="g-rootpage"' : null; ?> <?= $theme->get_bodyclass(); ?>>
  <div id="wrap">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="http://mrbsdomain.com">Mr. B's Domain</a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav navbar-right">
	    <li id="tab-home"><a href="http://mrbsdomain.com/index.php">Home</a></li>
	    <li id="tab-log"><a href="http://mrbsdomain.com/log">Log</a></li>
	    <li id="tab-portfolio"><a href="http://mrbsdomain.com/portfolio.php">Portfolio</a></li>
	    <li id="tab-gallery"><a href="http://mrbsdomain.com/gallery">Gallery</a></li>
	    <li id="tab-vaio"><a href="http://mrbsdomain.com/vaio_wallpapers.php">VAIO</a></li>
	    <li id="tab-about"><a href="http://mrbsdomain.com/about.php">About</a></li>
	  </ul>
	</div>
      </div>
    </nav>
  <!-- CONTENT STARTS HERE -->
    <div class="jumbotron header-banner" style="background: url('http://mrbsdomain.com/v10/images/banner_gallery.jpg') center no-repeat #000;">
      <div class="container">
        <div class="row">
          <p class="banner-header-text">GALLERY</p>
        </div>
      </div>
    </div>

    <div class="container">
<?= $theme->page_top() ?>                               
<?= $theme->site_status() ?>
<? if (((!$user->guest) or ($theme->show_guest_menu)) and ($theme->mainmenu_position == "bar")): ?>
  <div id="g-site-menu" class="g-<?= $theme->mainmenu_position; ?>">
  <?= $theme->site_menu($theme->item() ? "#g-item-id-{$theme->item()->id}" : "") ?>
  </div>
<? endif; ?>
<div id="g-header">
<?= $theme->header_top() ?>
<? if ($theme->viewmode != "mini"): ?>
<?   if ($header_text = module::get_var("gallery", "header_text")): ?>
<span id="g-header-text"><?=  $theme->bb2html($header_text, 1) ?></span>
<?   else: ?>                                                                         

<?   endif; ?>
<? endif; ?>
<? if (((!$user->guest) or ($theme->show_guest_menu)) and ($theme->mainmenu_position != "bar")): ?>
  <div id="g-site-menu" class="g-<?= $theme->mainmenu_position; ?>">
  <?= $theme->site_menu($theme->item() ? "#g-item-id-{$theme->item()->id}" : "") ?>
  </div>
<? endif ?>

<?= $theme->messages() ?>
<?= $theme->header_bottom() ?>

<? if ($theme->loginmenu_position == "header"): ?>
<?=  $theme->user_menu() ?>
<? endif ?>
<? if (empty($parents)): ?>
<?= $theme->breadcrumb_menu($theme, null); ?>
<? else: ?>
<?= $theme->breadcrumb_menu($theme, $parents); ?>
<? endif; ?>
<?= $theme->custom_header(); ?>
</div>
<? if (($theme->page_subtype != "login") and ($theme->page_subtype != "reauthenticate") and ($theme->sidebarvisible == "top")): ?>
<div id="g-column-top">
  <?= new View("sidebar.html") ?>
</div>
<? endif; ?>
<div id="g-main">
  <div id="g-main-in">
<?  if (!$theme->show_root_page): ?>
    <?= $theme->sidebar_menu($item->url()) ?>
    <div id="g-view-menu" class="g-buttonset<?= ($theme->sidebarallowed != "any")? " g-buttonset-shift" : null; ?>">
<?    if ($page_subtype == "album"): ?>
      <?= $theme->album_menu() ?>
<?    elseif ($page_subtype == "photo") : ?>
      <?= $theme->photo_menu() ?>
<?    elseif ($page_subtype == "movie") : ?>
      <?= $theme->movie_menu() ?>
<?    elseif ($page_subtype == "tag") : ?>
      <?= $theme->tag_menu() ?>
<?    endif ?>
    </div>
<?  endif; ?>
<? switch ($theme->sidebarvisible):
     case "left":
       echo '<div id="g-column-left">';
       $closediv = TRUE;
       break;
     case "none":
     case "top":
     case "bottom":
       if (($theme->thumb_inpage) and ($page_subtype == "photo")):
         echo '<div id="g-column-right">';
         $closediv = TRUE;
       else:
         $closediv = FALSE;
       endif;
       break;
     default:
       echo '<div id="g-column-right">';
       $closediv = TRUE;
       break;
   endswitch; ?>
<? if (($theme->page_subtype != "login") && ($theme->page_subtype != "reauthenticate")): ?>
<?   if (($theme->sidebarvisible == "none") || ($theme->sidebarvisible == "bottom") || ($theme->sidebarvisible == "top")): ?>
<?     if (($theme->thumb_inpage) and ($page_subtype == "photo")): ?>
<?=      '<div class="g-toolbar"><h1>&nbsp;</h1></div>'; ?>
<?=      $theme->get_block_html("thumbnav"); ?>
<?     endif; ?>
<?   else: ?>
<?=    new View("sidebar.html") ?>
<?   endif; ?>
<? endif ?>
<?= ($closediv)? "</div>" : null; ?>

<? switch ($theme->sidebarvisible):
     case "left":
       echo '<div id="g-column-centerright">';
       break;
     case "none":
     case "top":
     case "bottom":
       if (($theme->thumb_inpage) and ($page_subtype == "photo")):
         echo '<div id="g-column-centerleft">';
       else:
         echo '<div id="g-column-centerfull">';
       endif;
       break;
     default:
       echo '<div id="g-column-centerleft">';
       break;
   endswitch;

   if ($theme->show_root_page):
     echo new View("rootpage.html");
   else:
     echo $content;
   endif; ?>
  </div>
</div>
<? if (($theme->page_subtype != "login") and ($theme->page_subtype != "reauthenticate") and ($theme->sidebarvisible == "bottom")): ?>
<div id="g-column-bottom">
  <?= new View("sidebar.html") ?>
</div>
<? endif; ?>
<div id="g-footer">
<? if ($theme->viewmode != "mini"): ?>
<?=  $theme->footer() ?>
<?   if ($footer_text = module::get_var("gallery", "footer_text")): ?>
<span id="g-footer-text"><?=  $theme->bb2html($footer_text, 1) ?></span>
<?   endif ?>
  <?= $theme->credits() ?>
  <ul id="g-footer-rightside"><li><?= $theme->copyright ?></li></ul>
<?   if ($theme->loginmenu_position == "default"): ?>
  <?= $theme->user_menu() ?>
<?   endif; ?>
<? endif; ?>
<?= $theme->custom_footer(); ?>
</div>
<?= $theme->page_bottom() ?>
    </div>
  <!-- CONTENT ENDS HERE -->
  </div><!--/wrap-->
    <footer id="footer">
      <div class="container">
	  <a href="http://mrbsdomain.com/" title="Home">Home</a> |
	  <a href="http://mrbsdomain.com/log" title="Log">Log</a> |
	  <a href="http://mrbsdomain.com/portfolio.php" title="Portfolio">Portfolio</a> |
	  <a href="http://mrbsdomain.com/gallery" title="Gallery">Gallery</a> |
	  <a href="http://mrbsdomain.com/vaio_wallpapers.php" title="VAIO Wallpapers">VAIO</a> |
	  <a href="http://mrbsdomain.com/about.php" title="About">About</a>
	  <span class="aR">&#169; 2017 Mr. B's Domain | <a href="http://validator.w3.org/check/referer" title="Valid HTML 5">Valid HTML</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer" title="CSS Validator">CSS</a></span>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://mrbsdomain.com/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://mrbsdomain.com/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
