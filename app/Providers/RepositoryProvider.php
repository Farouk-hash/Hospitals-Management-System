<?php

namespace App\Providers;

use App\Interface\Doctors\DoctorRepositoryInterface;
use App\Interface\Insurance\InsuranceRepositoryInterface;
use App\Repository\Insurance\InsuranceRepository;
use App\Interface\Sections\SectionRepositoryInterface;
use App\Interface\Services\ServicesRepositoryInterface;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Services\ServicesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class , SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class , DoctorRepository::class);
        $this->app->bind(ServicesRepositoryInterface::class , ServicesRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class , InsuranceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
