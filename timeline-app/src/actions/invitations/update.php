<?php

use Repositories\InvitationsRepository;

if (!array_key_exists('id', $_GET)) {
    header('Location: /invitations/list.php');
}

$invitation = getDataFromPost(['name', 'text'], InvitationsRepository::getById($_GET['id']));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    InvitationsRepository::update($invitation);
    
    header('Location: /invitations/list.php');
}

include __DIR__.'/../../views/invitations/form.php';
