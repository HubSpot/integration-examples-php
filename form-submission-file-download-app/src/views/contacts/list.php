<?php 
/**
 * @var string $public Public file
 * @var string $protected Protected file
 */

include __DIR__.'/../_partials/header.php' ?>

<table class="contacts-list">
  <thead>
  <tr>
    <th>ID</th>
    <th>Email</th>
    <th>Protected file (<?=$protected;?>)</th>
    <th>Public file (<?=$public?>)</th>
  </tr>
  </thead>
  <tbody>

  <form id="search-form" action="/contacts/list.php">
      <fieldset>
          <input type="text" name="search" placeholder="Search.." id="search" value="<?= $search ?>">
      </fieldset>
  </form>

  <?php foreach ($contacts as $contact) { ?>
    <tr>
        <td><?= $contact->vid;?></td>
        <td><?= $contact->properties->email->value;?></td>
        <td><?php if (isset($contact->properties->$protected->value) && !empty($contact->properties->$protected->value)) {?>
            <a href="<?=$contact->properties->$protected->value?>" target="blank">File</a>
        <?php } else {?>-<?php } ?></td>
      <td>
        <?php if (isset($contact->properties->$public->value) && !empty($contact->properties->$public->value)) {?>
            <a href="<?=$contact->properties->$public->value?>" target="blank">File</a>
        <?php } else {?>-<?php } ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<?php include __DIR__.'/../_partials/footer.php' ?>
