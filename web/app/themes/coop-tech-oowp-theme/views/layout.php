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
<?php /** @var tcPost $post */?>


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
