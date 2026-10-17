<?php
session_start();

require_once '../config/database.php';
require_once '../app/models/Buku.php';
require_once '../app/controllers/BukuController.php';

$pdo = (new Database())->getConnection();
$model = new Buku($pdo);
$controller = new BukuController($model);

$page = $_GET['page'] ?? 'buku';
$action = $_GET['action'] ?? 'index';

if ($page !== 'buku') {
    http_response_code(404);
    exit('Modul tidak ditemukan.');
}

match ($action) {
    'index'  => $controller->index(),
    'create' => $controller->create(),
    'store'  => $controller->store(),
    'edit'   => $controller->edit(),
    'update' => $controller->update(),
    'delete' => $controller->delete(),
    default  => (function () {
        http_response_code(404);
        exit('Halaman yang diminta tidak tersedia.');
    })()
};