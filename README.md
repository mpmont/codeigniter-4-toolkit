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

- elephpant/breadcrumb
- almasaeed2010/adminlte

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

## Suggestions

As an authentication system I suggest using Ion Auth. To add that to your project just run the following commands on your project.

    $ composer config minimum-stability dev
    $ composer config repositories.ionAuth vcs git@github.com:benedmunds/CodeIgniter-Ion-Auth.git
    $ composer require benedmunds/CodeIgniter-Ion-Auth:4.x-dev

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

