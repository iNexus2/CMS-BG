<?php

# Remove old settings
$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key IN ('dt_status_box', 'dt_meter_type', 'dt_goal_width', 'dt_goal_height');";
