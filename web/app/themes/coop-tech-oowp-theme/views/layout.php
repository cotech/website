<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="canonical" href="<?php print $post->permalink(); ?>">
    <?php wp_head(); ?>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="alternate" type="application/rss+xml" title="Latest Trafficking Culture Updates" href="<?php bloginfo('url'); ?>/feed.rss" />
</head>


<body class="home">
<?php /** @var ouPost $post */?>

<header>
    <?php if ($post && $post->hasFrontPageMenu()): ?>
        <div data-sticky-container>

            <div class="top-bar" data-sticky data-options="marginTop:0;" style="width:100%">
                <div class="top-bar-title">
                    <strong><a id="logo" href="<?php echo $this->frontPage->permalink() ?>">CoTech</a></strong>
                    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
                        <button class="menu-icon dark" type="button" data-toggle></button>
                    </span>
                </div>
                <div id="responsive-menu">
                    <div class="top-bar-right">
                        <ul class="dropdown menu vertical medium-horizontal" data-magellan>
                            <li><a href="#who-we-are">Who we are</a></li>
                            <li><a href="#clients">Clients</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#hire" class="button">Hire Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    <?php else: ?>
        <div data-sticky-container>
            <div class="top-bar" data-sticky data-options="marginTop:0;" style="width:100%">
                <div class="top-bar-title">
                    <strong><a id="logo" href="<?php echo $this->frontPage->permalink() ?>">CoTech</a></strong>
                    <a class="back" href="<?php echo $this->frontPage->permalink() ?>">&#8592; Go Back</a>
                </div>
            </div>
        </div>
    <?php endif ?>
</header>

<?php echo $this->content; ?>


<footer>
    <div class="row">
        <div class="small-6 columns">
            <ul class="menu">
                <li>site by CoTech &#64;2016</li>
            </ul>
        </div>
        <div class="small-6 columns">
            <ul class="menu float-right">
                <li><a href="join.php">Join CoTech</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
