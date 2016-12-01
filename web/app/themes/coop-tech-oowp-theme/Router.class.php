<?php

class Router extends \ooRoutemaster
{
	/**
	 * Called early in the WP boot sequence.
	 * Set up filters etc. here.
	 */
	protected function __construct()
	{
        parent::__construct();
        // don't add routes here, add them in routes.php.
        // they will be loaded in functions.php
        $this->routes   = [
            '|co-op/([\w\-]+)/?$|' => 'coOpSingle'
        ];

        $this->viewPath = get_template_directory() . '/views/';
        $this->layout = 'layout';

        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
    }

	protected function preDispatch($action, $args = array())
	{
		parent::preDispatch($action, $args);
	}

    /****************************************
	 *
	 * Routing methods
	 *
	 ***************************************/

    protected function frontPage() {
        parent::frontPage();
        $this->view->clients = ouClient::fetchAll();
        $this->view->coOps = ouCoOp::fetchAll();
        $this->view->services = ouService::fetchAll();
        $this->view->technologies = ouTechnology::fetchAll();
    }

    protected function coOpSingle($slug) {
        $this->querySingle([
            'name' => $slug,
            'post_type' => ouCoOp::postType()
        ]);
        $this->view->hello = 'Hello World';
}

}

