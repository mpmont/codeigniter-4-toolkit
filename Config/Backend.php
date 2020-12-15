<?php namespace Toolkit\Config;

use CodeIgniter\Config\BaseConfig;

class Backend extends BaseConfig
{
    public $colors = [
        'sidebarBG' => '#343a40',
        'sidebarLink' => '#c2c7d0',
    ];
    public $siteName = 'CI - Toolkit';
    public $logoutControllerMethod = '#';
    public $brandLink = '#';
    public $brand = 'CI - Tookit';
    public $copyrightLeft = 'All rights reserved';
    public $copyrightRight = null;
    public $breadcrumb = false;

    public $navigation = [
        [
            'name' => 'Dashboard',
            'link' => '#',
            'icon' => 'fas fa-circle nav-icon',
        ],
    ];
}
