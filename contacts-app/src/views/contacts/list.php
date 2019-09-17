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

  <form action="/contacts/search.php">
      <fieldset>
          <input type="text" name="search" placeholder="Search.." id="search" value="<?= $search ?>">
      </fieldset>
  </form>

  <?php foreach ($contacts as $contact) { ?>
    <tr>
      <td><a href="/contacts/show.php?vid=<?= $contact['vid'] ?>"><?= $contact['vid'] ?></a></td>
      <td><?= $contact['properties']['firstname']['value'].' '.$contact['properties']['lastname']['value'] ?></td>
      <td><?= $contact['properties']['company']['value'] ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<div>
  <a href="/contacts/new.php">
    <input class="button-primary" type="button" value="New Contact">
  </a>
</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
