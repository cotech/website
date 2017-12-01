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
        self::registerConnection(ouPerson::postType(), ['cardinality' => 'many-to-many']);
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
    public function logoUrl($size = 'full', $attrs = array()) {
        if (!$this->logoThumbnail($size, $attrs)) {
            return 'http://placehold.it/300x185';
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

        //todo - this code should be removed once the new employee data has been populated in the WP admin
        //this is odd but leaving it as it is as it's getting deleted
            $deprecatedEmployeeCountString =$this->metadata(Fields::EMPLOYEE_COUNT);
            $firstExplosion = explode('+', $deprecatedEmployeeCountString);
            $secondExplosion = explode('-', $firstExplosion[0]);
            $deprecatedEmployees = ceil(intval($secondExplosion[0]) + intval(isset($secondExplosion[1]) ? $secondExplosion[1] : 0) /2) ;


        return  $this->metadata(Fields::CURRENT_TOTAL_WORKERS) ?: $deprecatedEmployees ?: 0 ;
    }

    /**
     * @return int
     *
     */
    public function turnover() {
        $deprecatedTurnover = $this->metadata(Fields::TURNOVER);
        //if the turnover is not set assume the employees earn the average UK income (£27,200)
        $turnover = $this->metadata(Fields::CURRENT_TURNOVER);

        return $turnover ?: $deprecatedTurnover ?: $this->employeeCount() * 27200 ?: 0;
    }

    /**
     * @return array|string
     */
    public function address() {
        return $this->metadata(Fields::ADDRESS)[0];
    }

    /**
     * @return array
     */
    public function addressAsArray() {
        $array = array();
        $address = $this->address();
        if ($address[Fields::ADDRESS_LINE_1]) {
            array_push($array, $address[Fields::ADDRESS_LINE_1]);
        }
        if ($address[Fields::ADDRESS_LINE_2]) {
            array_push($array, $address[Fields::ADDRESS_LINE_2]);
        }
        if ($address[Fields::ADDRESS_LINE_3]) {
            array_push($array, $address[Fields::ADDRESS_LINE_3]);
        }
        if ($address[Fields::CITY]) {
            array_push($array, $address[Fields::CITY]);
        }
        if ($address[Fields::COUNTRY]) {
            array_push($array, $address[Fields::COUNTRY]);
        }
        if ($address[Fields::POSTCODE]) {
            array_push($array, $address[Fields::POSTCODE]);
        }
        return $array;
    }

    function addressHtml($separator = "<br />"){
        $address = $this->address();
        $addressHtml = '';
        $addressFields = [Fields::ADDRESS_LINE_1, Fields::ADDRESS_LINE_2,Fields::ADDRESS_LINE_3, Fields::CITY,Fields::COUNTRY, Fields::POSTCODE];
        foreach($addressFields as $field){
            if(isset($address[$field]) && $address[$field]){
                $addressHtml .= htmlspecialchars($address[$field]);
                $addressHtml .= $separator;
            }
        }
        return $addressHtml;
    }

    /**
     * @return ooWP_Query|ouService[]
     */
    public function services() {
        return $this->connected(ouService::postType(), false, $this->getQueryArgs());
    }

    /**
     * @return ooWP_Query|ouTechnology[]
     */
    public function technologies() {
        return $this->connected(ouTechnology::postType(), false, $this->getQueryArgs());
    }

    /**
     * @return ooWP_Query|ouClient[]
     */
    public function clients() {
        return $this->connected(ouClient::postType(), false, $this->getQueryArgs());
    }

    /**
     * @return ooWP_Query|ouPeople[]
     */
    public function people() {
        return $this->connected(ouPerson::postType(), false, $this->getQueryArgs());
    }


    public function leadTime(){
        return $this->metadata('lead_time') ?: 0;
    }
    public function minimumDayRate(){
        return $this->metadata('minimum_day_rate');
    }
    public function standardDayRate(){
        return $this->metadata('maximum_day_rate');
    }
    public function vatRegistered(){
        return $this->metadata('vat_registered');
    }
    public function timeAndMaterials(){
        $meta = (array) $this->metadata('contract_types');
        if(in_array('Time/materials', $meta))
        return true;
    }
    public function fixedPriceContracts(){
        $meta = (array) $this->metadata('contract_types');
        if(in_array('Fixed price', $meta))
        return true;
    }

    public function legalStructure(){
        return $this->metadata('legal_structure') ?: "";
    }
    /**
     * @return string
     */
    public function phone() {
        return $this->metadata(Fields::PHONE);
    }

    /**
     * @return array
     */
    public function socialMedia() {
        return $this->metadata(Fields::SOCIAL_MEDIA);
    }

    /**
     * @return array
     */
    private function getQueryArgs() {
        return array(
            'orderby' => 'title',
            'order' => 'asc'
        );
    }

}
