<?php
/**
 * @var array $property timeline event type's property
 */
include __DIR__.'/../_partials/header.php';
$propertyTypes = [
    'Date',
    'Numeric',
    'String'
];
?>

<form method="post">
    <fieldset>
        <label for="name">Name</label>
        <input type="text" placeholder="Name" id="name" readonly name="name" value="<?=$property['name'];?>">
        <label for="label">Label</label>
        <input type="text" placeholder="Label" id="label" name="label" value="<?=$property['label'];?>">
        <label for="propertyType">Property Type</label>
        <select id="propertyType" name="propertyType">
            <option disabled<?php if (empty($property['propertyType'])) { ?>selected<?php } ?>>Select Property Type</option>
            <?php foreach ($propertyTypes as $value) { ?>
                <option <?php if ($property['propertyType'] == $value) {?>selected <?php } ?>value="<?=$value;?>"><?=$value;?></option>
            <?php } ?>
        </select>
        <input id="save" class="button-primary" type="submit" value="Save">
    </fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
