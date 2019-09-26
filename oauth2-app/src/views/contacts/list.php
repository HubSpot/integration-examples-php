<?php include __DIR__.'/../_partials/header.php' ?>

<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Company</th>
  </tr>
  </thead>
  <tbody>

  <?php foreach ($contacts as $contact) { ?>
    <tr>
      <td><?= htmlentities($contact['vid']) ?></a></td>
      <td><?= htmlentities($contact['properties']['firstname']['value']).' '.htmlentities($contact['properties']['lastname']['value']) ?></td>
      <td><?= htmlentities($contact['properties']['company']['value']) ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<?php include __DIR__.'/../_partials/footer.php' ?>
