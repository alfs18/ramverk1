<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?><h1>Kolla vädret</h1>
<p>Skriv in en ip-adress, eller koordinater i formatet "latitud,longitud",
för att kolla vädret i det området.</p>
<p>Välj därefter om du vill se kommande eller föregående väder,
default är kommand väder.</p>
<p>Till sist kan du välja vilken information du vill se, default är att
se all information. Föregående 30 dagar visar endast sammanfattningen.</p>

<form method="post">
    <input type="text" name="check" value="<?= $data["userIp"] ?>"><br><br>
    <label>
        <input type="radio" name="check1" value="toCome" checked> Kommande väder
    </label><br>
    <label>
        <input type="radio" name="check1" value="past"> Föregående 30 dagars väder
    </label><br><br>

    <label>
        <input type="radio" name="check2" value="all" checked> Allt
    </label><br>
    <label>
        <input type="radio" name="check2" value="currently"> Nuvarande
    </label><br>
    <label>
        <input type="radio" name="check2" value="hourly"> Timvis
    </label><br>
    <label>
        <input type="radio" name="check2" value="daily"> Dagligt
    </label><br><br>
    <input type="submit" name="doCheck" value="Check">
</form>
<br><br><br><br>
