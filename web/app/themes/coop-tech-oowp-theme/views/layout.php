<?php
    /** @var ouPost $post */

    $frontPageLink = $this->frontPage->permalink();
    $publicDir = $frontPageLink . 'app/themes/coop-tech-oowp-theme/public/';

    $imgDir = $publicDir . 'img/';
    $coopLogo = $imgDir . 'coop-logo.png';
    $coTechLogo = $imgDir . 'CoTech-logo.png';
    $iconClients = $imgDir . 'icon-clients.png';
    $iconCoops = $imgDir . 'icon-coops.png';
    $iconRevenue = $imgDir . 'icon-revenue.png';
    $iconStaff = $imgDir . 'icon-staff.png';
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>  <!-- TODO this could do with a tidy-up -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="canonical" href="<?php print $post->permalink(); ?>">
    <?php wp_head(); ?>
    <link rel="icon" type="image/x-icon" href="<?php echo $coTechLogo ?>">
    <script type="text/javascript">
        window.mapboxAccessToken = '<?php echo constant('MAPBOX_API_ACCESS_TOKEN') ?>';
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>


<body>

<header>

    <div data-sticky-container style="height: 82.7812px;">

        <div class="top-bar sticky iss-stuck is-at-top" data-sticky data-margin-top=0>
            <div class="top-bar-title">
                <strong>
                    <a id="logo" href="<?php echo $frontPageLink ?>">
                        <img src="<?php echo $coTechLogo ?>">CoTech
                    </a>
                </strong>
<?php if ($post && $post->hasFrontPageMenu()): ?>
                <span data-responsive-toggle="responsive-menu" data-hide-for="medium"><button class="menu-icon dark" type="button" data-toggle></button></span>
            </div>
            <div id="responsive-menu">
                <div class="top-bar-right">
                    <ul class="dropdown menu vertical medium-horizontal" data-magellan>
                        <li><a href="#members">Members</a></li>
                        <li><a href="#clients">Clients</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#technologies">Technologies</a></li>
                        <li><a href="#contact" class="button">Get In Touch</a></li>
                    </ul>
                </div>
<?php else: ?>
                <a class="back" href="<?php echo $this->frontPage->permalink() ?>">&#8592; Go Back</a>
<?php endif ?>
            </div>
        </div>

    </div>

</header>


<?php echo $this->content; ?>


<footer>
    <div class="footer-upper">
        <div class="row">
            <div class="small-12 columns">

                <div class="menu-centered">
                    <ul class="menu">
                        <li><a href="about">About <span>&#xbb;</span></a></li>
                        <li><a href="join">Join <span>&#xbb;</span></a></li>
                        <li><a href="manifesto">Manifesto <span>&#xbb;</span></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-lower">
        <div class="row">
            <div class="small-12 columns">
                <img src="<?php echo $coopLogo ?>" class="float-center" />
		<!-- TODO the CSS link colour needs fixing! -->

              <p>Site developed by <a href="http://glowboxdesign.co.uk" target="_blank">Glowbox Design</a> &amp; <a href="http://outlandish.com" target="_blank">Outlandish</a>.</p>
                <p>Source code available on <a href="https://github.com/cotech/website" target="_blank">GitHub</a>.</p>
                <p>Hosted by <a href="https://www.webarchitects.co.uk" target="_blank">Webarchitects</a> for CoTech &#xa9;<?php print date('Y'); ?></p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
