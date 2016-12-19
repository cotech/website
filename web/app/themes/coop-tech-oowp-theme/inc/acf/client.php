<?php

use Outlandish\MappingCoTech\Fields\Fields;

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_client',
        'title' => 'Client',
        'fields' => array (
            array (
                'key' => 'field_583ebb967113a',
                'label' => 'Logo',
                'name' => Fields::FEATURED_IMAGE,
                'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'required' => 'true',
            ),
            array (
                'key' => 'field_583ebbad7113b',
                'label' => 'Website URL',
                'name' => Fields::WEBSITE_URL,
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => ouClient::postType(),
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
