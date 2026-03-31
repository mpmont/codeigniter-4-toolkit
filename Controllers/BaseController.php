<?php

namespace Toolkit\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @
 * @package CodeIgniter
 *
 * @author Marco Monteiro @marcogmonteiro
 * @license    https://opensource.org/licenses/MIT  MIT License
 *
 * @link       https://github.com/mpmont/ci4-adminController
 * @link       https://blog.marcomonteiro.net
 */

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    protected ?string $view = null; // Set default yield view
    protected array $data = []; // Set default data array
    protected string $layout = 'layouts/application'; // Set default layout
    protected array $arguments = []; // arguments that will be sent to the methods
    protected ?string $directory = null; // Set the base folder in case you're running your site on site.com/admin then this should have the value admin
    protected $session;

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();
        // Required if you're using flashdata
        $this->session = \Config\Services::session();

        //--------------------------------------------------------------------
        // Check for flashdata
        //--------------------------------------------------------------------
        $this->data['confirm'] = $this->session->getFlashdata('confirm');
        $this->data['errors']  = $this->session->getFlashdata('errors');

        // Arguments to be used in the callback remap
        $segments = $request->getUri()->getSegments();
        $offset = ($this->directory === null) ? 2 : 3;
        $this->arguments = array_slice($segments, $offset);

        $this->data['adminConf'] = new \Toolkit\Config\Backend();
    }

    /**
     * --------------------------------------------------------------------
     *   REMAP AUTOLOAD VIEWS
     * --------------------------------------------------------------------
     */

    /**
     * Remap the CI request, running the method
     * and loading the view automagically
     * @param string $method The method we're trying to load
     */
    public function _remap(string $method = null)
    {
        $router = service('router');

        if (! method_exists($this, $method)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $controllerFullName = explode('\\', $router->controllerName());
        $viewFolder = strtolower(end($controllerFullName));

        $result = call_user_func_array([$this, $method], $this->arguments);

        if ($result instanceof ResponseInterface) {
            return $result;
        }

        if (is_array($result) && isset($result['url'])) {
            $redirect = redirect()->to($result['url']);

            if (! empty($result['confirm'])) {
                return $redirect->with('confirm', $result['confirm']);
            }

            if (! empty($result['errors'])) {
                return $redirect->with('errors', $result['errors']);
            }

            return $redirect;
        }

        if ($this->view === false) {
            return $result;
        }

        $base = $this->directory ? trim($this->directory, '/') . '/' : '';
        $methodName = $router->methodName();

        $this->data['layout'] = $this->layout ?: 'layouts/nolayout';
        $this->data['yield'] = $this->view
            ? $this->view
            : strtolower($base . $viewFolder . '/' . $methodName);

        return view($this->data['yield'], $this->data);
    }
}
