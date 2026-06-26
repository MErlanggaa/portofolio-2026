<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Organization;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/

Route::redirect('/login', '/admin/login')->name('login');

Route::get('/', function () {
    $profile = Profile::first();
    $projects = Project::orderBy('created_at', 'desc')->get();
    $experiences = Experience::orderBy('start_date', 'desc')->get();
    $education = Education::orderBy('start_date', 'desc')->get();
    $skills = Skill::orderBy('proficiency', 'desc')->get();
    $organizations = Organization::orderBy('start_date', 'desc')->get();

    return view('welcome', compact('profile', 'projects', 'experiences', 'education', 'skills', 'organizations'));
});

