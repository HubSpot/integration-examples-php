<?php include __DIR__.'/../_partials/header.php' ?>

<form method="post" action="/contacts/show.php">
  <fieldset>
    <?php
      foreach ($contactFields as $field) { ?>
          <label for="<?= $field['name'] ?>"><?= $field['label'] ?></label>
          <?php if ($field['name'] === 'hubspot_owner_id') { ?>
              <select name="<?= $field['name'] ?>" id="<?= $field['name'] ?>">
                  <option value="">Not assigned</option>
                  <?php foreach ($owners as $owner) { ?>
                    <option
                        value="<?= $owner->ownerId ?>"
                        <?php if ($field['value'] == $owner->ownerId) { ?>selected<?php } ?>
                    ><?= $owner->firstName.' '.$owner->lastName ?></option>
                  <?php } ?>
              </select>
          <?php } else { ?>
              <input type="text" name="<?= $field['name'] ?>" id="<?= $field['name'] ?>" value="<?= $field['value'] ?>">
          <?php } ?>
    <?php } ?>

    <input class="button-primary" type="submit" value="Save">
  </fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
