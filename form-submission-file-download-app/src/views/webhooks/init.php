<?php
/**
 * @var string
 */
include __DIR__.'/../_partials/header.php'; ?>
<div class="row">
    <div class="column column-20"></div>
    <div class="column column-60">
<pre>
// src/actions/forms/init.php - form and properties initialization script
$propertyResponse = $hubSpot->contactProperties()->create(...)
....
$formResponse = $hubSpot->forms()->create(...)
</pre>
        <form method="post">
            <h3>Initialization Webhooks Script - press Go button to initialize Webhooks</h3>
            <p>This script creates webhook.</p>
            <button type="submit">Go</button>
        </form>
    </div>
    <div class="column column-20"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php'; ?>
