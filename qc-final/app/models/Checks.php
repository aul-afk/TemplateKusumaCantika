<?php
class Checks{
    private $conn; private $table='checks';
    public $check_id; public $owner_id; public $costume_id; public $check_date; public $status; public $notes;
    public function __construct($db){ $this->conn=$db; }
    public function all(){ $stmt = $this->conn->query("SELECT ch.*, o.owner_name, co.costume_category FROM {$this->table} ch LEFT JOIN owner o ON ch.owner_id=o.owner_id LEFT JOIN costume co ON ch.costume_id=co.costume_id"); return $stmt->fetchAll(PDO::FETCH_ASSOC); }
    public function find($id){ $stmt=$this->conn->prepare("SELECT * FROM {$this->table} WHERE check_id=:id"); $stmt->execute(array(':id'=>$id)); return $stmt->fetch(PDO::FETCH_ASSOC); }
    public function create(){ $sql="INSERT INTO {$this->table} (owner_id,costume_id,check_date,status,notes) VALUES (:owner_id,:costume_id,:check_date,:status,:notes)"; $stmt=$this->conn->prepare($sql); return $stmt->execute(array(':owner_id'=>$this->owner_id,':costume_id'=>$this->costume_id,':check_date'=>$this->check_date,':status'=>$this->status,':notes'=>$this->notes)); }
    public function update($id){ $sql="UPDATE {$this->table} SET owner_id=:owner_id,costume_id=:costume_id,check_date=:check_date,status=:status,notes=:notes WHERE check_id=:id"; $stmt=$this->conn->prepare($sql); return $stmt->execute(array(':owner_id'=>$this->owner_id,':costume_id'=>$this->costume_id,':check_date'=>$this->check_date,':status'=>$this->status,':notes'=>$this->notes,':id'=>$id)); }
    public function delete($id){ $stmt=$this->conn->prepare("DELETE FROM {$this->table} WHERE check_id=:id"); return $stmt->execute(array(':id'=>$id)); }
}
