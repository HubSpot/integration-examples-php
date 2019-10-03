<?php include __DIR__.'/../_partials/header.php' ?>

<?php 
      if (isset($errorResponse)) {
           include __DIR__ . '/../_partials/error_response.php';
      } else if ($_GET['updated']) { ?>
           <h3 style='text-align:center;'>Successfully updated Company properties</h3>
      <?php } else if ($_GET['created']) { ?>
          <h3 style='text-align:center;'>Successfully created Company</h3>
      <?php }
?>

<div class="row">
    <div class="column">

        <?php if (isset($company)) { ?>
<pre>
// src/actions/companies/show.php
$hubSpot->companies()->getById($companyId)->getData();
</pre>
        <?php } ?>

        <form method="post" action="/companies/show.php">
            <fieldset>
                <?php if (isset($id)) { ?>
                    <input type="hidden" name="id" value="<?= htmlentities($id) ?>" />
                <?php } ?>
                <?php
                foreach ($formFields as $field) { ?>
                    <?php
                    $nameSanitized = htmlentities($field['name']);
                    $labelSanitized = htmlentities($field['label']);
                    $valueSanitized = htmlentities($field['value']);
                    ?>
                    <label for="<?= $nameSanitized ?>"><?= $labelSanitized ?></label>
                    <input type="text" name="<?= $nameSanitized ?>" id="<?= $nameSanitized ?>" value="<?= $valueSanitized ?>">
                <?php } ?>

                <?php if (isset($company)) { ?>
<pre>
// src/actions/companies/show.php
$hubSpot->companies()->update($companyId, $companyProperties);
</pre>
                <? } else { ?>
<pre>
// src/actions/companies/show.php
$hubSpot->companies()->create($companyProperties);
</pre>

                <?php } ?>
                <input class="button-primary" type="submit" value="Save">
            </fieldset>
        </form>

    </div>
</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
