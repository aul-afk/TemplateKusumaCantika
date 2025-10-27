<?php
class Costume {
    private $conn; private $table = 'costume';
    public $costume_id; public $owner_id; public $costume_category; public $color; public $size; public $price; public $availability;
    public function __construct($db){ $this->conn = $db; }
    public function all(){ $stmt = $this->conn->query("SELECT c.*, o.owner_name FROM {$this->table} c LEFT JOIN owner o ON c.owner_id=o.owner_id"); return $stmt->fetchAll(PDO::FETCH_ASSOC); }
    public function find($id){ $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE costume_id=:id"); $stmt->execute(array(':id'=>$id)); return $stmt->fetch(PDO::FETCH_ASSOC); }
    public function create(){ $sql = "INSERT INTO {$this->table} (owner_id, costume_category, color, size, price, availability) VALUES (:owner_id,:category,:color,:size,:price,:avail)"; $stmt = $this->conn->prepare($sql); return $stmt->execute(array(':owner_id'=>$this->owner_id,':category'=>$this->costume_category,':color'=>$this->color,':size'=>$this->size,':price'=>$this->price,':avail'=>$this->availability)); }
    public function update($id){ $sql = "UPDATE {$this->table} SET owner_id=:owner_id, costume_category=:category, color=:color, size=:size, price=:price, availability=:avail WHERE costume_id=:id"; $stmt = $this->conn->prepare($sql); return $stmt->execute(array(':owner_id'=>$this->owner_id,':category'=>$this->costume_category,':color'=>$this->color,':size'=>$this->size,':price'=>$this->price,':avail'=>$this->availability,':id'=>$id)); }
    public function delete($id){ $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE costume_id=:id"); return $stmt->execute(array(':id'=>$id)); }
}
