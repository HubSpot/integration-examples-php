<?php include __DIR__.'/../_partials/header.php' ?>

<form method="post">
    <fieldset>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= $property->name ?>" />
        <label for="label">Label</label>
        <input type="text" name="label" id="label" value="<?= $property->label ?>" />
        <label for="description">Description</label>
        <textarea name="description" id="description"><?= $property->description ?></textarea>
        <label for="groupName">Group Name</label>
        <input type="text" name="groupName" id="groupName" value="<?= $property->groupName ?>" />

        <label for="type">Type</label>
        <input readonly type="text" name="type" id="type" value="<?= $property->type ?>" />

        <input class="button-primary" type="submit" value="Save">
    </fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
