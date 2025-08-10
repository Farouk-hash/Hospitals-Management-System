<?php

namespace App\Providers;

use App\Interface\Doctors\DoctorRepositoryInterface;
use App\Interface\Ambulance\AmbulanceRepositoryInterface;
use App\Interface\Finance\PaymentAccountRepositoryInterface;
use App\Interface\Finance\RecieptAccountRepositoryInterface;
use App\Interface\Insurance\InsuranceRepositoryInterface;
use App\Interface\Interface_Doctors_Panel\DiagnosticRepositoryInfterface;
use App\Interface\Interface_Doctors_Panel\InvoicesRepositoryInterface;
use App\Interface\Patients\PatientRepositoryInterface;
use App\Interface\xRays\employeeRepositoryInterface;
use App\Repository\Ambulance\AmbulanceRepository;
use App\Repository\Finance\PaymentAccountRepository;
use App\Repository\Insurance\InsuranceRepository;
use App\Interface\Sections\SectionRepositoryInterface;
use App\Interface\Services\ServicesRepositoryInterface;
use App\Repository\Doctors\DoctorRepository;
use App\Repository\Finance\RecieptAccountRepository;
use App\Repository\Patients\PatientRepository;
use App\Repository\Repository_Doctors_Panel\DiagnosticRepository;
use App\Repository\Repository_Doctors_Panel\InvoicesRepository;
use App\Repository\Sections\SectionRepository;
use App\Repository\Services\ServicesRepository;
use App\Repository\xRays\employeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // ADMIN ;
        $this->app->bind(SectionRepositoryInterface::class , SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class , DoctorRepository::class);
        $this->app->bind(ServicesRepositoryInterface::class , ServicesRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class , InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class , AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class , PatientRepository::class);
        $this->app->bind(RecieptAccountRepositoryInterface::class , RecieptAccountRepository::class);
        $this->app->bind(PaymentAccountRepositoryInterface::class , PaymentAccountRepository::class);
        $this->app->bind(employeeRepositoryInterface::class , employeeRepository::class);
        
        // DOCTORS ; 
        $this->app->bind(InvoicesRepositoryInterface::class , InvoicesRepository::class);
        $this->app->bind(DiagnosticRepositoryInfterface::class , DiagnosticRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
