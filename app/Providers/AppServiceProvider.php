<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\DB;

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
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Home',
                'url'  => '',
                'icon' => 'home',
                'icon_color' => 'blue',
            ]);
            
            $user_role = session('user_role');

            $menus =  DB::table('menus')
                ->where('menu_role', '=', $user_role)
                ->where('menu_status', '=', 'active')
                ->orderBy('menu_id', 'asc')
                ->get();

            foreach ($menus as $menu) {
                $arrayMenu = array('text' => '', 'url' => '', 'icon' => '');

                if ($menu->submenu_id == 0) {
                    if ($menu->parent_id == 0) {
                        $event->menu->add([
                            'text' => $menu->menu_name,
                            'url' => $menu->menu_url,
                            'icon' => $menu->menu_icon,
                        ]);
                    }
                }
                else{
                    //submenu ids are stored as string in DB.
                    //Need to convert to array for running next query
                    $submenu_ids = explode(',', $menu->submenu_id);

                    $SubMenus =  DB::table('menus')
                        ->whereIn('menu_id', $submenu_ids)
                        ->where('menu_status', '=', 'active')
                        ->get();

                    $count = count($SubMenus);

                    foreach ($SubMenus as $submenu) {

                        $arrayMenu[] = array(
                            'text' => $submenu->menu_name,
                            'url' => $submenu->menu_url,
                            'icon' => $submenu->menu_icon
                        );
                    };
                    $event->menu->add([
                        'text' => $menu->menu_name,
                        'url' => $menu->menu_url,
                        'icon' => $menu->menu_icon,
                        'label' => $count,
                        'label_color' => 'success',
                        'submenu' => $arrayMenu,
                    ]);
                }
            }

            $event->menu->add('ACCOUNT SETTINGS');
            $event->menu->add([
                'text' => 'Profile',
                'url'  => 'admin/settings',
                'icon' => 'user',
                'icon_color' => 'red',
            ]);
            $event->menu->add([
                'text' => 'Change Password',
                'url'  => 'admin/settings',
                'icon' => 'lock',
                'icon_color' => 'aqua',

            ]);


        });
    }
}
