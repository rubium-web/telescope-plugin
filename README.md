# Laravel Telescope plugin for OctoberCMS

Provide [Laravel Telescope](https://laravel.com/docs/6.x/telescope) inside your OctoberCMS application.

> Minimal requirement : OctoberCMS 1.1.x

# Installation

To install from the [Marketplace](https://octobercms.com/plugin/rubium-telescope-plugin), click on the "Add to Project" button and then select the project you wish to add it to and pay for the plugin. Once the plugin has been added to the project, go to the backend and check for updates to pull in the plugin.

To install from the backend, go to **Settings -> Updates & Plugins -> Install Plugins** and then search for `Rubium.Telescope`.

To install from [the repository](https://github.com/rubium-web/telescope-plugin), clone it into **plugins/rubium/telescope** and then run `composer update` from your project root in order to pull in the dependencies.

To install it with Composer, run `composer require rubium/telescope-plugin` from your project root.

After installing plugin publish the Telescope's assets `php artisan vendor:publish --tag=telescope-assets`

### Usage

Set `APP_ENV` to `local` in `.env`.

If you need to change the configuration, publish the config file

`php artisan vendor:publish --tag=telescope-config`

## Dark mode

You can enable dark mode in your .env file: `ENABLE_TELESCOPE_DARK_MODE=true`

See [Laravel Telescope](https://laravel.com/docs/telescope) for more usage instructions and documentation.