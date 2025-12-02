<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Rental.php';
$db = (new Database())->getConnection();
$model = new Rental($db);
$action = $_GET['action'] ?? 'index';
if($action == 'index'){ $rows = $model->all(); include __DIR__ . '/../views/rental/index.php'; exit; }
if($action == 'create'){ include __DIR__ . '/../views/rental/create.php'; exit; }
if($action == 'store' && $_POST){ $model->customer_id = $_POST['customer_id'] ?: null; $model->costume_id = $_POST['costume_id'] ?: null; $model->start_date = $_POST['start_date'] ?? ''; $model->end_date = $_POST['end_date'] ?? ''; $model->quantity = $_POST['quantity'] ?? 1; $model->total_amount = $_POST['total_amount'] ?? 0; $model->payment_status = $_POST['payment_status'] ?? 'unpaid'; $model->status = $_POST['status'] ?? 'booked'; $model->penalty_fee = $_POST['penalty_fee'] ?? 0; $model->create(); header('Location: ../../public/index.php?controller=rental'); exit; }
if($action == 'edit'){ $id = $_GET['id']; $row = $model->find($id); include __DIR__ . '/../views/rental/edit.php'; exit; }
if($action == 'update' && $_POST){ $id = $_GET['id']; $model->customer_id = $_POST['customer_id'] ?: null; $model->costume_id = $_POST['costume_id'] ?: null; $model->start_date = $_POST['start_date'] ?? ''; $model->end_date = $_POST['end_date'] ?? ''; $model->quantity = $_POST['quantity'] ?? 1; $model->total_amount = $_POST['total_amount'] ?? 0; $model->payment_status = $_POST['payment_status'] ?? 'unpaid'; $model->status = $_POST['status'] ?? 'booked'; $model->penalty_fee = $_POST['penalty_fee'] ?? 0; $model->update($id); header('Location: ../../public/index.php?controller=rental'); exit; }
if($action == 'delete'){ $id = $_GET['id']; $model->delete($id); header('Location: ../../public/index.php?controller=rental'); exit; }
