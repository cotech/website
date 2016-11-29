<?php
/**
 * Add the output of the ACF exporter to php files in this directory.
 * This function will be loaded and run in the functions.php and will load
 * all ACF configs that it finds.
 */
function load_acf() {
    foreach (scandir(dirname(__FILE__)) as $filename) {
        $path = dirname(__FILE__) . '/' . $filename;
        if (is_file($path)) {
            require_once $path;
        }
    }
}