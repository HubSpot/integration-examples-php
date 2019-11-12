<?php
/**
 * @var array $types array consist of types (stdClass)
 */
include __DIR__.'/../_partials/header.php';
?>

<table class="types-list">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Object</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($types as $type) { ?>
        <tr>
            <td><a href="/types/show.php?id=<?=$type->id;?>"><?=$type->id;?></a></td>
            <td><?= htmlentities($type->name)?></td>
            <td><?= htmlentities($type->objectType) ?></td>
            <td>
                <a class="button" href="/types/delete.php?id=<?=$type->id;?>">Delete</a>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>

<div>
    <a id='type-new' class="button" href="/types/new.php">New Types</a>
</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
