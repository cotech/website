<?php

use Outlandish\MappingCoTech\Fields\Fields;

class ouPerson extends ouPost
{

    public static function init()
    {
        parent::init();
    }

    public static function bruv()
    {
        parent::bruv();
        self::registerConnection(ouClient::postType(), ['cardinality' => 'many-to-many']);
        self::registerConnection(ouService::postType(), ['cardinality' => 'many-to-many', 'fields' =>
            [
                'description' => ["type" => "text", "title" => "Description"],
                'experience_points' => ["type" => "text", "title" => "Experience points"]
            ]]);
        self::registerConnection(ouTechnology::postType(), ['cardinality' => 'many-to-many', 'fields' =>
            [
                'description' => ["type" => "text", "title" => "Description"],
                'experience_points' => ["type" => "text", "title" => "Experience points"]
            ]]);
    }

    public static function friendlyName()
    {
        return 'Person';
    }

    public static function friendlyNamePlural()
    {
        return 'People';
    }

    public function permalink($leaveName = false)
    {
        $parentUrl = get_bloginfo('url') . '/people/';
        return $parentUrl . $this->post_name . '/';
    }

    public static function fetchAll($queryArgs = array())
    {
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
    public function name()
    {
        return $this->title();
    }

    /**
     * @return string
     */
    public function about()
    {
        return $this->content();
    }


    /**
     * @return ooWP_Query|ouService[]
     */
    public function services()
    {
        return $this->connected(ouService::postType(), false, $this->getQueryArgs());
    }
    /**
     * @return string
     */
    public function servicesList()
    {
        $links = [];
        foreach($this->services() as $service){
            $links []= "<a href='".$service->permalink()."' title='".$service->fields->description."'>".$service->title()."</a>";

        }
        return implode(", ", $links);
    }

    /**
     * @return string
     */
    public function experience()
    {
        return $this->metadata('years_experience');
    }
    /**
     *
     */
    public function availability($period = 10)

    {
        if(!in_array($period, [5,30,90])) {
            print "Wrong availanility available for $period days.";
            return false;
        };

        return $this->metadata("availability_".$period."_days");
    }

    public function costRate(){
        return $this->metadata('minimum_cost_rate');
    }

    public function commercialRate(){
        return $this->metadata('maximum_commercial_rate');

    }


    /**
     * @return ooWP_Query|ouTechnology[]
     */
    public function technologies()
    {
        return $this->connected(ouTechnology::postType(), false, $this->getQueryArgs());
    }

    /**
     * @return ooWP_Query|ouClient[]
     */
    public function clients()
    {
        return $this->connected(ouClient::postType(), false, $this->getQueryArgs());
    }

    /**
     * @return ooWP_Query|ouClient[]
     */
    public function coOp()
    {
        return $this->connected(ouCoOp::postType(), false, $this->getQueryArgs());
    }

    /**
     * @return string
     */
    public function phone()
    {
        return $this->metadata(Fields::PHONE);
    }

    /**
     * @return array
     */
    public function socialMedia()
    {
        return $this->metadata(Fields::SOCIAL_MEDIA);
    }

    /**
     * @return array
     */
    private function getQueryArgs()
    {
        return array(
            'orderby' => 'title',
            'order' => 'asc'
        );
    }

}
