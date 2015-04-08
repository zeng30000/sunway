<ul class="rp-widget">
    <?php foreach ($nodes as $node): ?>
        <li> 
            <?php
            if (!empty($node->field_image[LANGUAGE_NONE])) {
                $image_uri = $node->field_image[LANGUAGE_NONE][0]['uri'];

                $style_name = 'recent_post';

                print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri, 'attributes'=>array('class'=>'f_left15 pic2')));
            }
            ?>
            <p><?php print l($node->title, 'node/' . $node->nid); ?></p>
            <span class="smalldate"><?php print format_date($node->created, 'custom', 'M d, Y'); ?></span> <span class="clear"></span>
        </li>
    <?php endforeach; ?>

</ul>