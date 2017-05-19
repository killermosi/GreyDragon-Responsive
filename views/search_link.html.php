<?php defined("SYSPATH") or die("No direct script access.") ?>
<form action="<?= url::site("search") ?>" id="g-quick-search-form" class="g-short-form">
  <div class="aR col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 15px; padding-right: 0;">
    <div class="input-group">
      <input type="text" name="q" id="g-search" class="form-control">
  <? if (isset($item)): ?>
    <? $album_id = $item->is_album() ? $item->id : $item->parent_id; ?>
  <? else: ?>
    <? $album_id = item::root()->id; ?>
  <? endif; ?>
      <? if ($album_id == item::root()->id): ?>
        <label for="g-search"><?= t("Search the gallery") ?></label>
      <? else: ?>
        <label for="g-search"><?= t("Search this album") ?></label>
      <? endif; ?>
      <input type="hidden" name="album" value="<?= $album_id ?>" />
      <span class="input-group-btn">
        <button class="btn btn-primary submit" value="<?= t("Go")->for_html_attr() ?>" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-3 -->
</form>