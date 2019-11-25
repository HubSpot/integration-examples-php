<?php

use Repositories\InvitationsRepository;

$invitation = getDataFromPost(['name', 'text']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    InvitationsRepository::insert($invitation);
    
    header('Location: /invitations/list.php');
}

include __DIR__.'/../../views/invitations/form.php';
