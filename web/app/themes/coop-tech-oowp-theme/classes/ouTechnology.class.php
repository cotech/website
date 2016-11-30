<?php

class ouTechnology extends ouPost {

    public static function friendlyNamePlural() {
        return 'Technologies';
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
    public function logoUrl($size = 'thumbnail', $attrs = array()) {
        return $this->featuredImage($size, $attrs);
    }

}
