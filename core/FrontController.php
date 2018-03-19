<?php

class FrontController
{

    /**
     * Centralized entry point for handling requests.
     * Call appropriate controller based on URL
     */
    public function __construct()
    {
        // register autoload methods
        spl_autoload_register(array($this, '_basic_core_autoloader'));
        if (is_readable(ROOT . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {
            include ROOT . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        }

        // filter controller, action and params
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL); // $_GET['url']
        $params = explode('/', trim($url, '/'));

        // store first and seccond params, removing them from params list
        $controller_name = ucfirst(array_shift($params)); // uppercase classname
        $action_name = array_shift($params);

        // default controller and action
        if (empty($controller_name)) {
            $controller_name = AppConfig::DEFAULT_CONTROLLER;
        }
        if (empty($action_name)) {
            $action_name = AppConfig::DEFAULT_ACTION;
        }

        // load requested controller
        if (class_exists($controller_name)) {
            /** @var Controller $controller */
            $controller = new $controller_name();

            // verify if action is valid
            if (method_exists($controller, $action_name)) {
                /** @todo catch exceptions and render them */
                $return = call_user_func_array(array($controller, $action_name), $params);
                if (!isset($return)) {
                    $controller->render("$controller_name/$action_name"); // skipped if already rendered
                } elseif (is_array($return) || (is_object($return) && !method_exists($return, '__toString'))) {
                    echo @json_encode($return);
                } else {
                    echo $return;
                }
            } else {
                // action not found
                $this->notFound();
            }
        } else {
            // controller not found
            $this->notFound();
        }
    }

    private function _basic_core_autoloader($class)
    {
        // namespaces must be resolved by composer
        if (strpos($class, '\\') === false) {
            $ext = '.php';
            $search_paths = array(
                CORE,
                APP,
                APP . 'Controller' . DIRECTORY_SEPARATOR,
                APP . 'Model' . DIRECTORY_SEPARATOR,
            );
            foreach ($search_paths as $base_path) {
                if (is_readable($base_path . $class . $ext)) {
                    include $base_path . $class . $ext;
                    return true;
                }
            }
        }
    }

    /**
     * Show to user an error message
     */
    private function notFound()
    {
        if (file_exists(APP . 'Controller/error.php')) {
            header('Location: ' . BASE_URL . 'error');
        } else {
            die('Sorry, the requested content could not be found');
        }
    }

}
