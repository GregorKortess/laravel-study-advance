<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use App\Http\View\Composers\ChannelsComposer;
use App\Mixins\StrMixins;
use App\PostcardSendingService;
use function foo\func;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGatewayContract::class, function ($app) {
            if (request()->has('credit')) {
                return new CreditPaymentGateway('USD');
            }
            return new BankPaymentGateway('USD');
        });
        $this->app->singleton('Postcard', function ($app) {
            return new PostcardSendingService('USA', 4, 6);

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Str::mixin(new StrMixins());

        ResponseFactory::macro('errorJson', function($message = "Default error message") {
            return [
                'message' => $message,
                'error_code' => 123,
            ];
        });


        // Option-1 Every single view
        // View::share('channels',Channel::orderBy('name')->get());

        // Option-2 Granular views with wildcards
//        View::composer(['post.*', 'channel.index'], function ($view) {
//            $view->with('channels', Channel::orderBy('name')->get());
//        });

        // Option-3 Dedicated class\
        View::composer(['partials.channels.*'], ChannelsComposer::class);
    }
}
