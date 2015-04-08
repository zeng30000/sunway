<?php

function proma_form_system_theme_settings_alter(&$form, $form_state) {

  $form['home'] = array(
      '#type' => 'fieldset',
      '#title' => t('Homepage settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['home']['home_tagline'] = array(
      '#type' => 'textarea',
      '#title' => t('Home tagline'),
      '#default_value' => theme_get_setting('home_tagline', 'proma'),
  );

  $form['footer'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['footer']['footer_copyright_message'] = array(
      '#type' => 'textarea',
      '#title' => t('Footer copyright message'),
      '#default_value' => theme_get_setting('footer_copyright_message', 'proma'),
  );

  $form['footer']['social'] = array(
      '#type' => 'fieldset',
      '#title' => t('Social links setting'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['footer']['social']['facebook_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook URL'),
      '#default_value' => theme_get_setting('facebook_url', 'proma'),
  );
  $form['footer']['social']['twitter_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter URL'),
      '#default_value' => theme_get_setting('twitter_url', 'proma'),
  );
  $form['footer']['social']['linkedin_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Linkedin URL'),
      '#default_value' => theme_get_setting('linkedin_url', 'proma'),
  );
  $form['footer']['social']['skype'] = array(
      '#type' => 'textfield',
      '#title' => t('Skype'),
      '#default_value' => theme_get_setting('skype', 'proma'),
  );
  $form['footer']['social']['rss_url'] = array(
      '#type' => 'textfield',
      '#title' => t('RSS URL'),
      '#default_value' => theme_get_setting('rss_url', 'proma'),
  );

  $form['portfolio'] = array(
      '#type' => 'fieldset',
      '#title' => t('Portfolio settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['portfolio']['default_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Default portfolio display'),
      '#options' => array(
          '2c' => 'Portfolio - 2cols',
          '3c' => 'Portfolio - 3cols',
          '4c' => 'portfolio - 4cols',
      ),
      '#default_value' => theme_get_setting('default_portfolio', 'proma'),
  );

  $form['portfolio']['portfolio_heading'] = array(
      '#type' => 'textarea',
      '#title' => t('Portfolio heading'),
      '#default_value' => theme_get_setting('portfolio_heading', 'proma')
  );

  $form['portfolio']['default_nodes_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Number nodes show on portfolio page'),
      '#options' => drupal_map_assoc(array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25, 30)),
      '#default_value' => theme_get_setting('default_nodes_portfolio', 'proma'),
  );

  $form['skin'] = array(
      '#type' => 'fieldset',
      '#title' => t('Skin setting'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $color_options = array(
      '8CBD2E' => t('Default color #8CBD2E'),
      '00BFF3' => '#00BFF3',
      'FF9108' => '#FF9108',
      'FF0F00' => '#FF0F00',
      'FCDF1F' => '#FCDF1F',
      'FF197C' => '#FF197C',
      'A0E0A9' => '#A0E0A9',
      'A020F0' => '#A020F0',
      'E9C75C' => '#E9C75C',
      'A6B8A1' => '#A6B8A1',
      'E1565C' => '#E1565C',
      'A87C59' => '#A87C59',
      '2554C7' => '#2554C7',
      '1ABFB1' => '#1ABFB1',
      'FFB19A' => '#FFB19A',
  );
  $form['skin']['default_color'] = array(
      '#type' => 'select',
      '#title' => t('Theme color'),
      '#default_value' => theme_get_setting('default_color', 'proma'),
      '#options' => $color_options,
  );
  $theme_background = array(
      '01.jpg' => '01.jpg',
      '02.jpg' => '02.jpg',
      '03.jpg' => '03.jpg',
      '04.jpg' => '04.jpg',
      '05.jpg' => '05.jpg',
      '06.jpg' => '06.jpg',
      '07.jpg' => '07.jpg',
      '08.jpg' => '08.jpg',
      'none' => 'No background image',
  );
  $form['skin']['default_background'] = array(
      '#title' => t('Theme background'),
      '#type' => 'select',
      '#default_value' => theme_get_setting('default_background', 'proma'),
      '#options' => $theme_background,
  );

  $form['#submit'][] = 'proma_settings_submit';
}

function proma_settings_submit($form, &$form_state) {
  $dir = drupal_get_path('theme', 'proma') . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
  $file = $dir . 'cache.css';
  $color = $form_state['values']['default_color'];
  $background = $form_state['values']['default_background'];
  $css_text = _proma_get_css($color, $background);
  if (!file_put_contents($file, $css_text)) {
    drupal_set_message(t("An able process file !file", array('!file' => $file)), 'error');
  }
  
}

function _proma_get_css($color_code, $theme_background) {
  // $color_code = theme_get_setting('default_color', 'proma');
  // $theme_background = theme_get_setting('default_background', 'proma');

  $output = 'a, .color_3, .color_green, .sf-menu > li > a:hover, .sf-menu > li.current > a, .sf-menu > li.sfHover > a, .sf-menu li li a:hover, .sf-menu li.sfHover li.sfHover > a, ul.list-box .price-text .price, .posttime h1, .smalldate, .posttitle a:hover, .big_green, .very_big_green{color: #' . $color_code . ' !important;}';
  $output.= '.wp-pagenavi > span.current, .wp-pagenavi a:hover, .view-tenth .mask, .pic:hover, .pic2:hover, .skills li span, .green, .social a:hover img, .button.green, .filterable li a:hover, .filterable li.current a, .tabs-nav li.active a, .tag-cloud a:hover, .slider_button.green{background-color: #' . $color_code . ' !important;}';
  if (!empty($theme_background) && ($theme_background !== 'none')) {
    $output .= 'body{background: transparent url("../../images/bgs/' . $theme_background . '") scroll 50% 0 repeat-x;}';
  }
  return $output;
}