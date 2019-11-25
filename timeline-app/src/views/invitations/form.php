<?php

/**
 * 
 * @var array $invitation
 */

include __DIR__.'/../_partials/header.php';
?>

<form method="post">
<fieldset>
    <label for="name">Event's Name</label>
    <input type="text" placeholder="Event's Name" required id="name" name="name" value="<?=$invitation['name'];?>">
    <label for="text">Invintation Text</label>
    <textarea type="text" required placeholder="I would like to invite you ..." id="text" name="text"><?=$invitation['text'];?></textarea>
    <input id="save" class="button-primary" type="submit" value="Save">
    <a id='cancel' class="button" href="/invitations/list.php">Cansel</a>
</fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
