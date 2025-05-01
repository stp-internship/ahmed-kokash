<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Appointment;
use App\Policies\AppointmentPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Appointment::class => AppointmentPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();
    }
}
