<?php include __DIR__.'/../_partials/header.php' ?>

<table>
  <thead>
  <tr>
        <th>Name</th>
        <th>Label</th>
        <th>Description</th>
        <th>Type</th>
        <th>Actions</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($properties as $property) { ?>
    <tr>
      <td><a href="/properties/show.php?name=<?= htmlentities($property->name) ?>"><?= htmlentities($property->name) ?></a></td>
      <td><?= htmlentities($property->label) ?></td>
      <td><?= htmlentities($property->description) ?></td>
      <td><?= htmlentities($property->type) ?></td>
        <td><?php if (!$property->mutableDefinitionNotDeletable && !$property->readOnlyDefinition) { ?>
                <a href="/properties/delete.php?name=<?=$property->name?>">
                    <input type="button" value="Delete" title="Delete" class="button-primary"/>
                </a> <?php } ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<div>
  <a href="/properties/new.php">
    <input class="button-primary" type="button" value="New Property">
  </a>
</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
