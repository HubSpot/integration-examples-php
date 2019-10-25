<?php include __DIR__.'/../_partials/header.php' ?>

<table class="contacts-list">
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Company</th>
  </tr>
  </thead>
  <tbody>

  <form id="search-form" action="/contacts/search.php">
      <fieldset>
          <input type="text" name="search" placeholder="Search.." id="search" value="<?= $search ?>">
      </fieldset>
  </form>

  <?php foreach ($contacts as $contact) { ?>
    <tr>
      <td><a href="/contacts/show.php?notUpdated=true&vid=<?= $contact['vid'] ?>"><?= $contact['vid'] ?></a></td>
      <td><?= htmlentities($contact['properties']['firstname']['value']).' '.htmlentities($contact['properties']['lastname']['value']) ?></td>
      <td><?= htmlentities($contact['properties']['company']['value']) ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<div>
  <a id='contact-new' href="/contacts/new.php">
    <input class="button-primary"  type="button" value="New Contact">
  </a>
    <a id='contactsExport' href="/contacts/export.php">
        <input class="button-primary" type="button" value="Export To CSV">
    </a>
</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
