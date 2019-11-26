<?php

use Repositories\InvitationsRepository;

$invitation = [
    'name' => getValueOrNull('name', $_POST),
    'text' => getValueOrNull('text', $_POST),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    InvitationsRepository::insert($invitation);
    
    header('Location: /invitations/list.php');
}

include __DIR__.'/../../views/invitations/form.php';
