<?php namespace Rubium\Telescope;

use Backend\Facades\BackendAuth;
use Backend\Helpers\Backend;
use Backend\Models\User;

use Illuminate\Foundation\AliasLoader;
use Laravel\Telescope\Telescope;
use System\Classes\PluginBase;

// use Rubium\Telescope\Classes\Providers\TelescopeServiceProvider;

/**
 * Telescope Plugin Information File
 */
class Plugin extends PluginBase
{
    /** @var Backend */
    private $backend;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->backend = app()->make(Backend::class);
    }

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Telescope',
            'description' => 'No description provided yet...',
            'author'      => 'Rubium',
            'iconSvg' => $this->backend->url('rubium/telescope/telescope/icon')
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/telescope.php', 'telescope'
        );

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

        app()->register(\Illuminate\Auth\AuthServiceProvider::class);
        app()->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        app()->register(\Rubium\Telescope\Classes\Providers\TelescopeServiceProvider::class);

        Telescope::auth(function ($request) {
            if (!BackendAuth::check()) {
                return false;
            }

            /** @var User $user */
            $user = BackendAuth::getUser();

            return $user->isSuperUser() || $user->hasPermission('rubium.telescope.access');
        });

        if (config('rubium.telescope::dark_mode')) {
            Telescope::night();
        }
    }

    public function registerSchedule($schedule): void
    {
        $schedule->command('telescope:prune')->daily();
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions(): array
    {
        return [
            'rubium.telescope.access' => [
                'tab'   => 'Telescope',
                'label' => 'Access Laravel to the Telescope dashboard',
                'roles' => ['developer'],
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation(): array
    {
        return [
            'telescope' => [
                'label' => 'Telescope',
                'url' => $this->backend->url('rubium/telescope/telescope'),
                'iconSvg' => '/plugins/rubium/telescope/assets/telescope.svg',
                'order' => 500,
                'permissions' => ['rubium.telescope.access'],
            ]
        ];
    }
}
