<?php

class CRM_Mjwcividbtools_DbUtils {

  public static function getTables() {
    $dao = CRM_Core_DAO::executeQuery(
      "SELECT TABLE_NAME
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = DATABASE()
        ");

    while ($dao->fetch()) {
      $existingTableNames[] = $dao->TABLE_NAME;
    }
    sort($existingTableNames);

    $allKnownTables = array_merge(
      self::getCacheTables(),
      self::getConfigTables(),
      self::getDataTables(),
      self::getLogTables(),
    );

    // Insert the list of missing tables
    $unknownTables = array_diff($existingTableNames, $allKnownTables);
    foreach ($unknownTables as $tableName) {
      CRM_Core_DAO::executeQuery('
INSERT IGNORE INTO MJWCIVIDBTOOLS_tables_import (table_name, missing) VALUES ("' . $tableName . '", 1)
      ');
    }

    foreach (self::getCacheTables() as $tableName) {
      CRM_Core_DAO::executeQuery('
INSERT IGNORE INTO MJWCIVIDBTOOLS_tables_import (table_name, type) VALUES ("' . $tableName . '", "cache")
      ');
    }
    foreach (self::getLogTables() as $tableName) {
      CRM_Core_DAO::executeQuery('
INSERT IGNORE INTO MJWCIVIDBTOOLS_tables_import (table_name, type) VALUES ("' . $tableName . '", "log")
      ');
    }
    foreach (self::getConfigTables() as $tableName) {
      CRM_Core_DAO::executeQuery('
INSERT IGNORE INTO MJWCIVIDBTOOLS_tables_import (table_name, type) VALUES ("' . $tableName . '", "config")
      ');
    }
    foreach (self::getDataTables() as $tableName) {
      CRM_Core_DAO::executeQuery('
INSERT IGNORE INTO MJWCIVIDBTOOLS_tables_import (table_name, type) VALUES ("' . $tableName . '", "data")
      ');
    }

    $tablesToDrop = $tablesCache = $tablesViews = $tablesToIgnore = $tablesToTruncate = [];
    foreach ($existingTableNames as $tablename) {
      if (substr($tablename, 0, 18) === 'civicrm_advimport_') {
        $tablesToDrop[] = $tablename;
      }
      elseif (substr($tablename, -6) === '_cache') {
        $tablesCache[] = $tablename;
      }
      elseif (substr($tablename, 0, 13) === 'civicrm_view_') {
        $tablesViews[] = $tablename;
      }
      elseif (in_array($tablename, self::getConfigTables())) {
        $tablesToIgnore[] = $tablename;
      }
      elseif (substr($tablename, 0, 13) === 'snap_civicrm_') {
        $tablesToIgnore[] = $tablename;
      }
      elseif (substr($tablename, 0, 14) === 'civicrm_oauth_') {
        $tablesToIgnore[] = $tablename;
      }
      else {
        $tablesToTruncate[] = $tablename;
      }
    }
    $tables = [
      'tablesToDrop' => $tablesToDrop,
      'tablesCache' => $tablesCache,
      'tablesViews' => $tablesViews,
      'tablesToIgnore' => $tablesToIgnore,
      'tablesToTruncate' => $tablesToTruncate,
    ];
    return $tables;
  }

  public static function getConfigTables() {
    $configTables = [
      'MJWCIVIDBTOOLS_tables_import',
      'civicrm_acl',
      'civicrm_acl_entity_role',
      'civicrm_action_mapping',
      'civicrm_action_schedule',
      'civicrm_address_format',
      'civicrm_campaign_group',
      'civicrm_case_type',
      'civicrm_civigiftaid_batchsettings',
      'civicrm_component',
      'civicrm_contact_layout',
      'civicrm_contact_type',
      'civicrm_contribution_page',
      'civicrm_contribution_product',
      'civicrm_contribution_soft',
      'civicrm_contribution_widget',
      'civicrm_country',
      'civicrm_county',
      'civicrm_currency',
      'civicrm_custom_field',
      'civicrm_custom_group',
      'civicrm_cxn',
      'civicrm_dashboard',
      'civicrm_data_processor',
      'civicrm_data_processor_field',
      'civicrm_data_processor_filter',
      'civicrm_data_processor_output',
      'civicrm_data_processor_source',
      'civicrm_dedupe_exception',
      'civicrm_dedupe_rule',
      'civicrm_dedupe_rule_group',
      'civicrm_discount',
      'civicrm_domain',
      'civicrm_entity_financial_account',
      'civicrm_entity_setting',
      'civicrm_extension',
      'civicrm_financial_account',
      'civicrm_financial_type',
      'civicrm_geocoder_zip_dataset',
      'civicrm_group',
      'civicrm_group_nesting',
      'civicrm_group_organization',
      'civicrm_install_canary',
      'civicrm_job',
      'civicrm_location_type',
      'civicrm_mail_settings',
      'civicrm_mailing_bounce_pattern',
      'civicrm_mailing_bounce_type',
      'civicrm_mailing_component',
      'civicrm_managed',
      'civicrm_mapping',
      'civicrm_mapping_field',
      'civicrm_membership_block',
      'civicrm_membership_status',
      'civicrm_membership_type',
      'civicrm_menu',
      'civicrm_mosaico_msg_template',
      'civicrm_mosaico_template',
      'civicrm_msg_template',
      'civicrm_navigation',
      'civicrm_openid',
      'civicrm_open_postcode_geo_uk',
      'civicrm_option_group',
      'civicrm_option_value',
      'civicrm_participant_status_type',
      'civicrm_payment_processor',
      'civicrm_payment_processor_type',
      'civicrm_pcp',
      'civicrm_pcp_block',
      'civicrm_persistent',
      'civicrm_pledge_block',
      'civicrm_preferences_date',
      'civicrm_premiums',
      'civicrm_premiums_product',
      'civicrm_price_field',
      'civicrm_price_field_value',
      'civicrm_price_set',
      'civicrm_price_set_entity',
      'civicrm_print_label',
      'civicrm_product',
      'civicrm_relationship_type',
      'civicrm_report_instance',
      'civicrm_saved_search',
      'civicrm_search_display',
      'civicrm_search_segment',
      'civicrm_setting',
      'civicrm_sms_provider',
      'civicrm_state_province',
      'civicrm_status_pref',
      'civicrm_survey',
      'civicrm_tag',
      'civicrm_tell_friend',
      'civicrm_timezone',
      'civicrm_translation',
      'civicrm_uf_field',
      'civicrm_uf_group',
      'civicrm_uf_join',
      'civicrm_uf_match',
      'civicrm_webtracking',
      'civicrm_word_replacement',
      'civicrm_worldregion',
      'civicrm_config_item_set',
      'civicrm_inlay',
      'civicrm_inlay_asset',
      'civicrm_inlay_config_set',
      'civicrm_form_processor_action',
      'civicrm_form_processor_default_data_action',
      'civicrm_form_processor_default_data_input',
      'civicrm_form_processor_input',
      'civicrm_form_processor_instance',
      'civicrm_form_processor_validation',
      'cividiscount_item',
      'civirule_action',
      'civirule_condition',
      'civirule_rule',
      'civirule_rule_action',
      'civirule_rule_condition',
      'civirule_rule_tag',
      'civirule_trigger',
    ];
    return $configTables;
  }

  public static function getCacheTables() {
    return [
      'civicrm_acl_cache',
      'civicrm_acl_contact_cache',
      'civicrm_cache',
      'civicrm_group_contact_cache',
      'civicrm_prevnext_cache',
      'civicrm_queue_item',
      'civicrm_relationship_cache',
    ];
  }

  public static function getLogTables() {
    return [
      'civicrm_action_log',
      'civicrm_job_log',
      'civicrm_log',
      'civicrm_membership_log',
      'civicrm_subscription_history',
      'civicrm_system_log',
      'civirule_civiruleslogger_log',
      'civirule_rule_log',
    ];
  }

  public static function getDataTables() {
    return [
      'civicrm_activity',
      'civicrm_activity_contact',
      'civicrm_address',
      'civicrm_afform_submission',
      'civicrm_batch',
      'civicrm_campaign',
      'civicrm_case',
      'civicrm_case_activity',
      'civicrm_case_contact',
      'civicrm_contact',
      'civicrm_contribution',
      'civicrm_contribution_recur',
      'civicrm_dashboard_contact',
      'civicrm_dedupe_exception',
      'civicrm_email',
      'civicrm_entity_batch',
      'civicrm_entity_file',
      'civicrm_entity_financial_account',
      'civicrm_entity_financial_trxn',
      'civicrm_entity_tag',
      'civicrm_event',
      'civicrm_event_template',
      'civicrm_event_carts',
      'civicrm_events_in_carts',
      'civicrm_file',
      'civicrm_financial_item',
      'civicrm_financial_trxn',
      'civicrm_firewall_ipaddress',
      'civicrm_grant',
      'civicrm_group_contact',
      'civicrm_im',
      'civicrm_line_item',
      'civicrm_loc_block',
      'civicrm_mailing',
      'civicrm_mailing_abtest',
      'civicrm_mailing_event_bounce',
      'civicrm_mailing_event_confirm',
      'civicrm_mailing_event_delivered',
      'civicrm_mailing_event_forward',
      'civicrm_mailing_event_opened',
      'civicrm_mailing_event_queue',
      'civicrm_mailing_event_reply',
      'civicrm_mailing_event_subscribe',
      'civicrm_mailing_event_trackable_url_open',
      'civicrm_mailing_event_unsubscribe',
      'civicrm_mailing_group',
      'civicrm_mailing_job',
      'civicrm_mailing_recipients',
      'civicrm_mailing_spool',
      'civicrm_mailing_trackable_url',
      'civicrm_membership',
      'civicrm_membership_payment',
      'civicrm_note',
      'civicrm_participant',
      'civicrm_participant_payment',
      'civicrm_paymentprocessor_webhook',
      'civicrm_payment_token',
      'civicrm_phone',
      'civicrm_pledge',
      'civicrm_pledge_payment',
      'civicrm_queue',
      'civicrm_recurring_entity',
      'civicrm_relationship',
      'civicrm_stripe_customers',
      'civicrm_stripe_paymentintent',
      'civicrm_value_contribution_page_terms_and_conditions_7',
      'civicrm_value_contribution_terms_and_conditions_acceptan_8',
      'civicrm_value_event_cpd_fie_18',
      'civicrm_value_event_feedback_dev__15',
      'civicrm_value_event_feedback_form_fieldset_14',
      'civicrm_value_event_terms_and_conditions_7',
      'civicrm_value_event_terms_and_conditions_acceptance_9',
      'civicrm_value_events_3',
      'civicrm_value_extra_participant_details_4',
      'civicrm_value_fab_training__17',
      'civicrm_value_futureproof_21',
      'civicrm_value_futureproof_builders_16',
      'civicrm_value_individual_details_7',
      'civicrm_value_interest_1',
      'civicrm_value_member_social_media_8',
      'civicrm_value_organisation_details_2',
      'civicrm_value_past_member_5',
      'civicrm_value_regions_6',
      'civicrm_value_sla_acceptance_4',
      'civicrm_website',
      'cividiscount_track',
    ];
  }

}
