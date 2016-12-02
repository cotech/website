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
?>

<div id="banner">
    <div class="row">
        <div class="small-12 columns">
            <h1>We are nice. We do Tech</h1>
            <p>We are Co-Operative Technologists, a federation of tech co-operative businesses in the UK committed to the following principles:</p>
            <ul>
                <li>You should not exploit your workers</li>
                <li>We are passionate about tech for good</li>
                <li>Education and sharing skills are both important for development and growth</li>
                <li>It is important to create a fun and safe work environment regardless of gender, race or culture</li>
            </ul>
        </div>
    </div>

    <div id="kpi">
        <div class="row">
            <div class="small-3 columns">
                <div class="callout">
                    <i class="fi-home"></i>
                    <h5>Co-ops</h5>
                    <h6>28</h6> <!-- TODO remove hardcoded values -->
                </div>
            </div>
            <div class="small-3 columns">
                <div class="callout">
                    <i class="fi-torso"></i>
                    <h5>Staff</h5>
                    <h6>158</h6>
                </div>
            </div>
            <div class="small-3 columns">
                <div class="callout">
                    <i class="fi-pound"></i>
                    <h5>Revenue</h5>
                    <h6>£2.8mil p.a.</h6>
                </div>
            </div>
            <div class="small-3 columns">
                <div class="callout">
                    <i class="fi-torso-business"></i>
                    <h5>Clients</h5>
                    <h6>421</h6>
                </div>
            </div>
        </div>
    </div>

</div>

<section id="who-we-are" data-magellan-target="who-we-are">
    <div class="row">
        <div class="small-12 columns">

            <h2>Who we are</h2>

            <div class="view float-center">
                <ul class="tabs" data-tabs id="coops-view-tabs">
                    <li class="tabs-title is-active"><a href="#grid" aria-selected="true">Grid</a></li>
                    <li class="tabs-title"><a href="#map">Map</a></li>
                </ul>
            </div>

            <div class="tabs-content" data-tabs-content="coops-view-tabs">

                <!-- START Grid View Content -->
                <div class="tabs-panel is-active" id="grid">

                    <div class="row small-up-3 medium-up-4 large-up-6">
                        <?php foreach ($coOps as $coOp): ?>
                            <div class="column">
                                <a href="<?php echo $coOp->permalink() ?>" class="coop-thumb">
                                    <img src="<?php echo $coOp->logoUrl() ?>" class="thumbnail" alt="">
                                    <span><h4><?php echo $coOp->name() ?></h4></span>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>

                </div>
                <!-- END Grid View Content -->

                <!-- START Map View Content -->
                <div class="tabs-panel" id="map">
                    <div class="flex-video">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4776320.894259267!2d-8.549567638277907!3d54.229862435208936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x25a3b1142c791a9%3A0xc4f8a0433288257a!2sUnited+Kingdom!5e0!3m2!1sen!2sus!4v1480518359134"
                                width="600"
                                height="450"
                                frameborder="0"
                                style="border:0"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <!-- END Map View Content -->

            </div>

        </div>
    </div>
</section>

<!-- TODO no slideshow -->
<section id="clients" data-magellan-target="clients">
    <div class="row">
        <div class="small-12 columns">

            <h2>Clients</h2>

            <!-- START Orbit Carousel-->
            <div class="orbit" role="region" aria-label="Clients we've worked with" data-orbit>
                <ul class="orbit-container">
                    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                    <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>

                    <!-- START Slide 1 -->
                    <li class="is-active orbit-slide">
                        <div class="row small-up-3 medium-up-4 large-up-6">
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                        </div>
                    </li>
                    <!-- END Slide 1 -->

                    <!-- START Slide 2 -->
                    <li class="orbit-slide">
                        <div class="row small-up-3 medium-up-4 large-up-6">
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                        </div>
                    </li>
                    <!-- END Slide 2 -->

                    <!-- START Slide 3 -->
                    <li class="orbit-slide">
                        <div class="row small-up-3 medium-up-4 large-up-6">
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                            <div class="column">
                                <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                            </div>
                        </div>
                    </li>
                    <!-- END Slide 3 -->


                </ul>

                <nav class="orbit-bullets">
                    <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
                    <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
                    <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
                    <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
                </nav>

            </div>
            <!-- END Orbit Carousel-->

        </div>
    </div>
</section>

<section id="services" data-magellan-target="services">
    <div class="row">
        <div class="small-12 columns">
            <h2>What we do</h2>
            <div class="row small-up-3 medium-up-4 large-up-6">
                <?php foreach ($services as $service): ?>
                    <div class="column">
                        <a href="<?php echo $service->permalink() ?>">
                            <img src="<?php echo $service->icon ? $service->icon : 'http://placehold.it/300x300' ?>" class="thumbnail" alt="">
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<section id="technologies">
    <div class="row">
        <div class="small-12 columns">
            <h2>Skills we have</h2>
            <div class="row small-up-3 medium-up-4 large-up-8">
                <?php foreach ($technologies as $technology): ?>
                    <div class="column">
                        <a href="<?php $technology->permalink() ?>">
                            <img src="http://placehold.it/300x150" class="thumbnail" alt="">
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<section id="hire" data-magellan-target="hire"> <!-- TODO -->
    <div class="row">
        <div class="small-12 medium-4 small-centered columns">

            <h2>Hire Us</h2>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget.</p>
            <form>
                <div class="row">
                    <div class="small-12 columns">
                        <label>Name
                            <input type="text" placeholder="e.g. Jane Smith">
                        </label>
                    </div>
                    <div class="small-12 columns">
                        <label>Email
                            <input type="email" placeholder="e.g. jane@email.com">
                        </label>
                    </div>
                    <div class="small-12 columns">
                        <label>
                            Tell us about your project
                            <textarea placeholder="Tell us a bit about who you are and how we could help you. Do you need a website, app, branding, etc."></textarea>
                        </label>
                    </div>
                </div>
                <a class="large expanded button" href="#">Send</a> <!-- TODO -->
            </form>

        </div>
    </div>
</section>
