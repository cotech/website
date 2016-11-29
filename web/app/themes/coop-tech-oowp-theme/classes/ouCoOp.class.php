<?php

class ouCoOp extends ouPost {

    public static function init()
    {
        parent::init();
        self::registerConnection(ouClient::postType()); // TODO + the rest
        self::registerConnection(ouService::postType());
        self::registerConnection(ouTechnology::postType());
    }

    /**
     * @return string
     */
    public function name() {
        return $this->title();
    }

    /**
     * @return string
     */
    public function about() {
        return $this->content();
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

    /**
     * @return string
     */
    public function address() {
        return $this->metadata('address');
    }

    /**
     * @return int
     */
    public function employeeCount() {
        return $this->metadata('employeeCount');
    }

    //TODO doc-ify
    public function services() {
        return $this->metadata('services');
    }

    public function technologies() {
        return $this->metadata('technologies');
    }

    public function clients() {
        return $this->metadata('clients');
    }

    //public function email() {}

    /**
     * @return array
     */
    public function socialMedia() {
        return $this->metadata('socialMedia');
    }

}
