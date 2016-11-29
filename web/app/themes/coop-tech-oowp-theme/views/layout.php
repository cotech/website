<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="canonical" href="<?php print $post->permalink(); ?>">
    <?php wp_head(); ?>
    <script type='text/javascript'>    var $ = jQuery;    </script>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="alternate" type="application/rss+xml" title="Latest Trafficking Culture Updates" href="<?php bloginfo('url'); ?>/feed.rss" />
</head>


<body>
<?php /** @var tcPost $post */?>

<div id="wrapper">
    <div id="content" class="row content-<?php print $post->postType(); ?>">

        <div class="small-12 columns">

            <?php echo $this->content; ?>

        </div>
        <!--#content div.wrapper end-->

    </div>
    <!--#content end-->
</div>

<?php wp_footer(); ?>
</body>
</html>