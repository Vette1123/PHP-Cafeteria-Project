<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ConnectDB{

        private $db;

    public  function __construct(){
        try {
            $dsn = 'mysql:dbname=cafetria;host=127.0.0.1;port=3306;'; #port number
            $user = 'abdallah';
            $password = '*Right0107377';
           $this->db= new PDO($dsn, $user, $password);

        }catch (Exception $ex){
            echo $ex->getMessage();
        }
    }


    public function orderDeliverd($id)
    {
        try {
            $sql = 'UPDATE `orders` SET `status`= "Delivered" WHERE id =' . $id . ' ';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }

    // public function deletedCanclefOrder($order_id){

    //     $delete_query='delete from orders where id = :id ;';
    //     $stmt=$this->db->prepare($delete_query);
    //     $stmt->execute([':id' => $order_id]);
    // }


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
    public function showUsers()
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



