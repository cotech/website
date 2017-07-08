<?php

abstract class ouPost extends ooRoutemasterPost {

    public function hasFrontPageMenu() {
        return false;
    }

    public static function getRegistrationArgs($defaults){
        $args = [
            'public'       => true,
          "show_in_rest" => true
        ];
        return array_merge($defaults, $args);
    }

}
