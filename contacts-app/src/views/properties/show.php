<?php include __DIR__.'/../_partials/header.php' ?>

<?php if (isset($errorResponse)) {
    include __DIR__ . '/../_partials/error_response.php';
}
$readOnly = '';
if ($property->readOnlyDefinition) {
    $readOnly = 'readonly';
}
?>

<form method="post">
    <fieldset>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" <?php if (array_key_exists('name', $_GET)) { ?>
               readonly <?php } ?>value="<?= htmlentities($property->name) ?>" />

        <label for="label">Label</label>
        <input type="text" name="label" id="label" value="<?= htmlentities($property->label) ?>"<?=$readOnly?> />
        <label for="description">Description</label>
        <textarea name="description" id="description"<?=$readOnly?>><?= htmlentities($property->description) ?></textarea>
        <label for="group-name">Group Name</label>
        <input type="text" name="groupName" id="group-name" value="<?= htmlentities($property->groupName) ?>"<?=$readOnly?> />

        <label for="type">Type</label>
        <input readonly type="text" name="type" id="type" value="<?= htmlentities($property->type) ?>"<?=$readOnly?> />
        <?php if (empty($readOnly)) { ?>
        <input id="save" class="button-primary" type="submit" value="Save">
        <?php } ?>
    </fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
