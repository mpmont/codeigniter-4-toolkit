<?php namespace Toolkit\Config;

use CodeIgniter\Config\BaseConfig;

class Backend extends BaseConfig
{
    public $colors = [
        'sidebarBG' => '#343a40',
        'sidebarLink' => '#c2c7d0',
        'sidebarHover' => 'rgba(255,255,255,.1)',
        'sidebarHoverLink' => '#FFFFFF',
        'primaryColor' => '#007bff',
        'contentWrapper' => '#f4f6f9',
    ];
    public $siteName = 'CI - Toolkit';
    public $logoutControllerMethod = '#';
    public $loginName = 'Login';
    public $brandLink = '#';
    public $brand = 'CI - Tookit';
    public $logo = '';
    public $background = '';
    public $copyrightLeft = 'All rights reserved';
    public $copyrightRight = null;
    public $breadcrumb = false;

    public $assetsPath = 'backend';
    public $css = [
        '/plugins/fontawesome-free/css/all.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.cs',
        '/dist/css/adminlte.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
    ];
    public $js = [
        '/plugins/jquery/jquery.min.js',
        '/plugins/bootstrap/js/bootstrap.bundle.min.js',
        '/dist/js/adminlte.min.js',
    ];

    public $navigation = [
        [
            'name' => 'Dashboard',
            'link' => '#',
            'icon' => 'fas fa-circle nav-icon',
        ],
    ];
}
