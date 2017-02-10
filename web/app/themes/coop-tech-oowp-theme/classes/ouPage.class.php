<?php

class ouPage extends ouPost {

    public function hasFrontPageMenu() {
        if ($this->isHomepage()) {
            return true;
        }
        return parent::hasFrontPageMenu();
    }

    /**
     * Returns an array of ouClient posts connected to the page
     *
     * For pages that aren't the homepage, this will return an empty array.
     * When no Clients are connected to the homepage, this will return the
     * 18 most recent ones. Otherwise it will return the clients that were
     * connected to the Homepage.
     *
     * @return array|ooWP_Query|ouClient[]
     */
    public function clients() {
        if (!$this->isHomepage()) {
            return [];
        }

        $ids = $this->metadata('homepage_clients');

        if (!$ids || empty($ids)) {
            return ouClient::fetchAll(['posts_per_page' => 18]);
        }

        return ouClient::fetchById($ids);
    }

}
