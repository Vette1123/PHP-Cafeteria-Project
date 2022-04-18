<?php
class DataBase
{
    private $serverName;
    private $userName;
    private $userPass;
    private $dbName;
    private $charSet;
    private $dsn;
    private $db;

    public function __construct()
    {
        $this->serverName  = "localhost";
        $this->userName = "root";
        $this->userPass  = "Awad36148";
        $this->dbName = "cafeteria";
        $this->charSet = "utf8mb4";

        $this->dsn = "mysql:host=" . $this->serverName . "; dbname=" . $this->dbName . "; charset=" . $this->charSet;
    }
    public function connect()
    {
        try {
            $this->db = new PDO($this->dsn, $this->userName, $this->userPass);
        } catch (PDOException $err) {
            die($err->getMessage());
        }
    }
    public function selectOrdersByDate($uid, $from, $to)
    {

        try {
            $query = "SELECT * FROM  orders WHERE  orders.user_id =" . $uid . " AND date between '$from' and '$to'";


            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $user_orders = $stmt->fetchAll();
            return $user_orders;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function selectUsersWithDate($from, $to)
    {

        try {
            $query = "SELECT users.id ,name , SUM(totalPrice) as totalPrice FROM users JOIN orders ON users.id = orders.user_id and date between '$from' and '$to'  GROUP BY name";


            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $user_orders = $stmt->fetchAll();
            return $user_orders;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function selectAllByTableName($table_name)
    {
        $query = "SELECT * FROM $table_name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function selectUserOrdersByid($userid)
    {

        try {
            $query = "SELECT users.id ,name , SUM(totalPrice) as totalPrice FROM users JOIN orders ON users.id = orders.user_id AND users.id = $userid GROUP BY name";


            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $user_orders = $stmt->fetchAll();
            return $user_orders;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function selectUserOrdersFilteredByDate($uid)
    {

        try {
            $query = 'SELECT * FROM orders where  orders.user_id = ' . $uid . ' ORDER BY date DESC';

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $user_orders = $stmt->fetchAll();
            return $user_orders;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function changeStatus($id)
    {
        try {

            $sql = 'UPDATE `orders` SET `status`= "Canceled" WHERE id =' . $id . ' ';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }
    public function cancelOrder($id)
    {
        try {
            $sql = "DELETE FROM orders WHERE id = $id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }
    public function selectAllUsers($table_name)
    {
        $query = "SELECT * FROM $table_name";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function showusers()
    {

        try {

            $query1 = "SELECT users.id ,name , SUM(totalPrice)  as totalPrice FROM users JOIN orders ON users.id = orders.user_id  GROUP BY name";
            $stmt = $this->db->prepare($query1);
            $stmt->execute();
            $orders = $stmt->fetchAll();

            return $orders;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProductsInOrders($oid)
    {
        try {
            $sql_order = 'SELECT id, name,  price , picture , product_id, order_id, quantity  FROM orders_products
             JOIN products 
             ON orders_products.product_id = products.id
              WHERE orders_products.order_id = ' . $oid;
            $stat = $this->db->prepare($sql_order);
            $stat->execute();
            $orders_products = $stat->fetchAll();
            return $orders_products;
        } catch (PDOException $e) {
            return false;
        }
    }
}
