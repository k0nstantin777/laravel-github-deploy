<?php

Route::middleware('web')->group(function(){
    Route::post('/deploy', 'Konstantinn\LaravelGitHubDeploy\Http\Controllers\DeployController@run');
});
