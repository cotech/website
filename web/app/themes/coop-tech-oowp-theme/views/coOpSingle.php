<?php
    use Outlandish\MappingCoTech\Fields\Fields;

    /** @var ouCoOp $post */
    $post = $this->post;
?>

<div id="page-banner">
    <div class="row">
        <div class="small-12 small-centered columns">
            <a href="<?php echo $post->websiteUrl() ?>" target="_blank">
                <img src="<?php echo $post->logoUrl() ?>" alt="">
            </a>
            <h2><?php echo $post->name() ?></h2>
            <a href="<?php echo $post->websiteUrl() ?>" target="_blank">
                <?php echo $post->websiteUrl() ?>
            </a>
        </div>
    </div>
</div>

<div class="row">

    <div class="small-12 small-centered medium-10 large-8 columns">
        <div class="row">

            <!-- Contact -->
            <div class="small-12 large-4 columns">

                <section class="row small-up-1 medium-up-4 large-up-1">
                    <div class="column">
                        <ul class="menu social"> <!-- TODO add social media links -->
                            <?php echo $post->socialMedia() ?>
                            <li><a href="#" target="_blank"><i class="fi-social-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fi-social-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fi-social-google-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="column"> <!-- TODO -->
                        <strong>Email:</strong>
                        <p><a href="mailto:info@workercoop.com">info@workercoop.com</a></p>
                    </div>
                    <div class="column"> <!-- TODO -->
                        <strong>Tel:</strong>
                        <p>0208 888 8888</p>
                    </div>
                    <div class="column"> <!-- TODO -->
                        <strong>Address:</strong>
                        <p>92 the street <br>London <br>N14 1AB</p>
                    </div>
                </section>
            </div>
            <!-- /Contact -->

            <div class="small-12 large-8 columns">

                <!-- About -->
                <section>
                    <p><?php echo $post->about() ?></p>
                </section>
                <!-- /About -->

                <!-- Services -->
                <section>
                    <h4>Services</h4>
                    <div class="row small-up-3 medium-up-4 large-up-4 small-collapse">
                        <?php foreach ($post->services() as $service): ?>
                            <div class="column">
                                <a href="<?php echo $service->permalink() ?>" class="service-thumb">
                                    <img src="<?php echo $service->iconUrl() ?>" alt="" class="float-center">
                                    <h5><?php echo $service->name() ?></h5>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
                <!-- /Services -->

                <!-- Technologies -->
                <section>
                    <h4>Technologies</h4>

                    <div class="row small-up-3 medium-up-4 large-up-6">
                        <?php foreach ($post->technologies() as $technology): ?>
                            <div class="column">
                                <a href="<?php echo $technology->permalink() ?>" class="technology-thumb">
                                    <img src="<?php echo $technology->logoUrl() ?>" alt="">
                                    <?php echo $technology->title() ?>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
                <!-- /Technologies -->

                <!-- Clients -->
                <section id="clients">
                    <h4>Clients</h4>

                    <div class="row small-up-2 medium-up-3 large-up-3">
                        <?php foreach ($post->clients() as $client): ?>
                            <div class="column">
                                <?php echo $client->title() ?>
                                <img src="<?php echo $client->logoUrl() ?>" alt="">
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
                <!-- /Clients -->

            </div>

        </div>
    </div>

</div>

<section id="map"> <!-- TODO OSM -->
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4960.510954307493!2d-0.11217526651326998!3d51.56354991441681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b9aff08fe37%3A0xcbf79572ab07c98b!2sOutlandish!5e0!3m2!1sen!2sus!4v1480950828548"
                width="400"
                height="200"
                frameborder="0"
                style="border:0"
                allowfullscreen>
        </iframe>
    </div>
</section>
