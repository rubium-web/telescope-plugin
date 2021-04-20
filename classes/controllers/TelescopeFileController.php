<?php namespace Rubium\Telescope\Classes\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class TelescopeFileController extends Controller
{
    public function appJs(): Response
    {
        return $this->getTelescopeFile('app.js', 'text/javascript');
    }

    public function appCss(): Response
    {
        return $this->getTelescopeFile('app.css', 'text/css');
    }

    public function favicon(): Response
    {
        return $this->getTelescopeFile('favicon.ico', 'image/x-icon');
    }

    public function appDarkCss(): Response
    {
        return $this->getTelescopeFile('app-dark.css', 'text/css');
    }

    private function getTelescopeFile($filePath, $type): Response
    {
        return new Response(file_get_contents(base_path('vendor/telescope/' . $filePath)), 200, [
            'Content-Type' => $type
        ]);
    }
}