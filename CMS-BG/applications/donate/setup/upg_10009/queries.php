<?php

# v3.0.2
$SQL[] = "DELETE FROM core_tasks WHERE app='donate' AND key='donate';";
$SQL[] = "ALTER TABLE donate_logs ADD ip_address VARCHAR( 46 ) NOT NULL DEFAULT '0.0.0.0';";
