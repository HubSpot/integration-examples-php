<?php include __DIR__.'/../_partials/header.php'; ?>

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
        <input type="text" name="search" placeholder="Search by domain.." id="search" value="<?php echo $search; ?>">
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
      <td><a href="/companies/show.php?id=<?php echo htmlentities($company->companyId); ?>"><?php echo htmlentities($company->companyId); ?></a></td>
      <td><?php echo htmlentities($company->properties->name->value); ?></td>
      <td><?php echo htmlentities($company->properties->domain->value); ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<div>
    <a href="/companies/new.php">
        <input class="button-primary" type="button" value="New Company">
    </a>
</div>


<?php include __DIR__.'/../_partials/footer.php'; ?>
