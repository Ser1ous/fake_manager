<?php

use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/', [\EvolutionCMS\Manager\Controllers\Actions::class, 'handleAction']);
