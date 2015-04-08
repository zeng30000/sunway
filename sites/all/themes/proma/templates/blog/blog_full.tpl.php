<section class="post">
    <?php if (!empty($content['field_image'])): ?>
        <div class="postimg">
            <div class="pic2">
                <?php
                print render($content['field_image']);
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($display_submitted): ?>
        <div class="entry-date">
            <div class="posttime">
                <h1><?php print format_date($node->created, 'custom', 'd'); ?></h1>
                <h3><?php print format_date($node->created, 'custom', 'M Y'); ?></h3>
            </div>
            <div class="entry-utility"><a href="<?php print url('blogs/' . $node->uid); ?>"> <img src="<?php print base_path() . path_to_theme(); ?>/images/blog/icon1.png" alt=""> <?php print $node->name; ?></a><br/>
                <span><img src="<?php print base_path() . path_to_theme(); ?>/images/blog/icon2.png" alt=""> <?php print proma_format_comma_field('field_category', $node); ?></span> <br/>
                <a href="<?php print $node_url; ?>#comments"><img src="<?php print base_path() . path_to_theme(); ?>/images/blog/icon3.png" alt=""> <?php print $node->comment_count; ?> <?php print t('Comments'); ?></a></div>
        </div>
    <?php endif; ?>


    <div class="entry-text">
        <h3 class="posttitle"><?php print $node->title; ?></h3>
        <div class="entry-content">
            <?php
            hide($content['field_category']);
            hide($content['links']);
            hide($content['comments']);
            hide($content['field_tags']);
            
            print render($content);
            ?>

        </div>
    </div>
</section>

<section id="comment">
    <?php print render($content['links']); ?>
    <?php print render($content['comments']); ?>
</section>