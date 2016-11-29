<?php

class Router extends \ooRoutemaster
{
	/**
	 * Called early in the WP boot sequence.
	 * Set up filters etc. here.
	 */
	protected function __construct()
	{
	    // don't add routes here, add them in routes.php.
        // they will be loaded in functions.php
		$this->routes   = [];
		parent::__construct();
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

}

