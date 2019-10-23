<?php if (isset($engagements) && isset($contactId)) { ?>
    <h3>Engagements</h3>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($engagements as $engagement) { ?>
            <tr>
                <td><?= htmlentities($engagement->engagement->id) ?></td>
                <td><?= htmlentities($engagement->engagement->type) ?></td>
                <td><?= htmlentities($engagement->metadata->title) ?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <div>
        <a id="engagementNew" href="/engagements/new.php?contactId=<?= htmlentities($contactId) ?>">
            <input class="button-primary" type="button" value="Add Engagement">
        </a>
    </div>
<?php } ?>
