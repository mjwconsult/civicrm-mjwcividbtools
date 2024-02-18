<?php

require_once 'mjwcividbtools.civix.php';
use CRM_Mjwcividbtools_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function mjwcividbtools_civicrm_config(&$config) {
  _mjwcividbtools_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function mjwcividbtools_civicrm_install() {
  _mjwcividbtools_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function mjwcividbtools_civicrm_enable() {
  _mjwcividbtools_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_navigationMenu().
 */
function mjwcividbtools_civicrm_navigationMenu(&$menu) {
  _mjwcividbtools_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('MJW Civi DB Tools'),
    'name' => 'mjwcividbtools',
    'url' => 'civicrm/admin/db/cleardata',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _mjwcividbtools_civix_navigationMenu($menu);
}
