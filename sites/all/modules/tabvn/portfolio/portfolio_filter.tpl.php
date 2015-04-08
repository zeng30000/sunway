<h1 class="portfolio-heading font_heading02 color_black">
  <?php print theme_get_setting('portfolio_heading', 'proma'); ?>
</h1>
<?php
$terms = array();
$vid = NULL;
$vid_machine_name = 'portfolio_categories';
$vocabulary = taxonomy_vocabulary_machine_name_load($vid_machine_name);
if (!empty($vocabulary->vid)) {
  $vid = $vocabulary->vid;
}
if (!empty($vid)) {
  $terms = taxonomy_get_tree($vid);
}
?>
<div class="filterable">
  <ul id="portfolio-nav">
    <li class="current"><a href="#" data-filter="*"><?php print t('All'); ?></a><span>/</span></li>
    <?php if (!empty($terms)): ?>
      <?php foreach ($terms as $term): ?>
        <li><a href="#" data-filter=".tid-<?php print $term->tid; ?>"><?php print $term->name; ?></a></li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</div>
