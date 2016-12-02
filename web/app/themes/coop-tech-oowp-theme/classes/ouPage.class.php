<?php

class ouPage extends ouPost {

    public function hasFrontPageMenu() {
        if ($this->isHomepage()) {
            return true;
        }
        return parent::hasFrontPageMenu();
    }

}
