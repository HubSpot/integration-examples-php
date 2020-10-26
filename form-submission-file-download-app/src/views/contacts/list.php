<?php
/**
 * @var string $search
 */
include __DIR__.'/../_partials/header.php'; ?>

<table class="contacts-list">
  <thead>
  <tr><h2>Refresh this page to see the latest results of webhook events</h2></tr>
  <tr>
    <th>ID</th>
    <th>Email</th>
    <th>Protected file (<?php echo $protected; ?>)</th>
    <th>Public file (<?php echo $public; ?>)</th>
  </tr>
  </thead>
  <tbody>

  <form id="search-form" action="/contacts/list">
      <fieldset>
          <input type="text" name="search" placeholder="Search.." id="search" value="<?php echo $search; ?>">
      </fieldset>
  </form>

  <?php foreach ($contacts as $contact) { ?>
    <tr>
        <td><?php echo $contact->vid; ?></td>
        <td><?php echo $contact->properties->email->value; ?></td>
        <td><?php if (isset($contact->properties->{$protected}->value) && !empty($contact->properties->{$protected}->value)) {?>
            <a href="<?php echo $contact->properties->{$protected}->value; ?>" target="blank">File</a>
        <?php } else {?>-<?php } ?></td>
      <td>
        <?php if (isset($contact->properties->{$public}->value) && !empty($contact->properties->{$public}->value)) {?>
            <a href="<?php echo $contact->properties->{$public}->value; ?>" target="blank">File</a>
        <?php } else {?>-<?php } ?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<?php include __DIR__.'/../_partials/footer.php'; ?>
