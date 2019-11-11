<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?><h1>Kolla ip</h1>
<p>Skriv in en ip-adress för att få information om den.</p>

<form method="post">
    <input type="text" name="check">
    <input type="submit" name="doCheck" value="Get info">
</form>

<p>Exempel:</p>
<p><a href="exampleOne">172.217.11.23</a></p>
<a href="exampleTwo">192.168.0.1</a>
<br><br><br><br>
