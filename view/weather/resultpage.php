<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />

<article class="article">
    <h1>Resultat Väderprognos</h1>
    <?php
    if (is_string($data["forecast"])) {
        ?><p><?= $data["forecast"] ?></p>
    <?php } elseif ($data["forecast"] !== null) {
        foreach ($data["forecast"] as $day) { ?>
             <p><b><?= $day["date"]; ?></b> - <?= $day["description"]; ?>, temperatur mellan <?= $day["temp"]; ?> °C.</p>
        <?php }
    } else {
        ?><p><br><br><b>Tyvärr, fel input, prova igen</b></p> <?php
    } ?>


    <div id='map' style='width: 400px; height: 300px;'></div>
    <script>

    <?php
    $config = $di->get("configuration")->load("apikey.php");
    $access_key = $config["config"]["keyHolder"]["mapboxKey"];
    ?>

    mapboxgl.accessToken = '<?= $access_key ?>';

    var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [<?= $data['lon'] . ", " . $data['lat'] ?>],
    zoom: 14
    });

    var marker = new mapboxgl.Marker()
    .setLngLat([<?= $lon . ", " . $lat ?>])
    .addTo(map);
    </script>
</article>
