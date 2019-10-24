<?php include __DIR__ . '/../_partials/header.php' ?>

<h3 class="alert-not-shown-events">New webhooks are received. <a href="#">Reload</a> the page to see updates</h3>
<table>
    <thead>
    <tr>
        <th>Contact ID</th>
        <th>Contact Name</th>
        <th>Events</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($contacts as $contact) { ?>
        <tr>
            <td><?= htmlentities($contact['id']) ?></a></td>
            <td><?= htmlentities($contact['properties']->firstname->value).' '.htmlentities($contact['properties']->lastname->value) ?></td>
            <td>
                <?php foreach ($contact['events'] as $event) { ?>
                    <span class="event <?= htmlentities($event) ?>"><?= htmlentities($event) ?></span>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
include __DIR__ . '/../_partials/pagination.php';
include __DIR__ . '/../_partials/footer.php';
?>
