# codeigniter 4 Toolkit

A set of libraries and helpers for codeigniter 4

## Composer Install

This way you should run the following command in your terminal.

    composer require mpmont/ci-toolkit dev-master

Or add the following to your composer.json file.

    {
        "require": {
            "mpmont/ci-toolkit": "dev-master"
        }
    }

## Dependencies

- elephpant/breadcrumb [Breacrumb Library](https://github.com/sergiodanilojr/breadcrumb)
- almasaeed2010/adminlte [Admin LTE template](https://github.com/ColorlibHQ/AdminLTE)

## Suggested dependencies

### IonAuth

As an authentication system I suggest using Ion Auth. To add that to your project just run the following commands on your project.

    $ composer config minimum-stability dev
    $ composer config repositories.ionAuth vcs git@github.com:benedmunds/CodeIgniter-Ion-Auth.git
    $ composer require benedmunds/CodeIgniter-Ion-Auth:4.x-dev

Documentation for Ion Auth can be found [Here](https://github.com/benedmunds/CodeIgniter-Ion-Auth/blob/4/USERGUIDE.md).

### pwrsrg/codeigniter4-cart-module

In case you're building a store and need a cart module just add this to your composer.json and you're good to go.

    $ composer require pwrsrg/codeigniter4-cart-module

Documentation can be found [Here](https://github.com/pwrsrg/codeigniter4-cart-module).

## Base Controller

codeigniter-base-controller is an extended `BaseController` class to use in your CodeIgniter applications. Any controllers that inherit from `BaseController` get intelligent view autoloading and layout support. It's strongly driven by the ideals of convention over configuration, favouring simplicity and consistency over configuration and complexity.

#### Usage

If you install the package via composer then controllers should use a different namespace. In that case your controllers that extend to base Controller should extend to \Toolkit\Controllers\BaseController, like so:

    <?php namespace App\Controllers;

    class Home extends \Toolkit\Controllers\BaseController
    {

        /**
         * No view loading here!
         */
        public function index()
        {
        }

    }

#### Views and Layouts

Views will be loaded automatically based on the current controller and action name. Any variables set in `$this->data` will be passed through to the view and the layout. By default, the class will look for the view in _app/views/controller/action.php_.

In order to prevent the view being automatically rendered, set `$this->view` to `false`.

    $this->view = false;

Or, to load a different view than the automatically guessed view:

    $this->view = 'some_path/some_view.php';

Views will be loaded into a layout. The class will look for an _app/views/layouts/backend.php_ layout file or _app/views/layouts/application.php_ depending if it's the baseController or the adminController.

In case you want to override this in your controller just set your layout to whatever you want.

    $this->layout = 'layouts/yourlayout.php'

In order to specify where in your layout you'd like to output the view, the rendered view will be stored in a `$yield` variable:

    <h1>Header</h1>

    <div id="page">
        <?php echo $this->renderSection('yield') ?>
    </div>

    <p>Footer</p>

If you wish to disable the layout entirely and only display the view - a technique especially useful for AJAX requests - you can set `$this->layout` to `FALSE`.

    $this->layout = FALSE;

Like with `$this->view`, `$this->layout` can also be used to specify an unconventional layout file:

    $this->layout = 'layouts/mobile.php';

Any variables set in `$this->data` will be passed through to both the view and the layout files.

#### View structure

Your views should be created to support the built in functionality of layouts that comes with codeigniter 4

    <?php echo $this->extend($layout); ?>

    <?php echo $this->section('yield') ?>
        <h1>Hello World from the home/index view!</h1>
    <?php echo $this->endSection() ?>

As for your layouts, those should have a render section called yield.

    <!doctype html>
    <html>
    <head>
        <title>My Layout</title>
    </head>
    <body>
        This is my layout content
        <?php echo $this->renderSection('yield') ?>
    </body>
    </html>

To actually be able to rendere a view directly without the layout we need an empty layout doing the render. For that there's a nolayout.php file included in your Views/layouts folder that only does the view render.

    <?php echo $this->renderSection('yield') ?>

The complete folder structure is now included in the project.


### Loading Helpers in your controllers

If you want to load helpers in your controllers in a global scope and not inside a function all your have to do is declare the helpers property as array with all your helpers, like so:



    <?php namespace App\Controllers;

    class Home extends AdminController
    {
        protected $helpers = ['url'];

        public function index()
        {
        }

    }

This toolkit brings a few helpers that you can use in your application. For these you should use the helper function with the namespace declared.

    public function index()
    {
        helper('\Toolkit\calc');
        echo convertToPercent(1, 34, 2);
        // output 2.94
    }


# Using the provided AdminLTE template

To use the adminLTE in your project you should first create a backend folder inside your public folder.

    $ cd public
    $ mkdir backend

Then add the following line on your composer.json in your scripts section:

    "scripts": {
        "post-update-cmd": [
            "cp -R vendor/almasaeed2010/adminlte/dist/ public/backend",
            "cp -R vendor/almasaeed2010/adminlte/plugins/ public/backend"
        ]
    },

You can change the folders to adapt your project structure.

## Using the login view

To load the provided login view you shouldn't use the layouts since this is a view without layouts. To do so you can load it in your controllers like so:

    public function login() {
        $this->layout = false;
        $this->view = '\Toolkit\Views\login/index';
    }

This will use the provied login view that looks something like this:

![Login](https://i.imgur.com/wf6i0bB.png)

This view has the form helper has a dependency so you must set that in your controllers.

    protected $helpers = ['form'];

## Using the provided Admin template

There's a simple admin template provied you can use for your backend applications. To use this in your controllers or your base controller that extends to the provied base controller you can just set a new layout pointing to that specific view.

To do this in your controller just set the property layouts with this:

    protected $layout = '\Toolkit\Views\layouts/backend';

The default look of your admin template looks like this:

![Backend](https://i.imgur.com/C9PUEYP.png)

You can configure the looks of your admin template by creating a config class that extends to toolkit\Backend like so:


    <?php

    namespace Config;

    use CodeIgniter\Config\BaseConfig;

    class Backend extends \Toolkit\Config\Backend
    {
        public $colors = [
            'sidebarBG' => '#343a40', // Change the sidebar color
            'sidebarLink' => '#c2c7d0', // Change the sidebar link color
        ];
        public $siteName = 'CI - Toolkit'; // Change sitename
        public $logoutControllerMethod = '#'; // Change logout link
        public $brandLink = '#'; // Set a brand link relative to the app like /home/index
        public $brand = 'CI - Tookit'; // Set the brand name
        public $copyrightLeft = 'All rights reserved'; // Your copyright info Left
        public $copyrightRight = null; // Your copyright info right
        public $breadcrumb = false; // Want to use breadcrumbs

        public $assetsPath = 'backend'; // Set your base folder in your assets structrure, should be the same folder you set on your composer file

        // A list of all the assets you're using in your backend application, just add more here to add your custom css and js
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

        // Your navigation up to 2 levels deap
        public $navigation = [
            [
                'name' => 'Link 1',
                'link' => '#',
                'icon' => 'fas fa-circle nav-icon',
            ],
        ];
    }

If you decide to use the breadcrumbs that will use another dependency elephpant/breadcrumb. Look up to their documentation to use the breadcrumbs.

In case you need a menu structure with two levels you should set that up like so:

    public $navigation = [
        [
            'name' => 'Link 1',
            'link' => '#',
            'icon' => 'fas fa-circle nav-icon',
            'childs' => [
                [
                    'name' => 'Link 1.1',
                    'link' => '#',
                    'icon' => 'fas fa-circle nav-icon',
                ],
                [
                    'name' => 'Link 1.2',
                    'link' => '#',
                    'icon' => 'fas fa-circle nav-icon',
                ],
                [
                    'name' => 'Link 1.3',
                    'link' => '#',
                    'icon' => 'fas fa-circle nav-icon',
                ],
            ],
        ],
    ];


# Notification Library

Sending emails is a core feature of almost all your applications, so instead of having to repeat code to send emails over and over again I create a small library to help you there.

To setup your config you just need to copy the provided codif in /config/Notification.php to your app/Config/Notification.php and don't forget to change your namespace.

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

Then to use the library is as easy as:

    $notification = new \Toolkit\Libraries\Notification();
    $data = [
        'to' => 'destionation@email.com',
        'subject' => 'Your subject',
        'message' => 'Your message, this can be a view too',
    ];
    $notification->send($data);

# Provided Helpers in the Toolkit

The toolkit brings a set of helpers that you can use in your application, this will probably be one of the more growing parts of this project.

## Array Helper

Loading the Array Helper

    helper('\Toolkit\array');

### Array Flatten

Convert a multi-dimensional array into a single-dimensional array.

    $newArray = array_flatten($array);

### Average Array

Returns the average value in an array of numbers.

    $avgArray = avg_array($array);

## Calc Helper

Loading the Calc Helper

    helper('\Toolkit\calc');

### Convert To Percent

Get a percentage value based on another value. Example: 1 is how much percentage of 34?

    $slice = 1;
    $cake = 34;

    echo convertToPercent($slice, $cake);
    // Output 3

However there's a third param that you can set that gives the round value like so:

    $slice = 1;
    $cake = 34;
    echo convertToPercent(1, 34, 2);
    // output 2.94

### Calc Inverted

Let's say you need to calc the percentage in a inverted value. So your max score is 0, min score is 200. The closer the value is to zero the higher the percentage. If the value is higher than 200 then 0 is your score.

    $maxScore = 0;
    $minScore = 200;
    $score 100;
    echo calcInverted($maxScore, $minScore, $score);
    // outputs 100

## Date Helper

Loading the Date Helper

    helper('\Toolkit\date');

### Transform date into a new format

    $date = '20-10-2020';
    $format = 'Y-m-d H:i:s';
    echo validateDate($date, $format)
    // Outputs 20-10-2020 00:00:00

## Error Helper

Loading the Error Helper

    helper('\Toolkit\error');

### Show a 404 error

    show_404();

## String Helper

Loading the String Helper

    helper('\Toolkit\string');

### Get random string

    echo getRandomString(10);
    // Outputs a random string with lenght of 10

### Translate a string from latin character to the correspondent non latin characters

So basically all characters like: Áãà will be translated to just "a". This is specially usefull if your doing something with urls and want to remove those from the url.

    $string = 'Cão';
    echo transliterateString($string);
    // outputs "Cao"

### Decimal Number

This will translate any int into a decimal. So 3 can be 3.00 or even 3.000

    echo decimal_number(3, 2);
    // Outputs 3.00

### Round up and Round down a value

    echo round_up(4.5, 3);
    // Output 5.000
    echo round_down(4.5, 3);
    // Output 4.000

