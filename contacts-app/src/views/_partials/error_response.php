<div class="error-wrapper">
    <h4>Result: <span class="result">error</span></h4>
    <h4>Status Code: <?= htmlentities($errorResponse->getStatusCode()) ?></h4>
    <pre><?php print_r($errorResponse->getData()) ?></pre>
</div>
