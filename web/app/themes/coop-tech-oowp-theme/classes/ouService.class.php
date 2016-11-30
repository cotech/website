<?php

use Outlandish\MappingCoTech\Fields\Fields;

class ouService extends ouPost {

    /**
     * @return string
     */
    public function name() {
        return $this->title();
    }

    /**
     * @return string
     */
     public function icon() {
         return $this->metadata(Fields::ICON);
     }

}
