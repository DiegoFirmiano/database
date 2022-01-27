<?php
error_reporting(E_ALL);

require_once "files/DatabaseException.php";
require_once "files/Connection.php";
require_once "files/Crud.php";

//Uncomment the line below to database connection response
//var_dump(Connection::getConnection());


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

$crud = new Crud();
$message = null;

if (isset($_POST["name"])) {

    //fast chek if name is greater than 3 characters
    if (strlen(trim($_POST["name"])) < 3) {
        $message = "Please enter your name";
    } else {


        //Check if value does not exist in database
        if ($crud->read("names", "name", "where name=?", [$_POST["name"]])->rowCount() === 0) {

            //Insert data
            $insert = $crud->create("names", "name=?", [$_POST["name"]]);

            //Check if data has been inserted | $insert["status"] returns bool value  & $insert["lastId"] returns last id inserted
            if (isset($insert["status"])) {
                //Returns successful message and last ID inserted
                $message = "Data has been inserted. the item ID is {$insert["lastId"]}";
            } else {
                //Return insert fail message
                $message = "Sorry, data cannot be inserted";
            }
        } else {
            //Returns message name already exist
            $message = "This name already exist";
        }


    }
}

?>


<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRUD - With PHP</title>
</head>
<body>
<style>
    * {
        box-sizing: border-box;
        padding: 0;
        border: 0;
    }

    .container {
        width: 100%;
        display: flex;
        justify-content: center;
        min-height: 100vh;
        align-items: center;
    }

    @media screen and (max-width: 600px) {
        .inner-container {
            width: 100% !important;
        }
    }

    .inner-container {
        width: 600px;
        padding: 1rem;
    }

    form {
        width: 100%;
        padding: .5rem;
        background: #cccccc;
        display: flex;
        flex-direction: column;
    }

    form div, label {
        width: 100%;
        display: block;
        padding: .5rem;
    }

    input {
        padding: .7rem .3rem;
        width: 100%;
        border: 1px solid darkslateblue;
    }

    button {
        background: darkslateblue;
        color: white;
        border: 0;
        padding: .5rem;
        cursor: pointer;
    }

    ul {
        list-style: none;
        display: block;
        width: 100%;
    }

    ul li {
        display: flex;
        justify-content: space-between;
        padding: .5rem;
        background: #cccccc;
        color: darkslateblue;
        margin: 2px 0;
        align-items: center;
    }

</style>

<div class="container">
    <div class="inner-container">
        <!-- Insert names form -->
        <form method="post" enctype="multipart/form-data">
            <!-- Display errors messages here -->
            <div>
                <?php echo $message ?>
            </div>
            <div class="form-group">
                <label>Insert name</label>
                <input type="text" name="name" placeholder="Ex. John Doe" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

        <hr/>
        <h3>Names</h3>

        <!-- List names -->
        <ul>
            <li> Name 1
                <button>Delete</button>
            </li>
        </ul>
    </div>
</div>
</body>
</html>

