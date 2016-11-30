<?php

use Outlandish\MappingCoTech\Fields\Fields;

class Address {

    /**
     * @return string
     */
    public function addressLine1() {
        return $this->metadata(Fields::ADDRESS_LINE_1);
    }

    /**
     * @return string
     */
    public function addressLine2() {
        return $this->metadata(Fields::ADDRESS_LINE_2);
    }

    /**
     * @return string
     */
    public function addressLine3() {
        return $this->metadata(Fields::ADDRESS_LINE_3);
    }

    /**
     * @return string
     */
    public function city() {
        return $this->metadata(Fields::CITY);
    }

    /**
     * @return string
     */
    public function country() {
        return $this->metadata(Fields::COUNTRY);
    }

    /**
     * @return string
     */
    public function postcode() {
        return $this->metadata(Fields::POSTCODE);
    }

    /**
     * @return float
     */
    public function location() {
        return $this->metadata(Fields::LOCATION);
    }

}