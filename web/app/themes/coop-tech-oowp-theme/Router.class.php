<?php

class Router extends \ooRoutemaster {

	/**
	 * Called early in the WP boot sequence.
	 * Set up filters etc. here.
	 */
	protected function __construct() {
        parent::__construct();
        // don't add routes here, add them in routes.php.
        // they will be loaded in functions.php
        $this->routes   = [
            '|^co-op/([\w\-]+)/?$|' => 'coOpSingle',
            '|^service/([\w\-]+)/?$|' => 'service',
            '|^technology/([\w\-]+)/?$|' => 'technology',
            '|^about$|' => 'about',
            '|^join$|' => 'join',
            '|^manifesto$|' => 'manifesto',
            '|^$|' => 'frontPage'
        ];

        $this->viewPath = get_template_directory() . '/views/';
        $this->layout = 'layout';

        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
    }

	protected function preDispatch($action, $args = array()) {
		parent::preDispatch($action, $args);
        $this->view->frontPage = ouPage::fetchById(get_option('page_on_front'));
	}

    /****************************************
	 *
	 * Routing methods
	 *
	 ***************************************/

    protected function frontPage() {
        $post = $this->querySingle(array('page_id' => get_option('page_on_front')), true);

        $this->view->clients = $post->clients();
        $this->view->coOps = ouCoOp::fetchAll();
        $this->view->services = ouService::fetchAll();
        $this->view->technologies = ouTechnology::fetchAll();
    }

    protected function coOpSingle($slug) {
        $this->querySingle([
            'name' => $slug,
            'post_type' => ouCoOp::postType()
        ]);
    }

    protected function service($slug) {
        $this->querySingle([
            'name' => $slug,
            'post_type' => ouService::postType()
        ]);
    }

    protected function technology($slug) {
        $this->querySingle([
            'name' => $slug,
            'post_type' => ouTechnology::postType()
        ]);
    }

    protected function about() {
        $this->querySingle([
            'name' => 'about',
            'post_type' => ouPage::postType()
        ]);
    }

    protected function join() {
        $this->querySingle([
            'name' => 'join',
            'post_type' => ouPage::postType()
        ]);
    }

    protected function manifesto() {
        $this->querySingle([
            'name' => 'manifesto',
            'post_type' => ouPage::postType()
        ]);
    }

}
