<?php

use Outlandish\MappingCoTech\Fields\Fields;

class ouCoOp extends ouPost {

    public static function init() {
        parent::init();
    }

    public static function bruv() {
        parent::bruv();
        self::registerConnection(ouClient::postType());
        self::registerConnection(ouService::postType());
        self::registerConnection(ouTechnology::postType());
    }

    public static function friendlyName() {
        return 'Co-Op';
    }

    public static function friendlyNamePlural() {
        return 'Co-Ops';
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
        return $this->metadata(Fields::WEBSITE_URL);
    }

    /**
     * @return int
     */
    public function employeeCount() {
        return $this->metadata(Fields::EMPLOYEE_COUNT);
    }

    /**
     * @return int
     */
    public function turnover() {
        return $this->metadata(Fields::TURNOVER);
    }

    //TODO doc-ify
    public function address() {
        return $this->metadata(Fields::ADDRESS);
    }

    public function services() {
        return $this->metadata(Fields::SERVICES);
    }

    public function technologies() {
        return $this->metadata(Fields::TECHNOLOGIES);
    }

    public function clients() {
        return $this->metadata(Fields::CLIENTS);
    }

    /**
     * @return array
     */
    public function socialMedia() {
        return $this->metadata(Fields::SOCIAL_MEDIA);
    }

}
