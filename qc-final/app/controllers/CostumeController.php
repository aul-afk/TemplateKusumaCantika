<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Costume.php';
$db = (new Database())->getConnection();
$model = new Costume($db);
$action = $_GET['action'] ?? 'index';
if($action == 'index'){ $rows = $model->all(); include __DIR__ . '/../views/costume/index.php'; exit; }
if($action == 'create'){ include __DIR__ . '/../views/costume/create.php'; exit; }
if($action == 'store' && $_POST){ $model->owner_id = $_POST['owner_id'] ?: null; $model->costume_category = $_POST['costume_category'] ?? ''; $model->color = $_POST['color'] ?? ''; $model->size = $_POST['size'] ?? ''; $model->price = $_POST['price'] ?? 0; $model->availability = $_POST['availability'] ?? 'yes'; $model->create(); header('Location: ../../public/index.php?controller=costume'); exit; }
if($action == 'edit'){ $id = $_GET['id']; $row = $model->find($id); include __DIR__ . '/../views/costume/edit.php'; exit; }
if($action == 'update' && $_POST){ $id = $_GET['id']; $model->owner_id = $_POST['owner_id'] ?: null; $model->costume_category = $_POST['costume_category'] ?? ''; $model->color = $_POST['color'] ?? ''; $model->size = $_POST['size'] ?? ''; $model->price = $_POST['price'] ?? 0; $model->availability = $_POST['availability'] ?? 'yes'; $model->update($id); header('Location: ../../public/index.php?controller=costume'); exit; }
if($action == 'delete'){ $id = $_GET['id']; $model->delete($id); header('Location: ../../public/index.php?controller=costume'); exit; }
