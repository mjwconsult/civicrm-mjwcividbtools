show tables;

# cache tables - don't import / truncate after data import
civicrm_acl_cache
civicrm_acl_contact_cache
civicrm_cache
civicrm_group_contact_cache
civicrm_prevnext_cache
civicrm_queue_item
civicrm_relationship_cache

# log tables - import last / maybe truncate
civicrm_action_log
civicrm_job_log
civicrm_log
civicrm_membership_log
civicrm_subscription_history
civicrm_system_log
civirule_civiruleslogger_log
civirule_rule_log

# Special handling
civicrm_uf_match - if moving CMS truncate

# data tables
civicrm_activity
civicrm_activity_contact
civicrm_address
civicrm_campaign
civicrm_case
civicrm_case_activity
civicrm_case_contact
civicrm_contact
civicrm_contribution
civicrm_contribution_recur
civicrm_email
civicrm_entity_batch
civicrm_entity_file
civicrm_entity_financial_account
civicrm_entity_financial_trxn
civicrm_entity_tag
civicrm_event
civicrm_event_carts
civicrm_events_in_carts
civicrm_file
civicrm_financial_item
civicrm_financial_trxn
civicrm_grant
civicrm_im
civicrm_line_item
civicrm_mailing
civicrm_mailing_abtest
civicrm_mailing_event_bounce
civicrm_mailing_event_confirm
civicrm_mailing_event_delivered
civicrm_mailing_event_forward
civicrm_mailing_event_opened
civicrm_mailing_event_queue
civicrm_mailing_event_reply
civicrm_mailing_event_subscribe
civicrm_mailing_event_trackable_url_open
civicrm_mailing_event_unsubscribe
civicrm_mailing_group
civicrm_mailing_job
civicrm_mailing_recipients
civicrm_mailing_spool
civicrm_mailing_trackable_url
civicrm_membership
civicrm_membership_payment
civicrm_note
civicrm_participant
civicrm_participant_payment
civicrm_payment_token
civicrm_phone
civicrm_pledge
civicrm_pledge_payment
civicrm_relationship
civicrm_value_contribution_page_terms_and_conditions_7
civicrm_value_contribution_terms_and_conditions_acceptan_8
civicrm_value_event_cpd_fie_18
civicrm_value_event_feedback_dev__15
civicrm_value_event_feedback_form_fieldset_14
civicrm_value_event_terms_and_conditions_7
civicrm_value_event_terms_and_conditions_acceptance_9
civicrm_value_events_3
civicrm_value_extra_participant_details_4
civicrm_value_fab_training__17
civicrm_value_futureproof_21
civicrm_value_futureproof_builders_16
civicrm_value_individual_details_7
civicrm_value_interest_1
civicrm_value_member_social_media_8
civicrm_value_organisation_details_2
civicrm_value_past_member_5
civicrm_value_regions_6
civicrm_value_sla_acceptance_4
civicrm_website