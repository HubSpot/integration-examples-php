<?php
/**
 * @var stdClass $type timeline event type
 * @var array $properties array consist of type's properties (stdClass)
 */
include __DIR__.'/../_partials/header.php';
?>

<div class="row">
    <div class="column">
        <table>
            <tbody>
                <?php foreach ((array) $type as $key=>$value) {?>
                <tr>
                    <td><?=$key?></td>
                    <td><?=$value?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
            <a id='type-update' class="button" href="/types/update.php?id=<?=$type->id;?>">Update</a>
            <a id='type-delete' class="button" href="/types/delete.php?id=<?=$type->id;?>">Delete</a>
        </div>
    </div>
    <div class="column">
        <?php include __DIR__.'/../properties/_list.php' ?>
    </div>

</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
