<?php
    use Outlandish\MappingCoTech\Fields\Fields;

    /** @var ouTechnology $post */
    $post = $this->post;
?>

<div class="technology">

<div id="page-banner">
    <div class="row">
        <div class="small-12 small-centered columns">
            <img src="<?php echo $post->logoUrl() ?>" class="thumbnail" alt="">
            <h2>Coops that use <span><?php echo $post->title() ?></span></h2>
        </div>
    </div>
</div>


<div class="row">
    <div class="small-12 columns">

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
                    <?php foreach ($post->coOps() as $coOp): ?>
                        <div class="column">
                            <a href="<?php echo $coOp->permalink() ?>" class="coop-thumb">
                                <img src="<?php echo $coOp->logoUrl() ?>" alt="">
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
            <!-- END Grid View Content -->

            <!-- START Map View Content -->
            <div class="tabs-panel" id="map">
                <div class="row small-up-2 medium-up-4 large-up-6 small-collapse">
                    <div id="map-technologies"></div>
                    <?php
                    $mapEntries = [];
                    foreach ($post->coOps() as $coOp) {
                        if ($coOp->address()[Fields::LOCATION]) {
                            array_push($mapEntries, array(
                                'lat' => $coOp->address()[Fields::LOCATION][Fields::LATITUDE],
                                'lng' => $coOp->address()[Fields::LOCATION][Fields::LONGITUDE],
                                'markerText' => '<b><a href=\"' . $coOp->permalink() . '\">' . $coOp->name()
                                    . '</a></b><br><br>' . implode(',<br>', $coOp->addressAsArray())
                            ));
                        }
                    }
                    $encodedMapEntries = json_encode($mapEntries);
                    ?>
                    <script type="text/javascript">

                        var mapEntries = '<?php echo $encodedMapEntries; ?>';
                        var parsedMapEntries = JSON.parse(mapEntries);

                        $(document).ready(function() {
                            window.app.createMapMultiMarker('map-technologies', 54.7, -4.2, 6, parsedMapEntries);
                        });

                        // TODO fix bug with tiles not displaying properly until window resized

                    </script>
                </div>
            </div>
            <!-- END Map View Content -->

        </div>

    </div>
</div>

</div>
