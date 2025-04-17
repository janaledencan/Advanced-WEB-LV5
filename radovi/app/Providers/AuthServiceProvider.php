<?php

namespace App\Providers;

use App\Models\ThesisTask;
use App\Policies\ThesisTaskPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\ThesisTask::class => \App\Policies\ThesisTaskPolicy::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
