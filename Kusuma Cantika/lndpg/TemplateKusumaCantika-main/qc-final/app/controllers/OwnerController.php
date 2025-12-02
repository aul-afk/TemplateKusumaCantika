<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Owner.php';
$db = (new Database())->getConnection();
$model = new Owner($db);
$action = $_GET['action'] ?? 'index';
if($action == 'index'){
    $owners = $model->all();
    include __DIR__ . '/../views/owner/index.php';
    exit;
}
if($action == 'create'){ include __DIR__ . '/../views/owner/create.php'; exit; }
if($action == 'store' && $_POST){
    $model->owner_name = $_POST['owner_name'] ?? '';
    $model->phone_number = $_POST['phone_number'] ?? '';
    $model->email = $_POST['email'] ?? '';
    $model->address = $_POST['address'] ?? '';
    $model->create();
    header('Location: ../../public/index.php?controller=owner'); exit;
}
if($action == 'edit'){ $id = $_GET['id']; $row = $model->find($id); include __DIR__ . '/../views/owner/edit.php'; exit; }
if($action == 'update' && $_POST){ $id = $_GET['id']; $model->owner_name = $_POST['owner_name'] ?? ''; $model->phone_number = $_POST['phone_number'] ?? ''; $model->email = $_POST['email'] ?? ''; $model->address = $_POST['address'] ?? ''; $model->update($id); header('Location: ../../public/index.php?controller=owner'); exit; }
if($action == 'delete'){ $id = $_GET['id']; $model->delete($id); header('Location: ../../public/index.php?controller=owner'); exit; }
