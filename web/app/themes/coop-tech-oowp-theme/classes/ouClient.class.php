<?php

use Outlandish\MappingCoTech\Fields\Fields;

class ouClient extends ouPost {

    public static function fetchAll($queryArgs = array()) {
        $defaults = array(
            'orderby' => 'title',
            'order' => 'asc'
        );

        $queryArgs = wp_parse_args($queryArgs, $defaults);

        return parent::fetchAll($queryArgs);
    }

    /**
     * @return string
     */
    public function name() {
        return $this->title();
    }

    /**
     * @param string $size
     * @param array $attrs
     * @return string
     */
    public function logoThumbnail($size = 'thumbnail', $attrs = array()) {
        return $this->featuredImage($size, $attrs);
    }

    /**
     * @param string $size
     * @param array $attrs
     * @return string
     */
    public function logoUrl($size = 'full', $attrs = array()) {
        if (!$this->logoThumbnail($size, $attrs)) {
            return 'http://placehold.it/300x200';
        }

        return $this->featuredImageUrl($size);
    }

    /**
     * @return string
     */
    public function websiteUrl() {
        return $this->metadata(Fields::WEBSITE_URL);
    }

}
