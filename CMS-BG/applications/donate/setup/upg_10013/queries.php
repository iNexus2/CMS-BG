<?php

$customFields = json_encode( array( 
                                array( 'id' => '1', 'name' => 'api_key', 'desc' => 'Please enter your api key.', 'langbit' => 'gws_paymentwall_api_key', 'type' => 'input', 'options' => '' ),
                                array( 'id' => '2', 'name' => 'api_secretkey', 'desc' => 'Please enter your api secret key.', 'langbit' => 'gws_paymentwall_api_secret_key', 'type' => 'input', 'options' => '' ),
                                array( 'id' => '3', 'name' => 'widget_code', 'desc' => 'Please enter your widget_code.', 'langbit' => 'gws_paymentwall_widget_code', 'type' => 'input', 'options' => '' ), 
                         ) );

$SQL[] = "INSERT INTO donate_gateways VALUES (NULL, 'Paymentwall', 'paymentwall', 'Payment gateway, view more at <a href=\"http://www.paymentwall.com/\" target=\"_blank\">http://www.paymentwall.com/</a>.', 'paymentwall', '', 0, 0, 'Pingback URL: <strong>%gateway_url%</strong><br /><br /><a href=\"http://www.devfuse.com/forums/tutorials/article/150-setup-paymentwall-gateway/\" target=\"_blank\">Click here</a> for instructions on how to setup this gateway.', '".$customFields."', NULL);";
