<?php
/**
 * @var string $formName
 */
include __DIR__.'/../_partials/header.php' ?>
<div class="row">
    <div class="column column-20"></div>
    <div class="column column-60">
        <form method="post">
            <h3>Initial Script</h3>
            <p>This script create two custom properies, uploading form and webhook.</p>
            <div>
                <label>From Name</label>
                <input type="text" name="formName" value="<?=$formName;?>">
            </div>
            <button type="submit">Go</button>
        </form>
    </div>
    <div class="column column-20"></div>
</div>
<?php include __DIR__.'/../_partials/footer.php' ?>
