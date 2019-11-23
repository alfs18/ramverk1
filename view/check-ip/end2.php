<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

?><title><?= $data["title"] ?></title>
<h1>Kolla ip</h1>
<h2>Du skrev: <?= $data["res"]["ip"] ?></h2>
<h2>Ip-adressens typ: <?= $data["res"]["type"] ?></h2>
<h2>Latitud: <?= $data["res"]["latitude"] ?></h2>
<h2>Longitude: <?= $data["res"]["longitude"] ?></h2>
<h2>Kontinent: <?= $data["res"]["continent_name"] ?></h2>
<h2>Land: <?= $data["res"]["country_name"] ?></h2>
<h2>Närmaste ort: <?= $data["res"]["city"] ?></h2>
