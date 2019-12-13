<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

<h1>Kolla vädret</h1>
<pre>
<?= $data["result"] ?>
</pre>

<div id="map"></div>

<script>
    var map = L.map('map', {
        center: [<?= $data["lat"] ?>, <?= $data["long"] ?>],
        zoom: 13
    });
    // Creating a Layer object
     var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

     // Adding layer to the map
     map.addLayer(layer);
</script>
<!-- <h2 class="end"><?#= $data["a"] ?>, <?#= $data["b"] ?></h2> -->
<h2 class="end">Latitud: <?= $data["lat"] ?></h2>
<h2 class="end">Longitud: <?= $data["long"] ?></h2>
