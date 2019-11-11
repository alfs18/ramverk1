<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?><h1>Kolla ip</h1>
<h2 class="<?= $data["class"] ?>">Du skrev: <?= $data["ip"] ?></h2>
<h2 class="<?= $data["class"] ?>"><?= $data["result"] ?></h2>
<h2 class="<?= $data["class"] ?>">Domän: <?= $data["domain"] ?></h2>
