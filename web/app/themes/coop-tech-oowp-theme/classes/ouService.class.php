<?php

use Outlandish\MappingCoTech\Fields\Fields;

class ouService extends ouPost {

    public function permalink($leaveName = false) {
        $parentUrl = get_bloginfo('url') . '/service/';
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
     public function icon() {
         return $this->metadata(Fields::ICON);
     }

    /**
     * @return ooWP_Query|ouCoOp[]
     */
     public function coOps() {
         return $this->connected(ouCoOp::postType(), false);
     }

}
