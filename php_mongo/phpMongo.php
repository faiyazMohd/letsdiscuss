<?php 
   // connect to mongodb 
   $m = new MongoClient(); 
   echo "Connection to database successfully"; 
  
   // select a database 
   $db = $m->mydb2; 
   echo "Database mydb selected"; 
   $collection = $db->mycol; 
   echo "Collection selected succsessfully"; 
  
   $document = array(  
      "title" => "MYSql",  
      "description" => "database",  
      "likes" => 10, 
      "url" => "http://www.sql.com", 
      "by" => "SQL" 
   ); 
  
   $collection->insert($document); 
   echo "Document inserted successfully"; 
?>