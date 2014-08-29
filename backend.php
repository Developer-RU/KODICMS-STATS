<?php

defined('SYSPATH') or die('No direct script access.');

Route::set(ADMIN_DIR_NAME . '/stats', ADMIN_DIR_NAME . '/stats/<action>', array(
            'controller' => 'stats',
            'action' => 'index|reports|settings',
        ))
        ->defaults(array(
            'controller' => 'stats',
            'action' => 'index',
        ));
