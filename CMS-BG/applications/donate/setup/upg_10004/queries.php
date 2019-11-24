<?php

# v3.0.0 RC1 changes
# Remove old settings
$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key IN ('dt_view', 'dt_donate', 'dt_visit_logging', 'dt_visit_prune', 'dt_top_donors_reset_main', 'dt_top_donors_portal', 'dt_top_donors_reset_portal', 'dt_paypal_verified_image', 'dt_linked_donations', 'dt_paypal_verified', 'dt_info_box', 'dt_offline_donation', 'dt_paypal_method', 'dt_paypal_name', 'dt_paypal_email', 'dt_enable_points', 'dt_points_field', 'dt_points_method', 'dt_points_receive','dt_upgrade','dt_upgrade_group','dt_exclude_group','dt_auto_demote','dt_auto_demote_days','dt_auto_demote_add','dt_auto_demote_pm','dt_notify_member','dt_donation_details');";

$SQL[] = "ALTER TABLE donate_currency ADD c_position INT( 5 ) NOT NULL default '1';";	
$SQL[] = "ALTER TABLE donate_currency ADD c_symbol CHAR( 10 ) NOT NULL;";
$SQL[] = "ALTER TABLE donate_currency DROP c_img;";
$SQL[] = "ALTER TABLE donate_users ADD member_seo_name VARCHAR( 255 ) NOT NULL;";
$SQL[] = "ALTER TABLE donate_goals ADD seo_name VARCHAR( 255 ) NOT NULL;";
$SQL[] = "ALTER TABLE donate_goals ADD donations INT( 10 ) NOT NULL default '0';";
$SQL[] = "ALTER TABLE donate_goals ADD views INT( 10 ) NOT NULL default '0';";
$SQL[] = "ALTER TABLE donate_goals ADD goal_status DECIMAL( 10,2 ) NOT NULL default '0.00';";
$SQL[] = "ALTER TABLE donate_goals ADD featured TINYINT( 1 ) NOT NULL default '0';";
$SQL[] = "ALTER TABLE donate_demote ADD original_group2 TEXT NOT NULL;";
$SQL[] = "ALTER TABLE donate_demote ADD new_group2 TEXT NOT NULL;";
$SQL[] = "ALTER TABLE donate_demote ADD demote_group2 TEXT NOT NULL;";

$SQL[] = "ALTER TABLE core_groups ADD g_dt_view TINYINT(1) NOT NULL DEFAULT '1';";
$SQL[] = "ALTER TABLE core_groups ADD g_dt_view_offline TINYINT(1) NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE core_groups ADD g_dt_donate TINYINT(1) NOT NULL DEFAULT '1';";
$SQL[] = "ALTER TABLE core_groups ADD g_dt_view_donations TINYINT(1) NOT NULL DEFAULT '1';";
$SQL[] = "ALTER TABLE core_groups ADD g_dt_view_goals TINYINT(1) NOT NULL DEFAULT '1';";

$SQL[] = "CREATE TABLE donate_gateways (
  gw_id int(5) NOT NULL auto_increment,
  gw_name varchar(255) NOT NULL,
  gw_file varchar(255) NOT NULL,
  gw_summary varchar(255) NOT NULL,
  gw_email varchar(255) NOT NULL,
  gw_seller_id varchar(255) NOT NULL,
  gw_active tinyint(1) NOT NULL default '1',
  gw_dev tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (gw_id)
);";

$SQL[] = "CREATE TABLE donate_rewards (
  rid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  active tinyint(1) NOT NULL default '1',
  amount_range1 decimal(10,2) NOT NULL,
  amount_range2 decimal(10,2) NOT NULL,
  points_enable tinyint(1) NOT NULL default '1',
  points_award tinyint(1) NOT NULL default '1',
  points_factor smallint(5) NOT NULL,
  promote_enable tinyint(1) NOT NULL default '1',
  promote_options tinyint(1) NOT NULL default '1',
  promote_days_primary mediumint(5) NOT NULL default '0',
  promote_days_secondary mediumint(5) NOT NULL default '0',
  promote_extension tinyint(1) NOT NULL default '1',
  promote_primary mediumtext NOT NULL,
  promote_secondary mediumtext NOT NULL,
  promote_primary_exclude varchar(255) NOT NULL,
  promote_secondary_exclude varchar(255) NOT NULL,
  PRIMARY KEY  (rid)
);";

# Add symbols to common currencies
$SQL[] = "UPDATE donate_currency SET c_symbol='$' WHERE c_tag='USD';";
$SQL[] = "UPDATE donate_currency SET c_symbol='£' WHERE c_tag='GBP';";
$SQL[] = "UPDATE donate_currency SET c_symbol='€' WHERE c_tag='EUR';";

$SQL[] = "DROP TABLE donate_visits;";

$SQL[] = "INSERT INTO donate_gateways VALUES (NULL, 'Paypal', 'paypal', 'Major payment gateway, view more at <a href=\"https://www.paypal.com\" target=\"_blank\">PayPal.com</a>.', '', '', 1, 0);";
$SQL[] = "INSERT INTO donate_gateways VALUES (NULL, 'Offline Payment', 'offline', 'Fill in details for how members can send an offline donation.', '', '', 0, 0);";

$SQL[] = "INSERT INTO donate_rewards VALUES (NULL, 'Newbie', 1, 0.00, 10.00, 1, 1, 100, 0, 2, 30, 30, 1, '', '', '', '');";
$SQL[] = "INSERT INTO donate_rewards VALUES (NULL, 'Donator', 1, 10.01, 30.00, 1, 1, 500, 0, 2, 30, 30, 1, '', '', '', '');";
$SQL[] = "INSERT INTO donate_rewards VALUES (NULL, 'Advanced Donator', 1, 30.01, 100.00, 1, 1, 1000, 0, 2, 30, 30, 1, '', '', '', '');";   
