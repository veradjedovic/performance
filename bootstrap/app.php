<?php

/**
 * Autoload.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Load Config of The Application.
 */
require_once __DIR__ . '/../config/index.php';

/**
 * Load Helper Functions.
 */
require_once __DIR__ . '/../app/helpers.php';

/**
 * Load The Application Routes.
 */
require_once __DIR__ . '/../router/dispatcher.php';