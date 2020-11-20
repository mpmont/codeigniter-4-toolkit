<?php namespace Toolkit\Config;

use CodeIgniter\Config\BaseConfig;

class Notification extends BaseConfig
{
    public $settings = [
        'mailtype' => 'html',
        'protocol' => 'smtp',
        'smtp_host' => '',
        'smtp_user' => '',
        'smtp_pass' => '',
        'smtp_port' => '587',
        'smtp_timeout' => '15',
    ];
    public $from = [
        'email' => 'noreply@site.com',
        'name' => 'noreply',
    ];
    public $bcc = '';
}
