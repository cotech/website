<?php

class ouClient extends ouPost {

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

    /**
     * @return string
     */
    public function websiteUrl() {
        return $this->metadata('websiteUrl');
    }

}
