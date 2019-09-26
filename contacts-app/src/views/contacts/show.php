<?php include __DIR__.'/../_partials/header.php' ?>

<?php 
      if (isset($errorResponse)) {
           include __DIR__ . '/../_partials/error_response.php';
      } else if (!$_GET['notUpdated'] && !$notUpdated) {
           print ("<h3 style='text-align:center;'>Successfully updated Contact properties</h3>");
      }
?>

<div class="row">
    <div class="column">
        <?php include __DIR__.'/../properties/contacts_properties_list.php' ?>
    </div>
    <div class="column">
        <?php include __DIR__.'/../engagements/_list.php' ?>
    </div>

</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
