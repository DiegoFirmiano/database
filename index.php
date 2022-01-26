<?php

require_once "files/DatabaseException.php";
require_once "files/Connection.php";
require_once "files/Crud.php";

//Uncomment the line below to database connection response
//var_dump(Connection::getConnection());


$crud = new Crud();

//Uncomment this line to see read results
//var_dump($crud->read("names","*")->rowCount());
//$crud->read("names","*");
//foreach( $crud->read("names","*")->fetchAll() as $name){
//    echo "ID : {$name["id"]} Name : {$name['name']} <br>";
//}


//Insert
//var_dump($crud->create("names","name=?", ["Jane Costs"]));

//Update record
//var_dump($crud->update("names","name=? where id=?", ["JANE",4]));

//Delete item
//var_dump($crud->delete("names","where id=?", [6]));


//create table names (
//    id int(11) not null auto_increment primary key,
//    name varchar(255) unique key
//) engine = InnoDb character set = utf8mb4;