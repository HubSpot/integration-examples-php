<?php
/**
 * @var string
 * @var string $portalId
 */
include __DIR__.'/../_partials/header.php'; ?>
<div class="row">
    <div class="column">
<pre>
// src/views/forms/form.php
HubSpot uses a simple JavaScript script to embed forms on your website.
src="//js.hsforms.net/forms/shell.js
This code will create a form with portalId and formId generated in /src/actions/forms/init.php:
hbspt.forms.create({
    portalId: "<?php echo $portalId; ?>",
    formId: "<?php echo $formId; ?>"
});
</pre>
    </div>
</div>
<div class="row">
    <div class="column column-25"></div>
    <div class="column column-80">
        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
        <script>
          hbspt.forms.create({
                portalId: "<?php echo $portalId; ?>",
                formId: "<?php echo $formId; ?>"
        });
        </script>
    </div>
    <div class="column column-25"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php'; ?>
