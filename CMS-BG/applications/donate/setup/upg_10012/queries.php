<?php

$SQL[] = "ALTER TABLE donate_gateways CHANGE gw_instructions gw_instructions text NULL;";

$customFields = json_encode( array( 
                            array( 'id' => '1', 'name' => 'secret_word', 'desc' => 'Please enter the secret word you setup in the merchant tools section of the Skrill website.', 'langbit' => 'gw_secret_word', 'type' => 'input', 'options' => '' ),
                         ) );

$SQL[] = "INSERT INTO donate_gateways VALUES (NULL, 'Skrill', 'skrill', 'Major payment gateway, view more at <a href=\"https://www.skrill.com\" target=\"_blank\">Skrill.com</a>.', '', '', 0, 0, 'Skrill requires a secret word be setup in the merchant tools section of the Skrill website. Once your secret word has been setup, you need to paste it into the below Secret Word field. <a href=\"https://help.skrill.com/articles/en_GB/FAQ/Where-do-I-find-my-secret-word-and-link-Skrill-with-my-Shopping-cart/?l=en_GB&c=Business%3AIntegration_Overview&t=s\">Click here</a> to view Skrills own FAQ on this.', '".$customFields."', NULL);";
