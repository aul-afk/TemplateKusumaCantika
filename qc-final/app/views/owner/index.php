<?php $title='Owners'; include __DIR__.'/../layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Owners</h2>
  <a href="/qc-final/public/index.php?controller=owner&action=create" class="btn btn-success">Add Owner</a>
</div>
<table class="table table-striped">
  <thead class="table-dark"><tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>Action</th></tr></thead>
  <tbody>
    <?php foreach($owners as $o): ?>
    <tr>
      <td><?= $o['owner_id'] ?></td>
      <td><?= htmlspecialchars($o['owner_name']) ?></td>
      <td><?= htmlspecialchars($o['phone_number']) ?></td>
      <td><?= htmlspecialchars($o['email']) ?></td>
      <td><?= htmlspecialchars($o['address']) ?></td>
      <td>
        <a href="/qc-final/public/index.php?controller=owner&action=edit&id=<?= $o['owner_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="/qc-final/public/index.php?controller=owner&action=delete&id=<?= $o['owner_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__.'/../layout/footer.php'; ?>
