<?php

namespace App\Providers;

use App\Models\CompanyDetail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Schema::defaultStringLength(191);

        $this->app->singleton('cLogo', function () {
            $details = CompanyDetail::first();
            $logo = "upload/no_image.jpg";
            if ($details) {
                if (file_exists($details->image)) {
                    $logo = $details->image;
                }
            }

            return $logo;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
