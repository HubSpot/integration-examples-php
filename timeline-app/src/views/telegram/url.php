<?php
/**
 * @var string $botLink
 */
include __DIR__.'/../_partials/header.php';
?>
<h3 id="link"><?=$botLink;?></h3>
<h4 id="success" class="success-message hidden">Сopied!</h4>
<button id="copy" onclick="copyFrom('link')">Copy Link</button>
<?php include __DIR__.'/../_partials/footer.php' ?>
