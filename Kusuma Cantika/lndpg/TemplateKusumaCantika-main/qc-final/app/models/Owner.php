<?php
class Owner {
    private $conn;
    private $table = 'owner';
    public $owner_id; public $owner_name; public $phone_number; public $email; public $address;
    public function __construct($db){ $this->conn = $db; }
    public function all(){ $stmt = $this->conn->query("SELECT * FROM {$this->table}"); return $stmt->fetchAll(PDO::FETCH_ASSOC); }
    public function find($id){ $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE owner_id=:id"); $stmt->execute(array(':id'=>$id)); return $stmt->fetch(PDO::FETCH_ASSOC); }
    public function create(){ $sql = "INSERT INTO {$this->table} (owner_name, phone_number, email, address) VALUES (:owner_name,:phone,:email,:address)"; $stmt = $this->conn->prepare($sql); return $stmt->execute(array(':owner_name'=>$this->owner_name,':phone'=>$this->phone_number,':email'=>$this->email,':address'=>$this->address)); }
    public function update($id){ $sql = "UPDATE {$this->table} SET owner_name=:owner_name, phone_number=:phone, email=:email, address=:address WHERE owner_id=:id"; $stmt = $this->conn->prepare($sql); return $stmt->execute(array(':owner_name'=>$this->owner_name,':phone'=>$this->phone_number,':email'=>$this->email,':address'=>$this->address,':id'=>$id)); }
    public function delete($id){ $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE owner_id=:id"); return $stmt->execute(array(':id'=>$id)); }
}
