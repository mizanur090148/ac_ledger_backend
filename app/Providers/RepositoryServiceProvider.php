<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\SubCategoryRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\BranchRepository;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Repositories\AccountRepository;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\ChartOfAccountRepositoryInterface;
use App\Repositories\ChartOfAccountRepository;
use App\Repositories\Interfaces\VoucherRepositoryInterface;
use App\Repositories\VoucherRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            SubCategoryRepositoryInterface::class,
            SubCategoryRepository::class
        );
        $this->app->bind(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class
        );
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
        $this->app->bind(
            BranchRepositoryInterface::class,
            BranchRepository::class
        );
        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepository::class
        );
        $this->app->bind(
            ChartOfAccountRepositoryInterface::class,
            ChartOfAccountRepository::class
        );
        $this->app->bind(
            VoucherRepositoryInterface::class,
            VoucherRepository::class
        );
    }
}