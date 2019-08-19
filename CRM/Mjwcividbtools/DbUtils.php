<?php

class CRM_Mjwcividbtools_DbUtils {

  public static function getTables() {
    $allTables = CRM_Core_DAO::getTableNames();
    sort($allTables);

    $tablesToDrop = $tablesCache = $tablesViews = $tablesToIgnore = $tablesToTruncate = [];
    foreach ($allTables as $tablename) {
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
    $tables = self::getExtensionTables($tables);
    return $tables;
  }

  /**
   * @fixme this should really be some kind of hook that extensions also use to announce what tables they have
   * @param array $tables
   *
   * @return array
   */
  public static function getExtensionTables($tables) {
    $tablesToTruncate = [
      'civicrm_event_template'
    ];
    foreach ($tablesToTruncate as $table) {
      if (CRM_Core_DAO::checkTableExists($table)) {
        $tables['tablesToTruncate'][] = $table;
      }
    }
    sort($tables['tablesToTruncate']);
    return $tables;
  }

  public static function getConfigTables() {
    $configTables = [
      0 => 'civicrm_acl',
      1 => 'civicrm_acl_entity_role',
      2 => 'civicrm_action_mapping',
      3 => 'civicrm_action_schedule',
      4 => 'civicrm_address_format',
      5 => 'civicrm_campaign_group',
      6 => 'civicrm_case_type',
      7 => 'civicrm_civigiftaid_batchsettings',
      8 => 'civicrm_component',
      9 => 'civicrm_contact_layout',
      10 => 'civicrm_contact_type',
      11 => 'civicrm_contribution_page',
      12 => 'civicrm_contribution_product',
      13 => 'civicrm_contribution_soft',
      14 => 'civicrm_contribution_widget',
      15 => 'civicrm_country',
      16 => 'civicrm_county',
      17 => 'civicrm_currency',
      18 => 'civicrm_custom_field',
      19 => 'civicrm_custom_group',
      20 => 'civicrm_cxn',
      21 => 'civicrm_dashboard',
      22 => 'civicrm_dashboard_contact',
      23 => 'civicrm_data_processor',
      24 => 'civicrm_data_processor_field',
      25 => 'civicrm_data_processor_filter',
      26 => 'civicrm_data_processor_output',
      27 => 'civicrm_data_processor_source',
      28 => 'civicrm_dedupe_exception',
      29 => 'civicrm_dedupe_rule',
      30 => 'civicrm_dedupe_rule_group',
      31 => 'civicrm_discount',
      32 => 'civicrm_domain',
      33 => 'civicrm_entity_financial_account',
      34 => 'civicrm_entity_setting',
      35 => 'civicrm_extension',
      36 => 'civicrm_financial_account',
      37 => 'civicrm_financial_type',
      38 => 'civicrm_group',
      39 => 'civicrm_group_contact',
      40 => 'civicrm_group_nesting',
      41 => 'civicrm_group_organization',
      42 => 'civicrm_job',
      44 => 'civicrm_location_type',
      45 => 'civicrm_mail_settings',
      46 => 'civicrm_mailing_bounce_pattern',
      47 => 'civicrm_mailing_bounce_type',
      48 => 'civicrm_mailing_component',
      49 => 'civicrm_mailing_group',
      50 => 'civicrm_managed',
      51 => 'civicrm_mapping',
      52 => 'civicrm_mapping_field',
      53 => 'civicrm_membership_block',
      54 => 'civicrm_membership_status',
      55 => 'civicrm_membership_type',
      56 => 'civicrm_menu',
      57 => 'civicrm_navigation',
      58 => 'civicrm_openid',
      59 => 'civicrm_option_group',
      60 => 'civicrm_option_value',
      61 => 'civicrm_participant_status_type',
      62 => 'civicrm_payment_processor',
      63 => 'civicrm_payment_processor_type',
      64 => 'civicrm_payment_token',
      65 => 'civicrm_pcp_block',
      66 => 'civicrm_persistent',
      67 => 'civicrm_pledge_block',
      68 => 'civicrm_preferences_date',
      69 => 'civicrm_premiums',
      70 => 'civicrm_premiums_product',
      71 => 'civicrm_price_field',
      72 => 'civicrm_price_field_value',
      73 => 'civicrm_price_set',
      74 => 'civicrm_price_set_entity',
      75 => 'civicrm_print_label',
      76 => 'civicrm_product',
      77 => 'civicrm_relationship_type',
      78 => 'civicrm_report_instance',
      79 => 'civicrm_saved_search',
      80 => 'civicrm_setting',
      81 => 'civicrm_sms_provider',
      82 => 'civicrm_state_province',
      83 => 'civicrm_status_pref',
      84 => 'civicrm_tag',
      85 => 'civicrm_tell_friend',
      86 => 'civicrm_timezone',
      87 => 'civicrm_uf_field',
      88 => 'civicrm_uf_group',
      89 => 'civicrm_uf_join',
      90 => 'civicrm_uf_match',
      91 => 'civicrm_webtracking',
      92 => 'civicrm_word_replacement',
      93 => 'civicrm_worldregion',
    ];
    return $configTables;
  }

}
