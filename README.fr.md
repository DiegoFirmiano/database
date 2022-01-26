# Connexion et CRUD avec PHP en utilisant PDO

#### Si vous voulez lire ceci dans d'autres langues, cliquez ici

Ce code permet d'interagir avec une base de données à l'aide de PDO – PHP Data Object.

Ce dossier contient les éléments suivants.

        Database

            | ---  files
                | ---  DatabaseEcxeptions.php
                | ---  Connection.php
                | ---  Crud.php
            | --- index.php
            | --- README.md

**DatabaseExceptions.php:** classe qui vous permettra d'afficher les erreurs s'il y en a, elle est instanciée dans les classes suivantes Crud and Connection.

**Connection.php:** classe qui se chargera d'établir la connexion avec la base de données, s'il y a des erreurs quatre types de messages apparaîtront, à savoir le nom du fichier contenant l'erreur, la ligne où se trouve l'erreur, le code d'erreur et un message spécifique apportant plus Des détails.


**Crud.php:** dans cette classe se trouvent toutes les méthodes nécessaires pour la manipulation complète de la base des données comme par exemple l'insertion des données, mise à jour et suppression des éléments. Dans le fichier d'index.php se trouve une démonstration de comment instancier les méthodes.
