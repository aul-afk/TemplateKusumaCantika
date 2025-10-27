<?php $title='Add Owner'; include __DIR__.'/../layout/header.php'; ?>
<h3>Add Owner</h3>
<form method="post" action="/qc-final/public/index.php?controller=owner&action=store">
  <div class="mb-2"><input name="owner_name" class="form-control" placeholder="Owner name" required></div>
  <div class="mb-2"><input name="phone_number" class="form-control" placeholder="Phone" required></div>
  <div class="mb-2"><input name="email" type="email" class="form-control" placeholder="Email"></div>
  <div class="mb-2"><input name="address" class="form-control" placeholder="Address"></div>
  <button class="btn btn-primary">Save</button>
</form>
<?php include __DIR__.'/../layout/footer.php'; ?>
