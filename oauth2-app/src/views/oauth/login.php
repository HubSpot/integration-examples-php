<?php
use Helpers\OAuth2Helper;

include __DIR__.'/../_partials/header.php';
?>

<div class="container text-center">
    <h3>In order to continue please update the redirect URL on Auth settings page  of your app</h3>
    <h4>Redirect URL</h4>
    <pre id="copyText"><?php echo OAuth2Helper::getRedirectUri(); ?></pre>
    <button id="copyBtn" class="button-primary">Copy</button>
    <h3>After that authorize via OAuth</h3>
    <div class="authorize-button">
        <a class="button" href="/oauth/authorize">Authorize</a>
    </div>
</div>
<pre>
// src/actions/oauth/authorize.php - Generate URL for OAuth
$authUrl = SevenShores\Hubspot\Utils\OAuth2::getAuthUrl(
    'ClientID',
    'Redirect Uri',
    ['Scopes']
);
</pre>
<script type="text/javascript" src="/js/copy.js?<?php echo filemtime('./js/copy.js'); ?>"></script>

<?php include __DIR__.'/../_partials/footer.php'; ?>
