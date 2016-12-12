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
    <link rel="stylesheet" href="<?php echo $publicDir . 'foundation-icons/foundation-icons.css' ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo $coTechLogo ?>">
    <!-- TODO what is this? vv -->
    <link rel="alternate" type="application/rss+xml" title="Latest Trafficking Culture Updates" href="<?php bloginfo('url'); ?>/feed.rss" />
</head>


<body>

<header>

    <div data-sticky-container>

        <div class="top-bar" data-sticky data-options="marginTop:0;" style="width:100%">
            <div class="top-bar-title">
                <strong>
                    <a id="logo" href="<?php echo $frontPageLink ?>">
                        <img src="<?php echo $coTechLogo ?>">CoTech<!-- TODO hover animation -->
                    </a>
                </strong>
<?php if ($post && $post->hasFrontPageMenu()): ?>
                <!--<span data-responsive-toggle="responsive-menu" data-hide-for="medium"><button class="menu-icon dark" type="button" data-toggle></button></span>-->
            </div>
            <div id="responsive-menu">
                <div class="top-bar-right">
                    <ul class="dropdown menu vertical medium-horizontal" data-magellan>
                        <li><a href="#members">Members</a></li>
                        <li><a href="#clients">Clients</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#technologies">Technologies</a></li>
                        <li><a href="#hire" class="button">Hire Us</a></li>
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


<div class="home">
    <footer>
        <div class="footer-upper">
            <div class="row">
                <div class="small-12 columns">

                    <div class="menu-centered">
                        <ul class="menu">
                            <li><a href="about">About <span>&#xbb;</span></a></li>
                            <!-- <li><a href="contact.php">Contact <span>&#xbb;</span></a></li> -->
                            <li><a href="join">Join <span>&#xbb;</span></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-lower">
            <div class="row">
                <div class="small-12 columns">
                    <img src="<?php echo $coopLogo ?>" class="float-center" />
                    <p>Site by Glowbox Designs & Outlandish for CoTech &#xa9;2016</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
