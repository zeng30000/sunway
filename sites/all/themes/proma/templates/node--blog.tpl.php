<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

    <?php
   
    $node_author = theme('username', array('account' => $node));
    if (!$page) {
        include 'blog/blog_teaser.tpl.php';
    } else {
        include 'blog/blog_full.tpl.php';
    }
    ?>

</div>
