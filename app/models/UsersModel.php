<?php

class UsersModel extends Model
{
  protected $table = 'users';

  public function __construct()
  {
    parent::__construct();
  }

  public function get($username = false)
  {
    if (!$username) {
      return $this->db->findAll($this->table);
    }

    return $this->db->getWhere($this->table, ['username' => $username], 'getRowArray');
  }

  public function insert($data)
  {
    return $this->db->save($this->table, $data);
  }
}
