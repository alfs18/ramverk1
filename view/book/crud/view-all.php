<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");



?><h1>View all items</h1>

<p>
    <a href="<?= $urlToCreate ?>">Create</a> |
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table class="book">
    <tr class="first">
        <!-- <th>Id</th> -->
        <th>Titel</th>
        <th>Författare</th>
        <th>Bild</th>
    </tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <!-- <td>
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td> -->
        <td><a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->column1 ?></a></td>
        <td><a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->column2 ?></a></td>
        <td><img src="<?= $item->column3 ?>" height="100px"></img></td>
    </tr>
    <?php endforeach; ?>
</table>
