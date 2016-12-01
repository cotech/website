<?php
    /** @var ouCoOp $post */
    $post = $this->post;
?>

<header>
    <div data-sticky-container>
        <div class="top-bar" data-sticky data-options="marginTop:0;" style="width:100%">
            <div class="top-bar-title">
                <strong><a id="logo" href="#">CoTech</a></strong>
                <a class="back" href="#">&#8592; Go Back</a>
            </div>
        </div>
    </div>
</header>

<div id="page-banner">
    <div class="row">
        <div class="small-8 medium-6 large-3 small-centered columns">
            <img src="<?php echo $post->featuredImageUrl() ?>" class="thumbnail" alt="">
            <h2><?php echo $post->name() ?></h2>
            <a href="<?php echo $post->websiteUrl() ?>" target="_blank"><?php echo $post->websiteUrl() ?></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="small-4 columns"> <!-- TODO Replace with manifesto et al -->
        <p><?php echo $post->about() ?></p>
    </div>

    <div class="small-4 columns">
        <ul class="no-bullet">
            <li><a class="button">Hire Us</a></li>
            <li>Tel:</li> <!-- TODO add values in 2nd column? Speak to Jason -->
            <li>Email:</li>
            <li><br></li>
            <li>Address:</li>
            <li>Fb</li> <!-- TODO replace with icons -->
            <li>Tw</li>
        </ul>
    </div>
</div>

<section id="services">
    <div class="row">
        <div class="small-12 columns">
            <h2>Services</h2>
            <div class="row small-up-3 medium-up-4 large-up-6">

                <?php foreach ($post->services() as $service): ?>
                    <div class="column">
                        <a href="<?php echo $service->permalink() ?>"> <!-- TODO html chars bug -->
                            <!-- TODO Add logos to WP, fallback on service name -->
                            <img src="http://placehold.it/300x300" class="thumbnail" alt="">
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
            <h2>Technologies We Use</h2>
            <div class="row small-up-3 medium-up-4 large-up-8">

                <?php foreach ($post->technologies() as $technology): ?>
                    <div class="column">
                        <?php echo $technology->title() ?>
                        <a href="technology.php"> <!-- TODO sort out href -->
                            <!-- TODO Add logos to WP, fallback on technology name -->
                            <img src="http://placehold.it/300x150" class="thumbnail" alt="">
                        </a>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>
</section>

<section id="clients"> <!-- TODO -->
    <div class="row">
        <div class="small-12 columns">
            <h2>Clients we've worked with</h2>
            <div class="row small-up-3 medium-up-4 large-up-6">

                <?php foreach ($post->clients() as $client): ?>
                    <div class="column"> <!-- TODO Add logos to WP, fallback on client name -->
                        <?php echo $client->title() ?>
                        <img src="http://placehold.it/300x200" class="thumbnail" alt="">
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>
</section>
