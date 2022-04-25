<?php


class Database{	
    private $connection = null;
    public function __construct(){
        try{
            $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
            $user = 'root';
            $password = '';
            $this->connection = new PDO($dsn,$user,$password);
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
    
    private function executeStatement( $statement = "" , $parameters = [] ){
        try{
        
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
            
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }		
    }
    
}




?>