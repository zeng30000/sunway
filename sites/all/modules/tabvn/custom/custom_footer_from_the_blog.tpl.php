<?php foreach ($nodes as $node): ?>
  <?php
  if (!empty($node->field_image[LANGUAGE_NONE])) {
    $image_uri = $node->field_image[LANGUAGE_NONE][0]['uri'];

    $style_name = 'recent_post';

    print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri, 'attributes' => array('class' => 'f_left15 pic')));
  }
  ?>
  <p class="txt11"><?php print l($node->title, 'node/' . $node->nid); ?><br/>
    <span class="color_white txt10"><?php print format_date($node->created, 'custom', 'M d, Y'); ?></span></p>
  <div class="clear"></div>
<?php endforeach; ?>
