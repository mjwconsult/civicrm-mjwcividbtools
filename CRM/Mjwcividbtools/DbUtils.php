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
    return [
      'tablesToDrop' => $tablesToDrop,
      'tablesCache' => $tablesCache,
      'tablesViews' => $tablesViews,
      'tablesToIgnore' => $tablesToIgnore,
      'tablesToTruncate' => $tablesToTruncate,
    ];
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
      33 => 'civicrm_extension',
      34 => 'civicrm_financial_account',
      35 => 'civicrm_financial_type',
      36 => 'civicrm_group',
      37 => 'civicrm_group_contact',
      38 => 'civicrm_group_nesting',
      39 => 'civicrm_group_organization',
      40 => 'civicrm_job',
      41 => 'civicrm_loc_block',
      42 => 'civicrm_location_type',
      43 => 'civicrm_mail_settings',
      44 => 'civicrm_mailing_bounce_pattern',
      45 => 'civicrm_mailing_bounce_type',
      46 => 'civicrm_mailing_component',
      47 => 'civicrm_mailing_group',
      48 => 'civicrm_managed',
      49 => 'civicrm_mapping',
      50 => 'civicrm_mapping_field',
      51 => 'civicrm_membership_block',
      52 => 'civicrm_membership_status',
      53 => 'civicrm_membership_type',
      54 => 'civicrm_menu',
      55 => 'civicrm_navigation',
      56 => 'civicrm_openid',
      57 => 'civicrm_option_group',
      58 => 'civicrm_option_value',
      59 => 'civicrm_participant_status_type',
      60 => 'civicrm_payment_processor',
      61 => 'civicrm_payment_processor_type',
      62 => 'civicrm_payment_token',
      63 => 'civicrm_pcp_block',
      64 => 'civicrm_persistent',
      65 => 'civicrm_pledge_block',
      66 => 'civicrm_preferences_date',
      67 => 'civicrm_premiums',
      68 => 'civicrm_premiums_product',
      69 => 'civicrm_price_field',
      70 => 'civicrm_price_field_value',
      71 => 'civicrm_price_set',
      72 => 'civicrm_price_set_entity',
      73 => 'civicrm_print_label',
      74 => 'civicrm_product',
      76 => 'civicrm_relationship_type',
      77 => 'civicrm_report_instance',
      78 => 'civicrm_saved_search',
      79 => 'civicrm_setting',
      80 => 'civicrm_sms_provider',
      81 => 'civicrm_state_province',
      82 => 'civicrm_status_pref',
      83 => 'civicrm_tag',
      84 => 'civicrm_tell_friend',
      85 => 'civicrm_timezone',
      86 => 'civicrm_uf_field',
      87 => 'civicrm_uf_group',
      88 => 'civicrm_uf_join',
      89 => 'civicrm_uf_match',
      90 => 'civicrm_webtracking',
      91 => 'civicrm_word_replacement',
      92 => 'civicrm_worldregion',
    ];
    return $configTables;
  }

}
