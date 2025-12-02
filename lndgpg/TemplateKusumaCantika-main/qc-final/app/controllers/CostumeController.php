<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Costume.php';

class CostumeController {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function index($id = null) {
        $costume = new Costume($this->db);
        $data = $costume->all();
        $editItem = $id ? $costume->find($id) : null;
        include __DIR__ . '/../views/costume/index.php';
    }

    public function store() {
        $costume = new Costume($this->db);
        $img = null;
        if(!empty($_FILES['image']['name'])) {
            $name = time() . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/' . $name);
            $img = $name;
        }

        $costume->create([
            "category" => $_POST['category'],
            "name" => $_POST['name'],
            "size" => $_POST['size'],
            "price" => $_POST['price'],
            "availability" => $_POST['availability'],
            "image" => $img
        ]);

        header("Location: /TemplateKusumaCantika-main/qc-final/public/index.php/costume/index");
    }

    public function update($id) {
        $costume = new Costume($this->db);
        $data = [
            "category" => $_POST['category'],
            "name" => $_POST['name'],
            "size" => $_POST['size'],
            "price" => $_POST['price'],
            "availability" => $_POST['availability']
        ];

        if(!empty($_FILES['image']['name'])) {
            $name = time() . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../public/images/' . $name);
            $data['image'] = $name;
        }

        $costume->update($id, $data);
        header("Location: /TemplateKusumaCantika-main/qc-final/public/index.php/costume/index");
    }

    public function delete($id) {
        $costume = new Costume($this->db);
        $costume->delete($id);
        header("Location: /TemplateKusumaCantika-main/qc-final/public/index.php/costume/index");
    }
}
