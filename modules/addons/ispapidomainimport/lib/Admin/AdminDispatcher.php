<?php

namespace WHMCS\Module\Addon\IspapiDomainImport\Admin;

/**
 * Sample Admin Area Dispatch Handler
 */
class AdminDispatcher {

    /**
     * Dispatch request.
     *
     * @param string $action
     * @param array $args
     *
     * @return string
     */
    public function dispatch($action, $args)
    {
        if (!$action) {
            // Default to index if no action specified
            $action = 'index';
        }

        $controller = new Controller();

        // Verify requested action is valid and callable
        if (is_callable(array($controller, $action))) {
            $controller->$action($args);
        }

        //todo smarty output
        echo "<p>{$args['_lang']['actionerror']}</p>";
    }
}