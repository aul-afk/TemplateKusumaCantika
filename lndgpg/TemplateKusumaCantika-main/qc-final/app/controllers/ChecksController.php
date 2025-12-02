<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Checks.php';
$db = (new Database())->getConnection();
$model = new Checks($db);
$action = $_GET['action'] ?? 'index';
if($action == 'index'){ $rows = $model->all(); include __DIR__ . '/../views/checks/index.php'; exit; }
if($action == 'create'){ include __DIR__ . '/../views/checks/create.php'; exit; }
if($action == 'store' && $_POST){ $model->owner_id = $_POST['owner_id'] ?: null; $model->costume_id = $_POST['costume_id'] ?: null; $model->check_date = $_POST['check_date'] ?? ''; $model->status = $_POST['status'] ?? ''; $model->notes = $_POST['notes'] ?? ''; $model->create(); header('Location: ../../public/index.php?controller=checks'); exit; }
if($action == 'edit'){ $id = $_GET['id']; $row = $model->find($id); include __DIR__ . '/../views/checks/edit.php'; exit; }
if($action == 'update' && $_POST){ $id = $_GET['id']; $model->owner_id = $_POST['owner_id'] ?: null; $model->costume_id = $_POST['costume_id'] ?: null; $model->check_date = $_POST['check_date'] ?? ''; $model->status = $_POST['status'] ?? ''; $model->notes = $_POST['notes'] ?? ''; $model->update($id); header('Location: ../../public/index.php?controller=checks'); exit; }
if($action == 'delete'){ $id = $_GET['id']; $model->delete($id); header('Location: ../../public/index.php?controller=checks'); exit; }
