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