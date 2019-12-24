<?php

use Enums\EventTypeCode;
use Enums\UserInvitationAction;
use Helpers\HubspotClientHelper;
use Helpers\TimelineEventHelper;
use Repositories\InvitationsRepository;
use Repositories\UsersRepository;
use Telegram\TelegramBot;

TelegramBot::init();
$hubSpot = HubspotClientHelper::createFactory();

if (isset($_POST['listIds'])) {
    $invitation = InvitationsRepository::getById($_GET['id']);
    foreach ($_POST['listIds'] as $listId) {
        $contacts = $hubSpot->contactLists()->recentContacts($listId)->getData()->contacts;
        foreach ($contacts as $contact) {
            $contact = $hubSpot->contacts()->getById($contact->vid)->getData();
            $email = $contact->properties->email->value;
            $chatId = UsersRepository::getTelegramChatIdByEmail($email);
            if (!empty($chatId)) {
                TelegramBot::sendInvitation($invitation, $chatId);
                TimelineEventHelper::createEvent(
                    $chatId,
                    EventTypeCode::USER_INVITATION_ACTION,
                    [
                        'name' => $invitation['name'],
                        'action' => UserInvitationAction::RECEIVED,
                    ]
                );
            }
        }
    }
    $sent = true;
}

$contactLists = $hubSpot->contactLists()->all()->getData()->lists;

include __DIR__.'/../../views/invitations/send.php';
