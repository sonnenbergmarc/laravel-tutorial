<?php

namespace App\Providers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {


        // This is an example of putting something into the toychest
        // app()->bind(MailchimpNewsletter::class, function () {
        //     $client=(new ApiClient)->setConfig([
        //         'apiKey' => config('services.mailchimp.key'),
        //         'server' => 'us12'
        //     ]);

        //     return new MailchimpNewsletter($client);
        // });
        // We threw Newsletter into the toy chest and when you pull it out of the toy chest or container we're going to give a specific outcome such as mailchimp but could read a configuration or setting so that it can pull from depending on the provider.
        app()->bind(Newsletter::class, function () {
            $client=(new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us12'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'MSonnenberg';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin'); // Not quite right
        });
    }
}
