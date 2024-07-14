<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(OpenAI\Client::class, function ($app) {
            return OpenAI::client(config('openai.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https'); 
        
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
        return (new MailMessage)
            ->subject('メールアドレスの確認')
            ->line('以下のボタンをクリックして、メールアドレスを確認してください。')
            ->action('メールアドレスを確認', $url)
            ->line('このメールに心当たりがない場合は、無視してください。');
    });
    }
}
