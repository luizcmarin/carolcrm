<?php
?>
<form action="<?= url_to('Install::index'); ?>" method="post" accept-charset="utf-8">
  <?= csrf_field(); ?>
  <input type="hidden" name="step" value="2">
  <div class="row">
    <div class="col-md-12">
      <h4 class="fw-bold mb-0">Permissões da Aplicação</h4>
      <p class="text-muted">
        Please make sure that all the files and folders listed below are writable.
        <br />
        You may need to change the permissions of the files/folders via your hosting control panel or FTP client.
      </p>
      <hr />
      <table class="table table-hover">
        <thead>
          <tr>
            <th><b>File/Folder</b></th>
            <th><b>Result</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="fw-medium">uploads/proposals</td>
            <td><?= $requirement_proposals; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/estimates</td>
            <td><?= $requirement_estimates; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/ticket_attachments</td>
            <td><?= $ticket_attachments; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/tasks</td>
            <td><?= $tasks; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/staff_profile_images</td>
            <td><?= $staff_profile_images; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/projects</td>
            <td><?= $projects; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/newsfeed</td>
            <td><?= $newsfeed; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/leads</td>
            <td><?= $leads; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/invoices</td>
            <td><?= $invoices; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/expenses</td>
            <td><?= $expenses; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/discussions</td>
            <td><?= $discussions; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/contracts</td>
            <td><?= $contracts; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/company</td>
            <td><?= $company; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/clients</td>
            <td><?= $clients; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">uploads/client_profile_images</td>
            <td><?= $client_profile_images; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">/temp folder Writable</td>
            <td><?= $temp_folder_writable; ?></td>
          </tr>
          <tr>
            <td class="fw-medium">writable/logs folder Writable</td>
            <td><?= $log_folder_writable; ?></td>
          </tr>
        </tbody>
      </table>
      <hr />
      <div class="text-end">
        <?php if ($error === true) { ?>
          <a class="btn btn-primary opacity-50" disabled>Next</a>
        <?php } else { ?>
          <button type="submit" class="btn btn-primary">Next</button>
        <?php } ?>
      </div>
    </div>
  </div>
</form>