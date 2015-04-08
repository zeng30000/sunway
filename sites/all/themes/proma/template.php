<?php

define('PROMA_THEME_SETTINGS_COLUMN_VARIABLE_PATTERN', 'proma_%s_size');
define('PROMA_THEME_SETTINGS_ROW_VARIABLE_PATTERN', 'proma_%s_size');
define('PROMA_PAGE_TEMPLATE_VARIABLE_PATTERN', '%s_size');
define('PROMA_GRID_COLUMNS', 12);

require_once 'includes/custom_menu.inc';

/**
 * Implements template_html_head_alter().
 */
function proma_html_head_alter(&$variables) {
  /* global $theme;
    if ($theme == 'proma') {
    if (theme_get_setting('default_favicon')) {
    foreach ($variables as $key => $value) {
    if (strpos($key, 'misc/favicon.ico') !== FALSE) {
    $variables[$key]['#attributes']['href'] = url(drupal_get_path('theme', 'proma') . '/images/favicon.ico');
    }
    }
    }
    } */
}

/**
 * Implements hook_preprocess_html().
 */
function proma_preprocess_html(&$variables) {

  $theme_path = path_to_theme();


  // Cache path to theme for duration of this function:
  $path_to_theme = drupal_get_path('theme', 'proma');
  // Add 'viewport' meta tag:
  drupal_add_html_head(
          array(
      '#tag' => 'meta',
      '#attributes' => array(
          'name' => 'viewport',
          'content' => 'width=device-width, initial-scale=1',
      ),
          ), 'proma:viewport_meta'
  );
}

function proma_preprocess_page(&$vars) {
  // main menu
  $custom_main_menu = _custom_main_menu_render_superfish();
  if (!empty($custom_main_menu['content'])) {
    $vars['navigation'] = $custom_main_menu['content'];
  }


  if (arg(0) == 'node' && arg(1)) {
    $nid = arg(1);

    $node = node_load($nid);
    switch ($node->type) {
      case 'blog':
        $vars['title'] = t('Blog');

        break;

      case 'portfolio':
        $vars['title'] = t('Portfolio');
        break;
    }
  }




  //search block form
  $seach_block_form = drupal_get_form('search_block_form');
  $seach_block_form['#id'] = 'searchform';
  $seach_block_form['search_block_form']['#id'] = 's2';
  $seach_block_form['search_block_form']['#attributes']['placeholder'] = t('Search...');
  $vars['seach_block_form'] = drupal_render($seach_block_form);


  //sidebar
  $sidebar_region_details = _proma_get_multiple_regions(array('sidebar_'));
  $sidebar_regions = $sidebar_region_details['sidebar_'];
  // Count the results:
  $sidebar_count = count($sidebar_regions);

  // Start from zero:
  $sidebar_total_width = 0;
  // If there are any sidebars, loop through all the columns:
  if ($sidebar_count > 0) {
    foreach ($sidebar_regions as $key => $name) {
      // If this sidebar actually has content:
      if (count($vars['page'][$key]) > 0) {
        // Find out how big it's supposed to be:
        $column_width_setting = (int) theme_get_setting(sprintf(PROMA_THEME_SETTINGS_COLUMN_VARIABLE_PATTERN, $key));
        // Make it available to the page template:
        $vars[sprintf(PROMA_PAGE_TEMPLATE_VARIABLE_PATTERN, $key)] = $column_width_setting;
        // Add the width of this sidebar to the total sidebar width:
        $sidebar_total_width += $column_width_setting;
      }
    }
  }

  $vars[sprintf(PROMA_PAGE_TEMPLATE_VARIABLE_PATTERN, 'content')] = PROMA_GRID_COLUMNS - $sidebar_total_width;
}

function _proma_get_multiple_regions($region_types = array('sidebar_'), $theme_override = NULL) {

  $current_theme = $theme_override ? $theme_override : variable_get('theme_default', $theme_override);

  $regions = system_region_list($current_theme);

  $theme_regions = array();
  // Loop through the region types:
  foreach ($region_types as $region_type) {
    foreach ($regions as $key => $name) {
      if (strpos($key, $region_type) === 0) {
        $theme_regions[$region_type][$key] = $name;
      }
    }
  }

  return $theme_regions;
}

function proma_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = ''; //'<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= implode(' » ', $breadcrumb);
    return $output;
  }
}

function proma_form_alter(&$form, $form_state, $form_id) {
  if (!empty($form['actions']['submit'])) {
    $form['actions']['submit']['#attributes']['class'][] = 'button green';
  }
}

function proma_format_comma_field($field_category, $node, $limit = NULL) {
  $category_arr = array();
  $category = '';
  if (!empty($node->{$field_category}[LANGUAGE_NONE])) {
    foreach ($node->{$field_category}[LANGUAGE_NONE] as $item) {
      $term = taxonomy_term_load($item['tid']);
      if ($term) {
        $category_arr[] = l($term->name, 'taxonomy/term/' . $item['tid']);
      }

      if ($limit) {
        if (count($category_arr) == $limit) {
          $category = implode(', ', $category_arr);
          return $category;
        }
      }
    }
  }
  $category = implode(', ', $category_arr);

  return $category;
}

function proma_tagadelic_weighted(array $vars) {
  $terms = $vars['terms'];
  $output = '<div class="tag-cloud">';

  foreach ($terms as $term) {
    $output .= l($term->name, 'taxonomy/term/' . $term->tid, array(
                'attributes' => array(
                    'class' => array("tagadelic", "level" . $term->weight),
                    'rel' => 'tag',
                    'title' => $term->description,
                )
                    )
            ) . " \n";
  }
  if (count($terms) >= variable_get('tagadelic_block_tags_' . $vars['voc']->vid, 12)) {
    $output .= theme('more_link', array('title' => t('more tags'), 'url' => "tagadelic/chunk/{$vars['voc']->vid}"));
  }
  $output .= '</div>';
  return $output;
}

function proma_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.
  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
          'class' => array('pager-first'),
          'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
          'class' => array('pager-previous'),
          'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
              'class' => array('pager-item'),
              'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
              'class' => array('pager-current current'),
              'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
              'class' => array('pager-item'),
              'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
          'class' => array('pager-next'),
          'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
          'class' => array('pager-last'),
          'data' => $li_last,
      );
    }
    return '<div class="wp-pagenavi"><h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
                'items' => $items,
                'attributes' => array('class' => array('pager')),
            )) . '</div>';
  }
}

/*
 * Retunn css format
 */



