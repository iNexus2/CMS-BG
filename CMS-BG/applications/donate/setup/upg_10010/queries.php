<?php

# v3.1.0
$SQL[] = "ALTER TABLE donate_users CHANGE member_seo_name member_seo_name VARCHAR( 255 ) NULL;";
$SQL[] = "ALTER TABLE donate_goals ADD g_private TINYINT( 1 ) NOT NULL default '0';";
$SQL[] = "ALTER TABLE donate_gateways ADD gw_instructions text NOT NULL;";

$SQL[] = "ALTER TABLE donate_gateways ADD gw_fields text NULL;";
$SQL[] = "ALTER TABLE donate_gateways ADD gw_settings text NULL;";

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key IN ('dt_valid_template');";

$SQL[] = "ALTER TABLE core_members ADD donate_amount decimal(10,2) NOT NULL DEFAULT '0.00';";

$SQL[] = "UPDATE donate_gateways SET gw_instructions = 'Visit the Paypal website and login, click the History tab, a dropdown will appear. Select the IPN History option. If your IPN settings are turned off, you will be prompted at the top with a link to Turn on IPN. The Donation Tracker requires Paypals IPN to be turned on. Although not required, if you need to provide a url, use the following in the notifcation url setting: <strong>%gateway_url%</strong>' WHERE gw_file='paypal';";
$SQL[] = "INSERT INTO donate_gateways VALUES (NULL, 'Payza (Alert Pay)', 'payza_v2', 'Major payment gateway, view more at <a href=\"https://www.payza.com\" target=\"_blank\">Payza.com</a>.', '', '', 0, 0, 'Visit the Payza website and login, click the main menu tab, a dropdown will appear, click the IPN Advanced Integration link. Now find and click the IPN Setup link, you will need to enter your Transaction PIN to access this area. Once in, make sure the <strong>IPN Status</strong> and <strong>Enable IPN Version 2</strong> settings are enabled. In the <strong>Alert URL</strong> setting, enter the following url: <strong>%gateway_url%</strong>', NULL, NULL);";
