<?php
function vanilla_form_system_theme_settings_alter(&$form, $form_state) {
  $form['options_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme specific settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE
  );
  $form['options_settings']['vanilla_breadcrumb'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumb settings'),
    '#attributes' => array('id' => 'vanilla-breadcrumb'),
  );
  $form['options_settings']['vanilla_breadcrumb']['vanilla_breadcrumb'] = array(
    '#type' => 'select',
    '#title' => t('Display breadcrumb'),
    '#default_value' => theme_get_setting('vanilla_breadcrumb'),
    '#options' => array(
      'yes' => t('Yes'),
      'admin' => t('Only in admin section'),
      'no' => t('No'),
    ),
  );
  $form['options_settings']['vanilla_breadcrumb']['vanilla_breadcrumb_separator'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb separator'),
    '#description' => t('Text only.'),
    '#default_value' => theme_get_setting('vanilla_breadcrumb_separator'),
    '#size' => 5,
    '#maxlength' => 10,
  );
  $form['options_settings']['vanilla_breadcrumb']['vanilla_breadcrumb_home'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show home page link in breadcrumb'),
    '#default_value' => theme_get_setting('vanilla_breadcrumb_home'),
  );
  $form['options_settings']['vanilla_breadcrumb']['vanilla_breadcrumb_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Append the content title to the end of the breadcrumb'),
    '#default_value' => theme_get_setting('vanilla_breadcrumb_title'),
  );
  $form['options_settings']['clear_registry'] = array(
    '#type' => 'checkbox',
    '#title' => t('Rebuild theme registry on every page.'),
    '#description' =>t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'http://drupal.org/node/173880#theme-registry')),
    '#default_value' => theme_get_setting('clear_registry'),
  );
}
