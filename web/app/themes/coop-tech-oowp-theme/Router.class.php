<?php

class Router extends \ooRoutemaster {

	/**
	 * Called early in the WP boot sequence.
	 * Set up filters etc. here.
	 */
	protected function __construct() {
        parent::__construct();
        $this->routes   = [
            '|^co-op/([\w\-]+)/?$|' => 'coOpSingle',
            '|^service/([\w\-]+)/?$|' => 'service',
            '|^technology/([\w\-]+)/?$|' => 'technology',
            '|^about/?$|' => 'about',
            '|^join/?$|' => 'join',
            '|^manifesto/?$|' => 'manifesto',
            '|^people/?$|' => 'people', // This route is currently just for logged in users,
                                    // should redirect to 404 page if not logged in

            '|^constitution/?$|' => 'constitution',
            '|^co-?ops/?$|' => 'coops', // This route is currently just for logged in users,
                                    // should redirect to 404 page if not logged in
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

    protected function constitution() {
        $this->querySingle([
            'name' => 'constitution',
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

    protected function people() {

        if (is_user_logged_in()) {

            $this->view->people = ouPerson::fetchAll();

            global $post;
            $post = new ouFakePost(array('post_title' => 'People'));

        } else {

            $this->show404();

        }

    }

    protected function coops() {

        if (is_user_logged_in()) {

            $this->view->coops = ouCoOp::fetchAll();

            global $post;
            $post = new ouFakePost(array('post_title' => 'Co-ops'));

        } else {

            $this->show404();

        }

    }

    protected function show404() {
        global $post;
        $post = new ouFakePost(array('post_title' => 'Page not found'));
        header('HTTP/1.0 404 Not Found');
        if ($this->viewExists('404')) {
            $this->viewName = '404';
        } else {
            die('404 File not found');
        }
    }



}
