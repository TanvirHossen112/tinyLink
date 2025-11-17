<?php

use App\Http\Controllers\Api\V1\TinyLinkController;

Route::group(['prefix' => 'v1'], function () {

    Route::group([], function () {
        Route::apiResource('/tiny-links', TinyLinkController::class);
    });

});
