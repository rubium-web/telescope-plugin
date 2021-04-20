<?php namespace Rubium\Telescope\Controllers;

use Backend\Classes\Controller;
use Backend\Classes\NavigationManager;

class Telescope extends Controller
{
    public $requiredPermissions = ['rubium.telescope.access'];

    public function __construct()
    {
        parent::__construct();

        NavigationManager::instance()->setContext('Rubium.Telescope', 'telescope', 'telescope');
    }

    public function index()
    {
        $this->pageTitle = 'Telescope dashboard';
    }
}
