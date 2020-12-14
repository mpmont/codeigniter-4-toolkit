<?php namespace Toolkit\Config;

use CodeIgniter\Config\BaseConfig;

class Backend extends BaseConfig
{
    public $siteName = null;
    public $logoutControllerMethod = null;
    public $brandLink = '#';
    public $brand = '';
    public $copyright = null;

    public $navigation = [
        [
            'name' => 'Dashboard',
            'link' => 'admin/dashboard',
            'icon' => 'fas fa-circle nav-icon',
        ],
    ];
}
