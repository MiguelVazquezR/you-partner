<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Support\Facades\Hash;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        JsonResource::withoutWrapping();

        // VerifyEmail::toMailUsing(function ($notifiable) {
        //     return (new MailMessage)
        //         ->subject('Verificación de correo electrónico')
        //         ->greeting("¡Hola $notifiable->name!")
        //         ->line('Click al botón de abajo para verificar tu correo.')
        //         ->action('Verificar', route('verification.verify', ['id' => $notifiable->id, 'hash' => Hash::make('salt')]));
        // });
    }
}
