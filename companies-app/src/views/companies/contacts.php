<?php include __DIR__.'/../_partials/header.php' ?>

<pre>
// src/actions/companies/contacts.php
$hubSpot->contacts()->search($search)
</pre>
<form>
    <fieldset>
        <input type="text" name="search" placeholder="Search.." id="search" value="<?= htmlentities($search) ?>">
        <input type="hidden" name="companyId" value="<?= htmlentities($companyId) ?>"
    </fieldset>
</form>

<form method="post">
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Selected</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($contacts as $contact) { ?>
        <tr>
          <td><?= htmlentities($contact->vid) ?></td>
          <td><?= htmlentities($contact->properties->firstname->value.' '.$contact->properties->firstname->value) ?></td>
          <td><input type="checkbox" name="contactsIds[<?= htmlentities($contact->vid) ?>]" /></td>
        </tr>
      <?php }?>
      </tbody>
    </table>
    <input type="hidden" name="companyId" value="<?= htmlentities($companyId) ?>" />

<pre>
// src/actions/companies/contacts.php
$hubSpot->crmAssociations()->create([
    'fromObjectId' => $contactId,
    'toObjectId' => $companyId,
    'category' => 'HUBSPOT_DEFINED',
    'definitionId' => CONTACT_TO_COMPANY_DEFINITION_ID,
])
</pre>

    <input type="submit" value="Add Selected" />
</form>

<?php include __DIR__.'/../_partials/footer.php' ?>
