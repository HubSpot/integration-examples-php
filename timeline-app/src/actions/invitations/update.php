<?php

use Repositories\InvitationsRepository;

if (!array_key_exists('id', $_GET)) {
    header('Location: /invitations/list.php');
}

$invitation = InvitationsRepository::getById($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invitation['name'] = $_POST['name'];
    $invitation['text'] = $_POST['text'];
    InvitationsRepository::update($invitation);
    
    header('Location: /invitations/list.php');
}

include __DIR__.'/../../views/invitations/form.php';
