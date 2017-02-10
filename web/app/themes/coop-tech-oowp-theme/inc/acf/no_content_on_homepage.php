<?php
if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_homepage-content',
        'title' => 'Homepage Content',
        'fields' => array (
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
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
}
