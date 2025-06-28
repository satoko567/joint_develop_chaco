namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // ← これを追加！

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }
    }
}
