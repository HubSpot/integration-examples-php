<?php include __DIR__.'/../_partials/header.php' ?>

<!--<pre><code>The search flow is handled in the SearchController::search, located at src/app/Controller/SearchController.php</code></pre>
<form>
  <fieldset>
    <label for="search">Search</label>
    <input type="text" placeholder="Search..." name="search" id="search">
    <input class="button-primary" type="submit" value="Search">
  </fieldset>
</form>
-->

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
