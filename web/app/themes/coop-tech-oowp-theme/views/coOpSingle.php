<?php
    use Outlandish\MappingCoTech\Fields\Fields;

    /** @var ouCoOp $post */
    $post = $this->post;

    $formattedAddress = implode(',<br>', $post->addressAsArray());
?>

<div class="coop">

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
                        <ul class="menu social">
                            <?php foreach ($post->socialMedia() as $link): ?>
                                <li><a href="<?php echo $link[Fields::SOCIAL_MEDIA_LINK] ?>" target="_blank">
                                    <?php if ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::FACEBOOK): ?>
                                        <i class="fi-social-facebook"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::GITHUB): ?>
                                        <i class="fi-social-github"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::GOOGLE_PLUS): ?>
                                        <i class="fi-social-google-plus"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::INSTAGRAM): ?>
                                        <i class="fi-social-instagram"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::PINTEREST): ?>
                                        <i class="fi-social-pinterest"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::SNAPCHAT): ?>
                                        <i class="fi-social-snapchat"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::TWITTER): ?>
                                        <i class="fi-social-twitter"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::YOUTUBE): ?>
                                        <i class="fi-social-youtube"></i>
                                    <?php elseif ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::LINKED_IN): ?>
                                        <i class="fi-social-linkedin"></i>
                                    <?php endif ?>
                                </a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="column">
                        <strong>Email:</strong>
                        <p>
                            <?php foreach ($post->socialMedia() as $link): ?>
                                <?php if ($link[Fields::SOCIAL_MEDIA_TYPE] == Fields::EMAIL): ?>
                                    <a href="mailto:<?php echo $link[Fields::SOCIAL_MEDIA_LINK] ?>">
                                        <?php echo $link[Fields::SOCIAL_MEDIA_LINK] ?>
                                    </a>
                                    <?php break ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </p>
                    </div>
                    <div class="column">
                        <strong>Tel:</strong>
                        <p><?php echo $post->phone() ?></p>
                    </div>
                    <div class="column">
                        <strong>Address:</strong>
                        <p><?php echo $formattedAddress ?></p>
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
                                    <div class="service-thumb-img float-center" style="background-image: url(<?php echo $service->iconUrl() ?>)" ></div>
                                    <h5><?php echo $service->name() ?></h5>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
                <!-- /Services -->

                <!-- Technologies -->
                <?php if ($post->technologies()->posts): ?>
                <section>
                    <h4>Technologies</h4>

                    <div class="row small-up-3 medium-up-4 large-up-4 small-collapse">
                        <?php foreach ($post->technologies() as $technology): ?>
                            <div class="column">
                                <a href="<?php echo $technology->permalink() ?>" class="technology-thumb">
                                    <div class="technology-thumb-img float-center" style="background-image: url(<?php echo $technology->logoUrl() ?>)" ></div>
                                    <h5><?php echo $technology->title() ?></h5>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
                <!-- /Technologies -->
                <?php endif; ?>
                <?php if ($post->clients()->posts): ?>
                <!-- Clients -->
                <section>
                    <h4>Clients</h4>

                    <div class="row small-up-2 medium-up-3 large-up-3">
                        <?php foreach ($post->clients() as $client): ?>
                            <div class="column client-thumb-container">
                                <div class="client-thumb" style="background-image: url(<?php echo $client->logoUrl() ?>)" ></div>
                                <h5 class="client-thumb-header"><?php echo $client->title() ?></h5>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
                <!-- /Clients -->
                <?php endif; ?>

                <?php if (is_user_logged_in()): ?>
                    <?php if (!empty($post->people()->posts)): ?>
                        <!-- People -->
                        <section>
                            <h4>People</h4>
                            <?php $this->post->printPartial('peopleTable', ['people' => $post->people()->posts]); ?>
                        </section>
                        <!-- /People -->
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<section class="map">
    <?php if ($post->address()[Fields::LOCATION]): ?>
        <div id="map-single"></div>
        <script type="text/javascript">

            var latitude = '<?php echo $post->address()[Fields::LOCATION][Fields::LATITUDE]; ?>';
            var longitude = '<?php echo $post->address()[Fields::LOCATION][Fields::LONGITUDE]; ?>';
            var markerText = '<?php echo "<b>" . $post->name() . "</b><br><br>" . $formattedAddress ?>';

            $(document).ready(function() {
                window.app.createMapSingleMarker('map-single', latitude, longitude, 16, markerText);
            });

        </script>
    <?php endif ?>
</section>

</div>
