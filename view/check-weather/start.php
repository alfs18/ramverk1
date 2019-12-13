<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?><h1>Kolla vädret</h1>
<p>Skriv in en ip-adress, eller koordinater i formatet "latitud,longitud",
för att kolla vädret i det området.</p>

<!-- <p><#?= $data["apiResult"] ?></p> -->
<form method="post">
    <input type="text" name="check" placeholder=" latitud, longitud"><br><br>
    <label>
        <input type="radio" name="check1" value="toCome" checked> Kommande väder
    </label><br>
    <label>
        <input type="radio" name="check1" value="past"> Föregående 30 dagars väder
    </label><br><br>
    <input type="submit" name="doCheck" value="Check">
</form>
<br><br><br><br>
