<?php

namespace App\Providers;

use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

            View::composer('*', function ($view) {
                // $createTask = '';
                if (Auth::check()) {
                    $userId = Auth::id();
                    $user_permissions = UserPermission::with('permission')
                        ->where('user_id', $userId)
                        ->get();
                    // dd($user_permissions);

                    
                    // Share with all views
                    $view->with([
                        'user_permissions' => $user_permissions
                    ]);
                }
            });
    }
}
