<?php

error_reporting(E_ALL ^ E_WARNING); 


class ConnectDB
{

    private $db;

    public  function __construct()
    {
        try {
            $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
            $user = 'root';
            $password = '';
            $this->db = new PDO($dsn, $user, $password);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }


    public function checkEmail($email,$pass){
        $sql="SELECT * FROM users WHERE email='$email' AND password='$pass' ;";
        $stmt = $this->db->prepare($sql);
         $stmt->execute();
        $user=$stmt->fetch();

        return $user;


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


    //================= dbclass.php ==================================


    private function executeStatement( $statement = "" , $parameters = [] ){
        try{
        
            $stmt = $this->db->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }


    public function Insert( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            return $this->connection->lastInsertId();
            
        }catch(Exception $e){
            // throw new Exception($e->getMessage());   
        }		
    }
    public function Select( $statement = "" , $parameters = [] ){
        try{
            
            $stmt = $this->executeStatement( $statement , $parameters );
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }
    public function Update( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }		
    
    public function Remove( $statement = "" , $parameters = [] ){
        try{
            
            $this->executeStatement( $statement , $parameters );
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }
    
    //========================== DataBaseProducts.php ===========================

    public function selectUserOrders($uid)
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



    public function getAllTableIDs($tableName){
        $query1 = "SELECT id from ".$tableName;
        $stmt = $this->db->prepare($query1);
        $stmt->execute();
        $ids_array = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $ids_array;
    }

    public function getProductPrice($productId){
        $query1 = "SELECT price from products where id = ".$productId;
        $stmt = $this->db->prepare($query1);
        $stmt->execute();
        $price = $stmt->fetch();
        return $price;
    }

    public function placeOrder($userId, $totalPrice){
        $date = (string )date("Y-m-d H:i:s");
        $query1 = "INSERT INTO orders (date, totalPrice,user_id) Values
        (?,?,?)";
        $stmt = $this->db->prepare($query1);
        $stmt->bindParam(1, $date);
        $stmt->bindParam(2, $totalPrice);
        $stmt->bindParam(3, $userId);
        $stmt->execute();
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function placeOrderDetails($orderId, $detailsArr){
        foreach ($detailsArr as $key => $value) {
            $query1 = "INSERT INTO orders_products (order_id, product_id,quantity) Values
            ($orderId, $key, $value)";
            $stmt = $this->db->prepare($query1);
            $stmt->execute();
        }
    }

    public function searchProducts($keyword){
        $query="SELECT * FROM `products` WHERE `name` LIKE :keyword;";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':keyword','%'.$keyword.'%');
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function getLastOrderId($userId){
        //Getting last order
        $query = "SELECT id from orders where user_id = ? ORDER BY date DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        $orderId = $stmt->fetchColumn();
        return $orderId;
    }

    public function showAllUsers(){
        $query = "SELECT id, name FROM users where role <> 'admin'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $allUsers = $stmt->fetchAll();
        return $allUsers;
    }


    





}
