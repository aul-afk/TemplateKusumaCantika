<?php
class Customer{
    private $conn; private $table='customer';
    public $customer_id; public $costume_id; public $customer_name; public $gender; public $email; public $phone_number; public $address;
    public function __construct($db){ $this->conn=$db; }
    public function all(){ $stmt = $this->conn->query("SELECT * FROM {$this->table}"); return $stmt->fetchAll(PDO::FETCH_ASSOC); }
    public function find($id){ $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE customer_id=:id"); $stmt->execute(array(':id'=>$id)); return $stmt->fetch(PDO::FETCH_ASSOC); }
    public function create(){ $sql="INSERT INTO {$this->table} (costume_id, customer_name, gender, email, phone_number, address) VALUES (:costume_id,:name,:gender,:email,:phone,:address)"; $stmt=$this->conn->prepare($sql); return $stmt->execute(array(':costume_id'=>$this->costume_id,':name'=>$this->customer_name,':gender'=>$this->gender,':email'=>$this->email,':phone'=>$this->phone_number,':address'=>$this->address)); }
    public function update($id){ $sql="UPDATE {$this->table} SET costume_id=:costume_id, customer_name=:name, gender=:gender, email=:email, phone_number=:phone, address=:address WHERE customer_id=:id"; $stmt=$this->conn->prepare($sql); return $stmt->execute(array(':costume_id'=>$this->costume_id,':name'=>$this->customer_name,':gender'=>$this->gender,':email'=>$this->email,':phone'=>$this->phone_number,':address'=>$this->address,':id'=>$id)); }
    public function delete($id){ $stmt=$this->conn->prepare("DELETE FROM {$this->table} WHERE customer_id=:id"); return $stmt->execute(array(':id'=>$id)); }
}
