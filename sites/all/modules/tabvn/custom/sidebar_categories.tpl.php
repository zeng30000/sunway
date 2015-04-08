<?php
$count_half = 0;
if (!empty($terms)) {
  $count_half = (count($terms)) / 2;
}
$left_terms = array();
$right_terms = array();
$i = 0;
foreach ($terms as $term) {
  if ($i < $count_half) {
    $left_terms[] = $term;
  } else {
    $right_terms[] = $term;
  }
  $i++;
}
?>
<div class="row">
  <?php if (!empty($left_terms)): ?>
    <div class="column grid_2 alpha">	
      <ul class="link-list sidebar-list">
        <?php foreach ($left_terms as $term) : ?>
          <li><?php print l($term->name, 'taxonomy/term/' . $term->tid); ?></li>
        <?php endforeach; ?>
      </ul>							
    </div>
  <?php endif; ?>


  <?php if (!empty($right_terms)): ?>
    <div class="column grid_2 omega">	
      <ul class="link-list sidebar-list">
        <?php foreach ($right_terms as $term) : ?>
          <li><?php print l($term->name, 'taxonomy/term/' . $term->tid); ?></li>
        <?php endforeach; ?>
      </ul>							
    </div>
  <?php endif; ?>


</div>