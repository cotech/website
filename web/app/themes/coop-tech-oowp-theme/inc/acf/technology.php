<?php

use Outlandish\MappingCoTech\Fields\Fields;

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_technology',
        'title' => 'Technology',
        'fields' => array (
            array (
                'key' => 'field_583ecc9f17ad7',
                'label' => 'Logo',
                'name' => Fields::FEATURED_IMAGE,
                'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'required' => 'true',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => ouTechnology::postType(),
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
                0 => 'the_content'
            ),
        ),
        'menu_order' => 0,
    ));
}
