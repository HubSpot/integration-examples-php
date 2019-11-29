<?php

use Repositories\InvitationsRepository;

$invitation = [
    'name' => getValueOrNull('name', $_POST),
    'text' => getValueOrNull('text', $_POST),
];

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    InvitationsRepository::insert($invitation);

    header('Location: /invitations/list.php');
}

include __DIR__.'/../../views/invitations/form.php';
