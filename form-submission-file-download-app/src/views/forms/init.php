<?php
/**
 * @var string
 */
include __DIR__.'/../_partials/header.php'; ?>
<div class="row">
    <div class="column column-15"></div>
    <div class="column column-70">
<pre>
// src/actions/forms/init.php - form and properties initialization script
$propertyResponse = $hubSpot->contactProperties()->create(...)
....
$formResponse = $hubSpot->forms()->create(...)
</pre>
        <form method="post">
            <h3>Initialization Script - press Go button to initialize file upload form and Properties</h3>
            <p>This script creates two custom properies, upload form and webhook.</p>
            <div>
                <label>Form Name</label>
                <input type="text" required="" name="formName" value="<?php echo $formName; ?>">
            </div>
            <div class="text-center">
                <button type="submit">Go</button>
            </div>
        </form>
    </div>
    <div class="column column-15"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php'; ?>
