<?php $title='Edit Owner'; include __DIR__.'/../layout/header.php'; ?>
<h3>Edit Owner</h3>
<form method="post" action="/qc-final/public/index.php?controller=owner&action=update&id=<?= $row['owner_id'] ?>">
  <div class="mb-2"><input name="owner_name" class="form-control" value="<?= htmlspecialchars($row['owner_name']) ?>" required></div>
  <div class="mb-2"><input name="phone_number" class="form-control" value="<?= htmlspecialchars($row['phone_number']) ?>" required></div>
  <div class="mb-2"><input name="email" type="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>"></div>
  <div class="mb-2"><input name="address" class="form-control" value="<?= htmlspecialchars($row['address']) ?>"></div>
  <button class="btn btn-primary">Update</button>
</form>
<?php include __DIR__.'/../layout/footer.php'; ?>
