<?php

use Outlandish\MappingCoTech\Fields\Fields;

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_service',
        'title' => 'Service',
        'fields' => array (
            array (
                'key' => 'field_583ebc5b6443e',
                'label' => 'Icon',
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
                    'value' => ouService::postType(),
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
