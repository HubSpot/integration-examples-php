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
            <h3>Initialization Script - press Go button to initialize file upload form and Properties</h3>
            <p>This script creates two custom properies, upload form and webhook.</p>
            <div>
                <label>Form Name</label>
                <input type="text" name="formName" value="<?php echo $formName; ?>">
            </div>
            <button type="submit">Go</button>
        </form>
    </div>
    <div class="column column-20"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php'; ?>
