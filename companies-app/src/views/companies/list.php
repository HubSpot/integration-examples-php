<?php include __DIR__.'/../_partials/header.php' ?>

<?php if (!empty($searchDomain)) { ?>
<pre>
// src/actions/companies/search.php
$hubSpot->companies()->searchByDomain($searchDomain, [
    'name', 'domain',
])
</pre>
<?php } ?>

<form action="/companies/search.php">
    <fieldset>
        <input type="text" name="search" placeholder="Search by domain.." id="search" value="<?= $search ?>">
    </fieldset>
</form>


<?php if (empty($searchDomain)) { ?>
<pre>
// src/actions/companies/list.php
$hubSpot->companies()->all([
    'properties' => ['name', 'domain'],
]);
</pre>
<?php } ?>

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
