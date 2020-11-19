<?php


namespace IdentifyDigital\Attachments;

use Illuminate\Support\ServiceProvider;
use IdentifyDigital\Contacts\Models\Address;
use IdentifyDigital\Contacts\Observers\AddressObserver;

/**
 * Class AttachmentsServiceProvider
 * @package IdentifyDigital\Attachments
 */
class AttachmentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/attachments.php' => config_path('attachments.php'),
        ]);
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
