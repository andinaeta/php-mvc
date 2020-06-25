<?php

class Database
{
  protected $host = DB_HOST;
  protected $user = DB_USER;
  protected $pass = DB_PASS;
  protected $db_name = DB_NAME;

  protected $dbh;
  protected $stmt;

  public function __construct()
  {
    // https://www.php.net/manual/en/class.pdo
    // https://www.php.net/manual/en/ref.pdo-mysql.connection

    $dsn = "mysql:host=$this->host;dbname=$this->db_name";
    $options = [
      PDO::ATTR_PERSISTENT => TRUE,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      return Exceptions::CustomException('Database Exception', $e->getMessage());
    }
  }

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute()
  {
    $this->stmt->execute();
  }

  public function getRowArray()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getResultArray()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function affectedRows()
  {
    return $this->stmt->rowCount();
  }

  // === Builder ===

  /**
   * @return $rows
   */
  public function findAll($table)
  {
    $this->query("SELECT * FROM $table");
    return $this->getResultArray();
  }

  /**
   * @return $row
   */
  public function find($table, $id)
  {
    $this->query("SELECT * FROM $table WHERE id=:id");
    $this->bind('id', $id);
    return $this->getRowArray();
  }

  /**
   * @return $affectedRows
   */
  public function save($table, $data)
  {
    $sql = "INSERT INTO $table VALUES ('',";
    $i = 0;
    foreach ($data as $key => $value) {
      $sql .= ":$key";
      $i++;
      if (count($data) > $i) $sql .= ",";
    }
    $sql .= ")";
    $this->query($sql);

    foreach ($data as $key => $value) {
      $this->bind($key, $value);
    }

    $this->execute();
    return $this->affectedRows();
  }

  /**
   * @return $affectedRows
   */
  public function set($table, $id, $data)
  {
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
      $sql .= "$key=:$key";
      $i++;
      if (count($data) > $i) $sql .= ",";
    }
    $sql .= " WHERE id=:id";
    $this->query($sql);

    foreach ($data as $key => $value) {
      $this->bind($key, $value);
    }
    $this->bind('id', $id);


    $this->execute();
    return $this->affectedRows();
  }

  /**
   * @return $affectedRows
   */
  public function remove($table, $id)
  {
    $sql = "DELETE FROM $table WHERE id=:id";
    $this->query($sql);

    $this->bind('id', $id);

    $this->execute();
    return $this->affectedRows();
  }

  /**
   * @return $array
   */
  public function getWhere($table, $where = [], $return = 'getRowArray' | 'getResultArray')
  {
    $sql = "SELECT * FROM $table WHERE ";

    $key = array_keys($where)[0];
    $value = array_values($where)[0];

    $sql .= "$key=:$key";

    if (count($where) > 1) {
      $where = array_splice($where, 1, count($where));

      $keys = array_keys($where);

      foreach ($keys as $k) {
        $sql .= " AND $k=:$k";
      }
    }

    $this->query($sql);
    $this->bind($key, $value);

    if (count($where) > 0) {
      for ($i = 0; $i < count($where); $i++) {
        $key = array_keys($where)[$i];
        $value = array_values($where)[$i];

        $this->bind($key, $value);
      }
    }

    return $this->$return();
  }
}
