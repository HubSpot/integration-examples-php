<?php
/**
 * @var stdClass $type timeline event type
 * @var array $properties array consist of type's properties (stdClass)
 */
if (count($properties) > 0) {
?>
<table class="types-list">
    <thead>
        <tr>
            <th>ID</th>
            <th>Label</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($properties as $property) {?>
        <tr>
            <td><?=$property->id;?></td>
            <td><?=htmlentities($property->label)?></td>
            <td>
                <a class="button" href="/types/properties/update.php?type_id=<?=$type->id;?>&property_id=<?=$property->id;?>">Update</a>
                <a class="button" href="/types/properties/delete.php?type_id=<?=$type->id;?>&property_id=<?=$property->id;?>">Delete</a>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
<?php } else { ?>
    <h4>This type have no properties</h4>
<?php } ?>
<div>
    <a id='type-new' class="button" href="/types/properties/new.php?id=<?=$type->id;?>">New property</a>
</div>
<pre>
// src/actions/types/properties/delete.php
Delete Property for Timeline Event Type
$hubSpot->timeline()
    ->deleteEventTypeProperty(
        'HubSpot Application ID',
        'Event Type ID'
        'Property ID'
    );
</pre>
