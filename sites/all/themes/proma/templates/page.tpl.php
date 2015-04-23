<!--============================== Header =================================-->
<header>
  <div class="container_12">
    <h1><a class="logo" href="<?php print $front_page; ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a></h1>

    <?php if (isset($navigation)): ?>
      <div class="nav_wrap">
        <div class="nav_wrap_inner">
          <div class="responsibe_block">
            <div class="responsibe_block_inner"> <a href="#" class="resp_navigation"></a></div>
          </div>
          <nav class="main-menu">
            <?php print $navigation; ?>
          </nav>
        </div>
      </div>
    <?php endif; ?>

  </div>
</header>

<?php if ($title): ?>
  <!-- page title -->
  <div class="wrapper pagetitle">
    <div class="container_12">
      <article class="grid_9">
        <h1 class="font_heading02"><span class="color_white"><?php print $title; ?></span> </h1>
        <?php if ($breadcrumb): ?>
          <p><span class="color_gray"><?php print $breadcrumb; ?></span></p>
        <?php endif; ?>
      </article>
      <!--
      <?php if ($seach_block_form): ?>
        <article style="float:right;" class="grid_1 last-col">
          <?php print $seach_block_form; ?>
        </article>  
      <?php endif; ?>
      <div style="margin-top:3px;" class="brd"></div>
      -->
    </div>
  </div>
  <!-- // page title -->
<?php endif; ?>
  
  
<!--============================== Slider =================================-->



<!--============================== Slider =================================-->
<?php if ($page['highlighted']): ?>
  <div class="wrapper">
    <?php print render($page['highlighted']); ?>
  </div>
<?php endif; ?>
<!--============================== Tag Line =================================-->
<!--
<?php
$home_slogan = theme_get_setting('home_tagline', 'proma');
if (!empty($home_slogan) && drupal_is_front_page()):
  ?>
  <div class="wrapper tagline">
    <div class="container_12 cont_pad2">
      <?php print theme_get_setting('home_tagline', 'proma'); ?>
      <div class="brd"></div>
    </div>
  </div>
<?php endif; ?>
-->
<!--============================== Content ================================-->
<section id="content" class="cont_pad">
  <div class="container_12">

    <!-- sidebar first -->
    <?php if ($page['sidebar_first']): ?>
      <article id="sidebar-first" class="sidebar column grid_<?php print $sidebar_first_size; ?>">
        <?php print render($page['sidebar_first']); ?>
      </article> <!--  /#sidebar-first -->
    <?php endif; ?>
    <!-- // sidebar first -->

    <article class="main-content grid_<?php print $content_size; ?>" id="main-content">
      <?php print $messages; ?>
      <?php if ($tabs): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </article>

    <!-- sidebar second -->
    <?php if ($page['sidebar_second']): ?>
      <article id="sidebar-second" class="sidebar column grid_<?php print $sidebar_second_size; ?> last-col">
        <?php print render($page['sidebar_second']); ?>
      </article> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>
    <!-- // sidebar second -->


  </div>

</section>

<!--============================== Footer =================================-->
<?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
  <div id="footer-top" class="wrapper bg_grey cont_pad2">
    <div class="brd" style="margin-top:-20px;"></div>
    <div class="container_12 cont_pad2">
      <article class="grid_3">
        <?php print render($page['footer_firstcolumn']); ?>
      </article>

      <article class="grid_3">
        <?php print render($page['footer_secondcolumn']); ?>
      </article>

      <article class="grid_3">
        <?php print render($page['footer_thirdcolumn']); ?>
      </article>

      <article class="grid_3 last-col">
        <?php print render($page['footer_fourthcolumn']); ?>
      </article>

    </div>

    <a href="#" id="toTop"><img src="<?php print base_path() . path_to_theme(); ?>/images/back-top.png" width="40" height="40" alt="Back to top" /></a> 
  </div>
<?php endif; ?>
<div id="footer-bottom" class="wrapper bg_black">
  <div class="container_12">
    <article class="footer-social-links grid_5 txt11"><?php print theme_get_setting('footer_copyright_message', 'proma'); ?></article>
    <!--<article class="grid_5last-col">
      <div class="social"> 
        <a href="<?php print theme_get_setting('twitter_url', 'proma'); ?>" title="<?php print t('Twitter'); ?>"><img src="<?php print base_path() . path_to_theme(); ?>/images/social/twitter.png" alt=""></a>
        <a href="<?php print theme_get_setting('facebook_url', 'proma'); ?>" title="<?php print t('Facebook'); ?>"><img src="<?php print base_path() . path_to_theme(); ?>/images/social/facebook.png" alt=""></a>
        <a href="<?php print theme_get_setting('linkedin_url', 'proma'); ?>" title="<?php print t('Linkedin'); ?>"><img src="<?php print base_path() . path_to_theme(); ?>/images/social/linkedin.png" alt=""></a>
        <a href="skype:<?php print theme_get_setting('skype', 'proma'); ?>?call" title="<?php print t('Skype'); ?>"><img src="<?php print base_path() . path_to_theme(); ?>/images/social/skype.png" alt=""></a> 
        <a href="<?php print theme_get_setting('rss_url', 'proma'); ?>" title="<?php print t('RSS'); ?>"><img src="<?php print base_path() . path_to_theme(); ?>/images/social/rss.png" alt=""></a> 
      </div>
    </article>-->
  </div>
</div>
