<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?><h1>Kolla ip</h1>
<p>Skriv in en ip-adress för att kolla om den är gilig.</p>

<form method="post">
    <input type="text" name="check" value="<?= $data["userIp"] ?>">
    <input type="submit" name="doCheck" value="Check">
</form>
<br><br><br><br>
