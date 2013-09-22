<?php
function vanilla_preprocess_html(&$vars) {

global $language;

  // Use a proper attributes array for the html attributes
  $vars['html_attributes'] = array();
  $vars['html_attributes']['lang'][] = $language->language;
  $vars['html_attributes']['dir'][] = $language->dir;
  $vars['html_attributes'] = drupal_attributes($vars['html_attributes']);
}