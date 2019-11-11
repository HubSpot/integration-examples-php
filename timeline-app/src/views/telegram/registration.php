<?php
/**
 * @var array $user
 */
include __DIR__.'/../_partials/header.php';
?>

<form method="post">
    <fieldset>
        <label for="firstname">First Name</label>
        <input type="text" placeholder="First Name" id="firstname" name="firstname" value="<?=$user['firstname'];?>">
        <label for="lastname">Last Name</label>
        <input type="text" placeholder="Last Name" id="lastname" name="lastname" value="<?=$user['lastname'];?>">
        <label for="email">Email</label>
        <input type="email" required placeholder="Email" id="email" name="email" value="<?=$user['email'];?>">
        <input id="get-offers" class="button-primary" type="submit" value="Get Offers">
    </fieldset>
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
