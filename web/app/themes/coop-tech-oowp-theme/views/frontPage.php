<?php
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

    $imgDir = 'app/themes/coop-tech-oowp-theme/public/img';
    $iconClients = $imgDir . '/icon-clients.png';
    $iconCoops = $imgDir . '/icon-coops.png';
    $iconRevenue = $imgDir . '/icon-revenue.png';
    $iconStaff = $imgDir . '/icon-staff.png';
?>

<div class="home">

<div id="banner">
    <div class="row">
        <div class="small-12 columns">
            <h1>Cooperative Technologists</h1>
            <p>We are a network of worker-owned tech businesses who are passionate about:</p>
            <ul class="no-bullet">
                <li>Democracy, equality and diversity in the workplace</li>
                <li>Sharing our skills and knowledge</li>
                <li>Creating positive social value</li>
            </ul>
            <span>
                <a id="our-manifesto" href="manifesto">See our manifesto</a>
                <a id="video" data-open="video-modal"><i class="fi-play"></i>Watch video</a>
            </span>

            <div class="reveal large" id="video-modal" data-reveal>
                <div class="flex-video widescreen"> <!-- TODO placeholder video -->
                    <iframe width="420" height="315" src="https://www.youtube.com/embed/WbJB9HKJ6fE" allowfullscreen style="border:0"></iframe>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="kpi">
    <div class="row">
        <div class="small-12 medium-10 large-8 small-centered columns">

            <div class="small-6 medium-3 columns">
                <img src="<?php echo $iconCoops ?>" class="float-center">
                <h6>Co-ops</h6>
                <h5><?php echo count($coOps) ?></h5>
            </div>
            <div class="small-6 medium-3 columns">
                <img src="<?php echo $iconStaff ?>" class="float-center">
                <h6>Staff</h6>
                <h5>158+</h5> <!-- TODO remove hard-coding -->
            </div>
            <div class="small-6 medium-3 columns">
                <img src="<?php echo $iconRevenue ?>" class="float-center">
                <h6>Revenue</h6>
                <h5>£2.8 mil</h5> <!-- TODO remove hard-coding -->
            </div>
            <div class="small-6 medium-3 columns">
                <img src="<?php echo $iconClients ?>" class="float-center">
                <h6>Clients</h6>
                <h5><?php echo count($clients) ?>+</h5>
            </div>

        </div>
    </div>
</div>


<section id="members" data-magellan-target="members">
    <div class="row">
        <div class="small-12 columns">

            <h2>Members</h2>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

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
                                <a href="<?php echo $coOp->permalink() ?>" class="coop-thumb">
                                    <img src="<?php echo $coOp->logoUrl() ?>" alt="">
                                    <!--<span><h4>--><?php //echo $coOp->name() ?><!--</h4></span>-->
                                </a>
                            </div>
                        <?php endforeach ?>

                        <div class="column">
                            <a href="join" class="coop-thumb">
                                <h5 id="join-us">Find out how to join the collective</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Grid View Content -->

                <!-- START Map View Content -->
                <div class="tabs-panel" id="map"> <!-- TODO OpenStreetMaps -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4776320.894259267!2d-8.549567638277907!3d54.229862435208936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x25a3b1142c791a9%3A0xc4f8a0433288257a!2sUnited+Kingdom!5e0!3m2!1sen!2sus!4v1480518359134"
                            width="600"
                            height="450"
                            frameborder="0"
                            style="border:0"
                            allowfullscreen>
                    </iframe>
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
            <p>Just some of the organisations we've worked with.</p>

            <div class="row small-up-2 medium-up-3 large-up-6">
                <?php foreach ($clients as $client): ?>
                    <div class="column">
                        <div class="client-thumb">
                            <img src="<?php echo $client->logoUrl() ?>" alt="">
                        </div>
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
            <p>Pellentesque habitant morbi tristique senectus et netus.</p>

            <div class="row small-up-3 medium-up-4 large-up-6 small-collapse">
                <?php foreach ($services as $service): ?>
                    <div class="column">
                        <a href="<?php echo $service->permalink() ?>" class="service-thumb">
                            <img src="<?php echo $service->iconUrl() ?>" class="float-center" alt="">
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
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

            <div class="row small-up-3 medium-up-4 large-up-8">
                <?php foreach ($technologies as $technology): ?>
                    <div class="column">
                        <a href="<?php echo $technology->permalink() ?>" class="technology-thumb">
                            <img src="<?php echo $technology->logoUrl() ?>" alt="">
                            <h5><?php echo $technology->name() ?></h5>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>


<section id="hire" data-magellan-target="hire">
    <div class="row">
        <div class="small-12 medium-6 small-centered columns">

            <h2>Hire Us</h2>
            <p>If you would like to work with us on a project, please get in touch. You can either find a co-op directly or use the form below and we'll find you the perfect match.</p>

            <form>
                <div class="row">
                    <div class="small-12 medium-6 columns">
                        <input type="text" placeholder="Name">
                    </div>
                    <div class="small-12 medium-6 columns">
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="small-12 columns">
                        <textarea placeholder="Tell us about your project"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 medium-4 small-centered columns">
                        <a class="large expanded button" href="#">Send</a> <!-- TODO -->
                    </div>
                </div>

            </form>

        </div>
    </div>
</section>

</div>
