<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Customer.php';
$db = (new Database())->getConnection();
$model = new Customer($db);
$action = $_GET['action'] ?? 'index';
if($action == 'index'){ $rows = $model->all(); include __DIR__ . '/../views/customer/index.php'; exit; }
if($action == 'create'){ include __DIR__ . '/../views/customer/create.php'; exit; }
if($action == 'store' && $_POST){ $model->costume_id = $_POST['costume_id'] ?: null; $model->customer_name = $_POST['customer_name'] ?? ''; $model->gender = $_POST['gender'] ?? ''; $model->phone_number = $_POST['phone_number'] ?? ''; $model->email = $_POST['email'] ?? ''; $model->address = $_POST['address'] ?? ''; $model->create(); header('Location: ../../public/index.php?controller=customer'); exit; }
if($action == 'edit'){ $id = $_GET['id']; $row = $model->find($id); include __DIR__ . '/../views/customer/edit.php'; exit; }
if($action == 'update' && $_POST){ $id = $_GET['id']; $model->costume_id = $_POST['costume_id'] ?: null; $model->customer_name = $_POST['customer_name'] ?? ''; $model->gender = $_POST['gender'] ?? ''; $model->phone_number = $_POST['phone_number'] ?? ''; $model->email = $_POST['email'] ?? ''; $model->address = $_POST['address'] ?? ''; $model->update($id); header('Location: ../../public/index.php?controller=customer'); exit; }
if($action == 'delete'){ $id = $_GET['id']; $model->delete($id); header('Location: ../../public/index.php?controller=customer'); exit; }
