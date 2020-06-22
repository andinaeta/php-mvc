<?php

class UsersModel
{
  private $db;
  private $table = 'users';

  public function __construct()
  {
    $this->db = new Database;
  }

  public function get($id = false)
  {
    if (!$id) {
      $this->db->query("SELECT * from $this->table");
      $users = $this->db->getResultArray();;
      return $users;
    }

    $this->db->query("SELECT * from $this->table WHERE id=:id");
    $this->db->bind('id', $id);
    $user = $this->db->getRowArray();
    return $user;
  }

  public function search($keyword)
  {
    $query = "SELECT * FROM $this->table WHERE name LIKE :keyword";
    $this->db->query($query);

    $this->db->bind('keyword', "%$keyword%");

    return $this->db->getResultArray();
  }

  public function insert($data)
  {
    $query = "INSERT INTO $this->table VALUES ('', :name, :email, :date_created)";
    $this->db->query($query);

    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('date_created', time());

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function update($data)
  {
    $query = "UPDATE $this->table SET name=:name, email=:email WHERE id=:id";
    $this->db->query($query);

    $this->db->bind('id', $data['id']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function delete($id)
  {
    $query = "DELETE FROM $this->table WHERE id=:id";
    $this->db->query($query);

    $this->db->bind('id', $id);

    $this->db->execute();

    return $this->db->affectedRows();
  }
}
