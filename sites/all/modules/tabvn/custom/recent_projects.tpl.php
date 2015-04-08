<?php
if (empty($title)) {
  $title = t('Recent projects');
}

?>
<div class="heading_line">
  <h3 class="color_black font_heading ucase"><span><?php print $title; ?></span></h3>
</div>
<div class="portfolio-grid">
  <ul id="portfolio-grid-inner">
    <?php
    $i = 0;
    foreach ($nodes as $node):
      ?>
      <li class="col4 item-<?php print $i; ?>">
        <div class="view view-tenth"> 
          <?php
          $image_uri = $node->field_image[LANGUAGE_NONE][0]['uri'];
          $image_url = file_create_url($image_uri);
          $style_name = 'portfolio_item';
          $node_url = url('node/' . $node->nid);

          print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri));
          ?>
          <div class="mask">
            <h2><?php print l($node->title, 'node/'.$node->nid); ?></h2>
            <p>
              <?php print custom_trim_text(array('max_length' => 100, 'html' => true, 'ellipsis' => true), $node->body[LANGUAGE_NONE][0]['value']); ?>
            </p>
            <a href="<?php print $image_url; ?>" class="preview info" data-rel="prettyPhoto[web]"><?php print t('preview'); ?></a> </div>
        </div>
      </li>
      <?php
      $i++;
    endforeach;
    ?>
  </ul>
</div>