# Connection and CRUD with PHP using PDO

#### If you want to read this in other languages just click here [Português](https://github.com/DiegoFirmiano/database/blob/master/README.pt.md) |  [En Français](https://github.com/DiegoFirmiano/database/blob/master/README.fr.md)

This code allows you to interact with a database using PDO – PHP Data Object.

This folder contains the following elements.

        Database

            | ---  files
                | ---  DatabaseEcxeptions.php
                | ---  Connection.php
                | ---  Crud.php
            | --- index.php
            | --- README.md

**DatabaseExceptions.php:** class that will allow you to bring errors if any, it is instantiated in the following classes Crud and Connection.

**Connection.php:** class that will take care of establishing the connection with the database, if there are errors, four types of messages will appear, being them the name of the file containing the error, line where the error is found, error code and a specific message bringing more Details.


**Crud.php:** in this class are all methods for inserting, updating, deleting data. In the index file is a demonstration of how to instantiate and use the methods.
