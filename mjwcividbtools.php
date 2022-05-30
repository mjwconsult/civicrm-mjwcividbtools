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
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function mjwcividbtools_civicrm_postInstall() {
  _mjwcividbtools_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function mjwcividbtools_civicrm_uninstall() {
  _mjwcividbtools_civix_civicrm_uninstall();
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
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function mjwcividbtools_civicrm_disable() {
  _mjwcividbtools_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function mjwcividbtools_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _mjwcividbtools_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function mjwcividbtools_civicrm_entityTypes(&$entityTypes) {
  _mjwcividbtools_civix_civicrm_entityTypes($entityTypes);
}
