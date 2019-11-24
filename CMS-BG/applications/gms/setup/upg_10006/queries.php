<?php

# 2.1.2
$SQL[] = "ALTER TABLE global_messages CHANGE block_forums block_forums TEXT NULL;";
$SQL[] = "ALTER TABLE global_messages ADD days_joined MEDIUMINT( 5 ) NOT NULL DEFAULT '0';";
