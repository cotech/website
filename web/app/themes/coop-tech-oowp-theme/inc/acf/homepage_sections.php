<?php

//turn off this functionality for now
if(function_exists("register_field_group") && 1 == 0)
{
    register_field_group(array (
        'id' => 'acf_homepage-sections',
        'title' => 'Homepage Sections',
        'fields' => array (
            array (
                'key' => 'field_589dc69457767',
                'label' => 'Clients',
                'name' => 'homepage_clients',
                'type' => 'relationship',
                'instructions' => 'Add the clients to be featured on the front page. Max: 18. If none are added, 18 of the most recent ones will appear on the homepage instead.',
                'return_format' => 'id',
                'post_type' => array (
                    0 => 'client',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => 18,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '72',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
