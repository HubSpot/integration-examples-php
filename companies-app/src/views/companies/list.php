<?php include __DIR__.'/../_partials/header.php' ?>

<pre>
// src/actions/companies/list.php
$hubSpot->companies()->all([
    'properties' => ['name', 'domain'],
]);
</pre>

<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Domain</th>
  </tr>
  </thead>
  <tbody>

  <?php foreach ($companies as $company) { ?>
    <tr>
      <td><?= htmlentities($company->companyId) ?></a></td>
      <td><?= htmlentities($company->properties->name->value) ?></td>
      <td><?= htmlentities($company->properties->domain->value) ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<?php include __DIR__.'/../_partials/footer.php' ?>
