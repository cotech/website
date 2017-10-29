<?php
    use Outlandish\MappingCoTech\Fields\Fields;

    /** @var ouPage $post */
    $post = $this->post;

    /** @var ouClient[] | ooWP_Query $clients */
    $clients = $this->clients;

    /** @var ouCoOp[] | ooWP_Query $coOps */
    $coOps = $this->coOps;

    /** @var ouService[] | ooWP_Query $services */
    $services = $this->services;

    /** @var ouTechnology[] | ooWP_Query $technologies */
    $technologies = $this->technologies;

    /* Images */
    $imgDir = 'app/themes/coop-tech-oowp-theme/public/img';
    $iconClients = $imgDir . '/icon-clients.png';
    $iconCoops = $imgDir . '/icon-coops.png';
    $iconRevenue = $imgDir . '/icon-revenue.png';
    $iconStaff = $imgDir . '/icon-staff.png';

    /* KPI Logic */
    $kpiClients = count($clients) . '+';
    $kpiCoOps = count($coOps);
    $kpiRevenueNum = 0;
    $kpiStaffNum = 0;
    foreach ($coOps as $coOp) {
        $kpiRevenueNum += $coOp->turnover();
        $kpiStaffNum += $coOp->employeeCount();


    }
    $kpiRevenue = '';
    if ($kpiRevenueNum >= 1000000000) {
        $kpiRevenue = '£' . number_format($kpiRevenueNum / 1000000000, 2) . 'b';
    } else if ($kpiRevenueNum >= 1000000) {
        $kpiRevenue = '£' . number_format($kpiRevenueNum / 1000000, 1) . 'm';
    } else if ($kpiRevenueNum >= 1000) {
        $kpiRevenue = '£' . number_format($kpiRevenueNum / 1000, 0) . 'k';
    } else {
        $kpiRevenue = '£' . number_format($kpiRevenueNum, 0, '.', ',');
    }
    $kpiStaff = $kpiStaffNum . '+';
?>

<div class="home">

<div id="banner">
    <div class="row">
        <div class="small-12 columns">
            <h1>Cooperative Technologists</h1>
            <p>Building a tech industry that's better for its workers and customers through co-operation, democracy and worker ownership.</p>
            <span>
                <a id="video" data-open="video-modal"><i class="fi-play"></i>Watch video</a>
                <a id="our-manifesto" href="manifesto">Our manifesto</a>
            </span>

            <div class="reveal large" id="video-modal" data-reveal>
                <div class="flex-video widescreen">
                    <iframe width="420" height="315" src="https://player.vimeo.com/video/196080655" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="kpi">
    <div class="row">
        <div class="small-12 medium-10 large-8 small-centered columns">

            <div class="small-3 columns">
                <img src="<?php echo $iconCoops ?>" class="float-center">
                <h6>Co-ops</h6>
                <h5><?php echo $kpiCoOps ?></h5>
            </div>
            <div class="small-3 columns">
                <img src="<?php echo $iconStaff ?>" class="float-center">
                <h6>Staff</h6>
                <h5><?php echo $kpiStaff ?></h5>
            </div>
            <div class="small-3 columns">
                <img src="<?php echo $iconRevenue ?>" class="float-center">
                <h6>Revenue</h6>
                <h5><?php echo $kpiRevenue ?></h5>
            </div>
            <div class="small-3 columns">
                <img src="<?php echo $iconClients ?>" class="float-center">
                <h6>Clients</h6>
                <h5><?php echo $kpiClients ?></h5>
            </div>

        </div>
    </div>
</div>


<section id="members" data-magellan-target="members">
    <div class="row">
        <div class="small-12 columns">

            <h2>Members</h2>
            <p>Take a look at who is part of the CoTech network</p>

            <div class="view float-center">
                <ul class="tabs" data-tabs id="coops-view-tabs">
                    <li class="tabs-title is-active"><a href="#grid" aria-selected="true">Grid</a></li>
                    <li class="separator">|</li>
                    <li class="tabs-title"><a href="#map">Map</a></li>
                </ul>
            </div>

            <div class="tabs-content" data-tabs-content="coops-view-tabs">

                <!-- START Grid View Content -->
                <div class="tabs-panel is-active" id="grid">
                    <div class="row small-up-2 medium-up-4 large-up-6 small-collapse">

                        <?php foreach ($coOps as $coOp): ?>
                            <div class="column">
                                <a class="coop-thumb"
                                   href="<?php echo $coOp->permalink() ?>">
                                    <div class="coop-thumb-img has-tip tip-bottom radius"
                                         style="background-image: url(<?php echo $coOp->logoUrl() ?>)"
                                         data-tooltip
                                         aria-haspopup="true"
                                         title="<?php echo $coOp->name() ?>"></div>
                                </a>
                            </div>
                        <?php endforeach ?>

                        <div class="column">
                            <a href="join" class="coop-thumb">
                                <h5 id="join-us">Join CoTech</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Grid View Content -->

                <!-- START Map View Content -->
                <div class="tabs-panel" id="map">
                    <div class="row small-up-2 medium-up-4 large-up-6 small-collapse">
                        <div id="map-coops"></div>
                        <?php
                            $mapEntries = [];
                            foreach ($coOps as $coOp) {
                                if ($coOp->address()[Fields::LOCATION]) {
                                    array_push($mapEntries, array(
                                        'lat' => $coOp->address()[Fields::LOCATION][Fields::LATITUDE],
                                        'lng' => $coOp->address()[Fields::LOCATION][Fields::LONGITUDE],
                                        'markerText' => "<b>".$coOp->htmlLink()."</b><br>" . $coOp->addressHtml()
                                    ));
                                }
                            }
                            $encodedMapEntries = json_encode($mapEntries);
                        ?>
                        <script type="text/javascript">

                            var parsedMapEntries = <?php echo $encodedMapEntries; ?>;
                            var app = window.app || {};
                            app.mapEntries = parsedMapEntries;

                            // TODO fix bug with tiles not displaying properly until window resized

                        </script>
                    </div>
                </div>
                <!-- END Map View Content -->

            </div>

        </div>
    </div>
</section>


<section id="clients" data-magellan-target="clients">
    <div class="row">
        <div class="small-12 columns">

            <h2>Clients</h2>
            <p>Here are some of the amazing clients we have worked with so far</p>

            <div class="row small-up-2 medium-up-3 large-up-6">
                <?php foreach ($clients as $client): ?>
                    <div class="column">
                        <div class="client-thumb" style="background-image: url(<?php echo $client->logoUrl() ?>)" ></div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
    </div>
</section>


<section id="services" data-magellan-target="services">
    <div class="row">
        <div class="small-12 columns">

            <h2>Services</h2>
            <p>Here are the services the network are able to offer</p>

            <div class="row small-up-3 medium-up-4 large-up-6 small-collapse">
                <?php foreach ($services as $service): ?>
                    <div class="column">
                        <a href="<?php echo $service->permalink() ?>" class="service-thumb">
                            <div class="service-thumb-img float-center" style="background-image: url(<?php echo $service->iconUrl() ?>)" ></div>
                            <h5><?php echo $service->name() ?></h5>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>


<section id="technologies" data-magellan-target="technologies">
    <div class="row">
        <div class="small-12 columns">

            <h2>Technologies</h2>
            <p>Here are some of the technologies we are currently using - the list continues to grow!</p>

            <div class="row small-up-3 medium-up-4 large-up-6">
                <?php foreach ($technologies as $technology): ?>
                    <div class="column">
                        <a href="<?php echo $technology->permalink() ?>" class="technology-thumb">
                            <div class="technology-thumb-img" style="background-image: url(<?php echo $technology->logoUrl() ?>)" ></div>
                            <h5><?php echo $technology->name() ?></h5>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>


<section id="contact" data-magellan-target="contact">
    <div class="row">
        <div class="small-12 medium-6 small-centered columns">

            <h2>Get In Touch</h2>
            <p>
		If you would like to work with us, or find out more, 
                <a href="mailto:contact@coops.tech">email us</a> or join our <a href="https://community.coops.tech">online forum</a>.
                <br/>
                <br/>
                Not sure which tech coop, or coops, are right for you? Drop
                us a message at
                <a href="mailto:contact@coops.tech">contact@coops.tech</a>,
                and we will help you find the perfect match.
            </p>

            <!-- ?php echo do_shortcode( '[contact-form-7 id="1463" title="contact-form"]' ); ? -->

            <!-- form>
                <div class="row">
                    <div class="small-12 medium-6 columns">
                        <input type="text" placeholder="Name">
                    </div>
                    <div class="small-12 medium-6 columns">
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="small-12 columns">
                        <textarea placeholder="Type your message here"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 medium-4 small-centered columns">
                        <a class="large expanded button" href="mailto:contact@coops.tech">Send</a>
                    </div>
                </div>

            </form !-->

        </div>
    </div>
</section>

</div>
