<?php


namespace IdentifyDigital\Attachments;

use Illuminate\Support\ServiceProvider;
use IdentifyDigital\Contacts\Models\Address;
use IdentifyDigital\Contacts\Observers\AddressObserver;

class AttachmentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

}
