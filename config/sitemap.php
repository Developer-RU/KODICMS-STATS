<?php

defined('SYSPATH') or die('No direct access allowed.');

return array(
    array(
        'name' => __('Activity'),
        'children' => array(
            array(
                'name' => __('Activity_graphs'),
                'url' => URL::backend('stats'),
                'icon' => '<i class="fa fa-bar-chart-o fa-fw"></i>',
                'permissions' => 'stats.index',
                'priority' => 1,
            ),
            array(
                'name' => __('Creating_reports'),
                'url' => URL::backend('stats/reports'),
                'icon' => '<i class="fa fa-list-alt fa-fw"></i>',
                'priority' => 2,
                'permissions' => 'stats.reports',
            ),
            array(
                'name' => __('Settings'),
                'url' => URL::backend(ADMIN_DIR_NAME . '/plugins/settings/stats'),
                'icon' => '<i class="fa fa-cogs fa-fw"></i>',
                'priority' => 3,
                'permissions' => 'stats.settings'
            )
        )
    )
);
