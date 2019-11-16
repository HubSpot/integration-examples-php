<?php 
/**
 * @var string $formId
 * @var string $portalId
 */
include __DIR__.'/../_partials/header.php' ?>
<div class="row">
    <div class="column column-25"></div>
    <div class="column column-50">
        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
        <script>
          hbspt.forms.create({
                portalId: "<?=$portalId;?>",
                formId: "<?=$formId;?>"
        });
        </script>
    </div>
    <div class="column column-25"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php' ?>
