<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository as IlluminateConfig;

use App\Repositories\Entities\Menu;
use Blade;
use General;
use Sentinel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(IlluminateConfig $config)
    {
        view()->composer('*', function ($view) use ($config) {
            $pathp = "";

            (($config->get('app.env') == "local") ? $pathp="" : $pathp="public/" );
            
            $view->withPathp($pathp);
        });

        $this->bootBladeCustomDirectives();
        $this->bootMenuViewComposer();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function bootBladeCustomDirectives()
    {
        Blade::directive('hasaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php if (has_access({$expression})): ?>";
            }

            return;
        });
        // dd(Sentinel::check());

        Blade::directive('endhasaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php endif; ?>";
            }

            return;
        });
    }
    /**
     * Bootstrap our menus.
     *
     * @return void
     */
    private function bootMenuViewComposer()
    {
        view()->composer('backend.layout.layout', function ($view) {
            $index = 0;
            $menus = Menu::where('parent', null)->orderBy('id', 'ASC')->get()->toArray();
            
            foreach ($menus as $menu) {
                if ((bool) $menu['is_parent']) {
                    if ($child = Menu::where('parent', $menu['id'])->get()->toArray()) {
                        foreach ($child as $value) {
                            $menus[$index]['child'][] = $value;
                            $menus[$index]['child_permissions'][] = $value['name'];
                        }
                    }
                }

                $index++;
            }
            
            $view->withMenus($menus);
        });
    }

    
}
