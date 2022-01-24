<?php

use Illuminate\Support\Facades\Route;

if (!defined('IN_MANAGER_MODE')) {
    define('IN_MANAGER_MODE', true);
}

Route::any('/manager', [\EvolutionCMS\Manager\Controllers\Actions::class, 'handleAction']);

Route::any('/manager/{theme}/ajax', [\EvolutionCMS\Manager\Helpers\DefaultAjax::class, 'ajax']);

