<?php include __DIR__ . '/../_partials/header.php' ?>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Events</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($contacts as $contact) { ?>
        <tr>
            <td><?= htmlentities($contact['id']) ?></a></td>
            <td><?= htmlentities($contact['properties']->firstname->value).' '.htmlentities($contact['properties']->lastname->value) ?></td>
            <td><?= htmlentities(implode(', ', $contact['events'])) ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php include __DIR__ . '/../_partials/footer.php' ?>
