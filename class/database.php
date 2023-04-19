<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        include_once("config.php");
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function get($table, $where=null) {
        if ($where) {
            $where = " WHERE ".$where;
        }
        $sql = "SELECT * FROM ".$table.$where;
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function insert($table, $data) {
        if (is_array($data)) {
            $columns = implode(",", array_keys($data));
            $values = implode(",", array_map(array($this->conn, 'real_escape_string'), array_values($data)));
        }
        $sql = "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")";
        $result = $this->conn->query($sql);
        if ($result === true) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

    public function update($table, $data, $where) {
        if (is_array($data)) {
            $update_value = implode(",", array_map(function ($val, $key) {
                return $key.'="'.$val.'"';
            }, $data, array_keys($data)));
        }
        $sql = "UPDATE ".$table." SET ".$update_value." WHERE ".$where;
        $result = $this->conn->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $filter) {
        $sql = "DELETE FROM ".$table." ".$filter;
        $result = $this->conn->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }
}
?>
