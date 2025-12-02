<?php
class Costume {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        $result = $this->db->query("SELECT * FROM costume ORDER BY costume_id ASC");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM costume WHERE costume_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO costume (costume_category, costume_name, size, price, availability, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['category'], $data['name'], $data['size'], $data['price'], $data['availability'], $data['image']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        if(isset($data['image'])) {
            $stmt = $this->db->prepare("UPDATE costume SET costume_category=?, costume_name=?, size=?, price=?, availability=?, image=? WHERE costume_id=?");
            $stmt->bind_param("ssssssi", $data['category'], $data['name'], $data['size'], $data['price'], $data['availability'], $data['image'], $id);
        } else {
            $stmt = $this->db->prepare("UPDATE costume SET costume_category=?, costume_name=?, size=?, price=?, availability=? WHERE costume_id=?");
            $stmt->bind_param("sssssi", $data['category'], $data['name'], $data['size'], $data['price'], $data['availability'], $id);
        }
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM costume WHERE costume_id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
