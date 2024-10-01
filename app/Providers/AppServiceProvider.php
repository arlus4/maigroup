<?php

namespace App\Providers;

use App\Models\Users_Detail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) { // Cek apakah pengguna telah masuk
                $user = Auth::user()->id;
                $global_users = Users_Detail::select('name', 'avatar', 'path_avatar', 'nomor_telfon', 'register_id', 'is_active')
                                ->leftjoin('users_login', 'users_details.user_id', '=', 'users_login.id')
                                ->where('users_details.user_id', $user)
                                ->first();
                $view->with('global_user', $global_users);
            } else {
                $view->with('global_user', null);
            }
        });

        // Menambahkan directive rupiah ke Blade
        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
