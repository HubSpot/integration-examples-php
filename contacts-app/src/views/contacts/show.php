<?php include __DIR__.'/../_partials/header.php' ?>

<form method="post" action="/contacts/show.php">
  <fieldset>
    <?php
      foreach ($contactFields as $field) { ?>
          <label for="<?= $field['name'] ?>"><?= $field['label'] ?></label>
          <input type="text" name="<?= $field['name'] ?>" id="<?= $field['name'] ?>" value="<?= $field['value'] ?>">
    <?php } ?>

    <input class="button-primary" type="submit" value="Save">
  </fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
