<?php include __DIR__.'/../_partials/header.php'; ?>

<table class="contacts-list">
  <thead>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Company</th>
  </tr>
  </thead>
  <tbody>

  <form id="search-form" action="/contacts/search">
      <fieldset>
          <input type="text" name="search" placeholder="Search.." id="search" value="<?php if (isset($search)) {
              echo $search;
          }?>">
      </fieldset>
  </form>

  <?php foreach ($contacts as $contact) { ?>
    <tr>
      <td><a href="/contacts/show?vid=<?php echo $contact['vid']; ?>"><?php echo $contact['vid']; ?></a></td>
      <td><?php echo htmlentities($contact['properties']['firstname']['value'] ?? '').' '.htmlentities($contact['properties']['lastname']['value'] ?? ''); ?></td>
      <td><?php echo htmlentities($contact['properties']['company']['value'] ?? ''); ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<div>
  <a id='contact-new' href="/contacts/new">
    <input class="button-primary"  type="button" value="New Contact">
  </a>
    <a id='contactsExport' href="/contacts/export">
        <input class="button-primary" type="button" value="Export To CSV">
    </a>
</div>

<?php include __DIR__.'/../_partials/footer.php'; ?>
