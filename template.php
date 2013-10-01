<?php
function safe_string($string) {
  // Replace weird characters with a hyphen
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  return $string;
}

function vanilla_preprocess_html(&$vars) {

global $language, $user;

  // Use a proper attributes array for the html attributes
  $vars['html_attributes'] = array();
  $vars['html_attributes']['lang'][] = $language->language;
  $vars['html_attributes']['dir'][] = $language->dir;
  $vars['html_attributes'] = drupal_attributes($vars['html_attributes']);

  // Add role name classes (to allow css based show for admin/hidden from user)
  foreach ($user->roles as $role){
    $vars['classes_array'][] = 'role-' . safe_string($role);
  }
}

function vanilla_preprocess_block(&$vars, $hook) {
  // Add a striping class
  $vars['classes_array'][] = 'block-' . $vars['block_zebra'];

  // Add first/last block classes
  $first_last = "";
  // If block id (count) is 1
  if ($vars['block_id'] == '1') {
    $first_last = "first";
    $vars['classes_array'][] = $first_last;
  }
  // Count blocks rendered in region
  $block_count = count(block_list($vars['elements']['#block']->region));
  if ($vars['block_id'] == $block_count) {
    $first_last = "last";
    $vars['classes_array'][] = $first_last;
  }
}

function vanilla_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  $show_breadcrumb = theme_get_setting('vanilla_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {

    // Optionally get rid of the homepage link
    $show_breadcrumb_home = theme_get_setting('vanilla_breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators
    if (!empty($breadcrumb)) {
      $breadcrumb_separator = theme_get_setting('vanilla_breadcrumb_separator');
      $trailing_separator = $title = '';
      if (theme_get_setting('vanilla_breadcrumb_title')) {
        $item = menu_get_item();
        if (!empty($item['tab_parent'])) {
          // If we are on a non-default tab, use the tab's title
          $title = check_plain($item['title']);
        }
        else {
          $title = drupal_get_title();
        }
        if ($title) {
          $trailing_separator = $breadcrumb_separator;
        }
      }

      // Provide a navigational heading to give context for breadcrumb links to screen-reader users
      $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
      return $heading . '<div class="breadcrumb">' . implode($breadcrumb_separator, $breadcrumb) . $trailing_separator . $title . '</div>';
    }
  }
  return '';
}

// Auto-rebuild the theme registry during theme development
if (theme_get_setting('clear_registry')) {
  system_rebuild_theme_data();
  drupal_theme_rebuild();
}

// Add clearfix to tabs
function vanilla_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}