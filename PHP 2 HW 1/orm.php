<?php

$db = @mysqli_connect("localhost:3306", "root", "root", "site") or die(mysqli_connect_error());



class Db {
    protected $tableName;
    protected $wheres = [];
    protected $andWhere = [];

    public function table($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    public function where($field, $value) {

        $this->wheres[] = [
            'field' => $field,
            'value' => $value
        ];
        return $this;
    }

    public function andWhere($field, $value) {

        $this->andWhere[] = [
            'field' => $field,
            'value' => $value
        ];
        return $this;
    }



    public function getAll() {

        $sql = "SELECT * FROM {$this->tableName} ";
        if (!empty($this->wheres)) {
            $sql .= " WHERE ";
        }
        foreach ($this->wheres as $value) {
            $sql .= $value['field'] . " = " . "'" . $value['value'] . "'";
            if ($value != end($this->wheres)) $sql .= " AND ";
        }

        $this->wheres = [];

        if (!empty($this->andWhere)) {
            $sql .= " AND ";
        }
        foreach ($this->andWhere as $value) {
            $sql .= $value['field'] . " = " . "'" . $value['value'] . "'";
            if ($value != end($this->andWhere)) $sql .= " AND ";
        }

        $this->andWhere = [];

        return $sql . PHP_EOL;
    }

    public function getOne($id) {

        return "SELECT * FROM {$this->tableName} WHERE id = {$id}" . PHP_EOL;
    }
}


$db1 = new Db();
echo "<br>" . $db1->table('orders')->where('name', 'Alex')->where('session_id', 'hkpq6kgr38aaudk615i933cslefpaapl')->andWhere('id', 4)->getAll();
$sql=$db1->table('orders')->where('name', 'Alex')->where('session_id', 'hkpq6kgr38aaudk615i933cslefpaapl')->andWhere('id', 4)->getAll();
/*echo "<br>" . $db->table('users')->where('login', 'admin')->where('pass', 123)->getAll();
echo "<br>" . $db->table('users')->getAll();
echo "<br>" . $db->table('user')->getOne(1);
echo "<br>" . $db->table('orders')->getOne(1);
 */

$result =mysqli_query($db, $sql);
//SELECT * FROM orders  WHERE name = 'Alex' AND session_id = 'hkpq6kgr38aaudk615i933cslefpaapl' AND id = '4'
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<? foreach ($result as $row) : ?>
<p>Имя: <?= $row['name'] ?></p>
<p>Сессия: <?= $row['session_id'] ?></p>
<p>ID: <?= $row['id'] ?></p>
<? endforeach;?>
</body>
</html>
