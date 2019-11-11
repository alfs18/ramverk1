<?php

namespace Anax\View;

/**
 * Render content within an article.
 */


?><h1>Kolla ip</h1>
<pre class="end">
{
    "ip": "<?= $data["ip"] ?>"
    "result": "<?= $data["result"] ?>"
    "domain": "<?= $data["domain"] ?>"
}
</pre>
<a href="json">Tillbaka</a>
