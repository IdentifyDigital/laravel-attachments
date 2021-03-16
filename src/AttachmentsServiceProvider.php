<?php


namespace IdentifyDigital\Attachments;

use Illuminate\Support\ServiceProvider;
use IdentifyDigital\Attachments\Services\AttachmentManager;
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
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-attachments');

        $this->app->bind('attachment', function() {
            return new AttachmentManager();
        });
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
