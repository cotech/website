<?php

use Outlandish\MappingCoTech\Fields\Fields;

class ouCoOp extends ouPost {

    public static function init() {
        parent::init();
    }

    public static function bruv() {
        parent::bruv();
        self::registerConnection(ouClient::postType(), ['cardinality' => 'many-to-many']);
        self::registerConnection(ouService::postType(), ['cardinality' => 'many-to-many']);
        self::registerConnection(ouTechnology::postType(), ['cardinality' => 'many-to-many']);
    }

    public static function friendlyName() {
        return 'Co-Op';
    }

    public static function friendlyNamePlural() {
        return 'Co-Ops';
    }

    public function permalink($leaveName = false) {
        $parentUrl = get_bloginfo('url') . '/co-op/';
        return $parentUrl . $this->post_name . '/';
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
    public function logoThumbnail($size = 'thumbnail', $attrs = array()) {
        return $this->featuredImage($size, $attrs);
    }

    /**
     * @param string $size
     * @param array $attrs
     * @return string
     */
    public function logoUrl($size = 'thumbnail', $attrs = array()) {
        if (!$this->logoThumbnail($size, $attrs)) {
            return 'http://placehold.it/300x300';
        }

        return $this->featuredImageUrl($size);
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

    /**
     * @return array|string
     */
    public function address() {
        return $this->metadata(Fields::ADDRESS);
    }

    /**
     * @return ooWP_Query|ouService[]
     */
    public function services() {
        return $this->connected(ouService::postType(), false);
    }

    /**
     * @return ooWP_Query|ouTechnology[]
     */
    public function technologies() {
        return $this->connected(ouTechnology::postType(), false);
    }

    /**
     * @return ooWP_Query|ouClient[]
     */
    public function clients() {
        return $this->connected(ouClient::postType(), false);
    }

    /**
     * @return array
     */
    public function socialMedia() {
        return $this->metadata(Fields::SOCIAL_MEDIA);
    }

}
