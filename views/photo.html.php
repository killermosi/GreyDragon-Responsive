<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Grey Dragon Theme - a custom theme for Gallery 3
 * This theme was designed and built by Serguei Dosyukov, whose blog you will find at http://blog.dragonsoft.us
 * Copyright (C) 2009-2012 Serguei Dosyukov
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation; either version 2 of the License, or (at your
 * option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write to
 * the Free Software Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
?>
<?
  if ($theme->desc_allowbbcode):
    $_description = $theme->bb2html($item->description, 1);
  else:
    $_description = nl2br(html::purify($item->description));
  endif;

  if ($theme->is_photometa_visible):
    $_description .= '<ul class="g-metadata">' . $theme->thumb_info($item) . '</ul>';
  endif;

  switch ($theme->photo_popupbox):
    case "preview":
      $include_list = FALSE;
      $include_single = TRUE;
      break;
    case "none":
      $include_list = FALSE;
      $include_single = FALSE;
      break;
    default:
      $include_list = TRUE;
      $include_single = TRUE;
      break;
  endswitch;
?>  

<div id="g-item">
  <?= $theme->add_paginator("top", FALSE); ?>
  <?= $theme->photo_top() ?>
  <? if (($theme->photo_descmode == "top") and ($_description)): ?>
    <div id="g-info"><div class="well"><?= $_description ?></div></div>
  <? endif; ?>
  <div id="g-photo">
    <?= $theme->resize_top($item) ?>
    <? if (access::can("view_full", $item)): ?>
    <a href="<?= $item->file_url() ?>" class="g-fullsize-link" title="<?= t("View full size")->for_html_attr() ?>">
      <? endif ?>
      <?= $item->resize_img(array("id" => "g-item-id-{$item->id}", "class" => "g-resize img-responsive")) ?>
      <? if (access::can("view_full", $item)): ?>
    </a>
    <? endif ?>
    <?= $theme->resize_bottom($item) ?>
    <? $_align = "";
       $_more = FALSE;
       if ($_description):
         switch ($theme->photo_descmode):
           case "overlay_top":
             $_align = "g-align-top";
             $_more = TRUE;
             break;
           case "overlay_bottom":
             $_align = "g-align-bottom";
             $_more = TRUE;
             break;
           case "overlay_top_s":
             $_align = "g-align-top g-align-static";
             break;
           case "overlay_bottom_s":
             $_align = "g-align-bottom g-align-static";
             break;
           default:
             break;
         endswitch;
       endif; ?>
  <?  if ($_align): ?>
    <?  if ($_more): ?>
      <span class="g-more <?= $_align ?>"><?= t("More") ?></span>
    <? endif ?>
      <div class="well <?= $_align; ?>" style="width: <?= $_resizewidth - 20; ?>px;" >
        <strong><?= $_title ?></strong>
        <?= $_description ?>
      </div>
    <? endif ?>
    </div>
    <?= $theme->resize_bottom($item) ?>
  </div>
  <? if (($theme->photo_descmode == "bottom") and ($_description)): ?>
    <h1><?= $theme->get_item_title($item); ?></h1>
    <div id="g-info"><div class="well"><?= $_description ?></div></div>
  <? endif; ?>
  <?= $theme->add_paginator("bottom", FALSE); ?>
  <?= $theme->photo_bottom() ?>
</div>
<?= $script ?>