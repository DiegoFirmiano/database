<?php
error_reporting(E_ALL);

require_once "files/DatabaseException.php";
require_once "files/Connection.php";
require_once "files/Crud.php";


//create table names (
//    id int(11) not null auto_increment primary key,
//    name varchar(255) unique key
//) engine = InnoDb character set = utf8mb4;

$crud = new Crud();
$message = null;

//Check form before insert data
if (isset($_POST["insert"])) {

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

//Fetching results from database
$read = $crud->read("names", "*","order by id desc");

//Update data
if (isset($_POST["update"])) {

//ID
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
//Name
    $name = filter_input(INPUT_POST, "name", FILTER_DEFAULT);

//Check if name already exist
    if ($crud->read("names", "name", "where name=? and id !=?", [$name, $id])->rowCount() === 0) {

        //Check update has been done
        if ($crud->update("names", "name=? where id=?", [$name, $id])) {
            $message = "Name has been updated!<br>Refresh page to see last modifications";

        } else {
            $message = "Sorry, error to update name";
        }
    } else {
        $message = "Name already exist";
    }
}

//Deleting data
if (isset($_POST["delete-name"])) {

    //Name ID
    $id = filter_input(INPUT_POST, 'delete-name', FILTER_VALIDATE_INT);

    //Check if values is int
    if ($id) {

        //delete and check if data has been deleted
        if ($crud->delete("names", "where id=?", [$id])) {
            $message = "Name has been deleted!";
            //Reload page to update automatically list
            header("Refresh:0");
        } else {
            $message = "Sorry, fail to delete name";
        }
    } else {
        $message = "Sorry, invalid ID sent";
    }
}

?>


<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css -->
    <link href="styles/app.css" rel="stylesheet">
</head>

<title>CRUD - With PHP</title>
</head>
<body>

<div class="container">
    <div class="inner-container">
        <!-- Display errors messages here -->
        <div class="messages">
            <?php echo $message ?>
        </div>

        <hr style="display: block;" />

        <div class="title-box">
            <h3>Create</h3>
        </div>

        <!-- Insert names form -->
        <form class="insert-form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Enter your name</label>
                <input type="text" name="name" placeholder="Ex. John Doe" required>
                <input type="hidden" name="insert">
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

        <hr/>

        <div class="title-box">
            <h3>Read</h3>
        </div>

        <!-- List names -->
        <ul>
            <?php
            foreach ($read->fetchAll() as $names) {
                echo "<li>{$names["name"]} <div style='display: flex; justify-content: space-between; align-items: center;'><button class='collapse-btn' data-target='collapse-box-{$names["id"]}' style='margin-right: 2px;'>edit</button> <form method='post'>  <input type='hidden' name='delete-name' value='{$names["id"]}'><button type='submit' title='Delete'>Delete</button> </form></div></li>";
                echo "
            <div id='collapse-box-{$names["id"]}' class='collapse-box'>
                    <div class='title-box'>
                        <h3>Update</h3>
                    </div>
                <form class='insert-form' method='post' enctype='multipart/form-data'>
                    <div class='form-group'>
                        <label>Edit </label>
                        <input type='text' name='name' value='{$names["name"]}' required>
                        <input type='hidden' name='id' value='{$names["id"]}'>
                        <input type='hidden' name='update'>
                    </div>
                    <div>
                        <button type='submit'>Update</button>
                    </div>
                </form>
            </div>";
            }
            ?>
        </ul>


        <!-- Click event for display edition form -->
        <script type="text/javascript">
            document.querySelectorAll('.collapse-btn').forEach(btn => btn.addEventListener('click', (e) => {
                document.getElementById(btn.dataset.target).classList.toggle('open');
            }));
        </script>

    </div>
</div>
</body>
</html>

