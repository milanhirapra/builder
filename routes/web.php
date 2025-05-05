<?php
use Illuminate\Support\Facades\Route;

Route::get('/page-builder', function () {
    return view('blockbuilder::builder');
});

Route::get('/api/builder/render/{block}', function ($block) {
    return app('pagebuilder')->renderBlock($block);
});