# Conexão e CRUD com PHP usando PDO

### Se quiser ler isto em outras línguas basta clicar aqui

Este código permite interagir com um banco de dados usando PDO – PHP Data Object.

Esta pasta contém os seguintes elementos.

        Database

            | ---  files
                | ---  DatabaseEcxeptions.php
                | ---  Connection.php
                | ---  Crud.php
            | --- index.php
            | --- README.md

**DatabaseExceptions.php:** classe que permitirá trazer os erros caso existam, ela está instanciada nas seguintes classes Crud e Connection.

**Connection.php:** classe que se ocupara de estabelecer a conexão com o banco de dados, caso houver erros quatros tipos de mensagens irão aparecer, sendo eles o nome do arquivo contendo o erro, linha onde se encontra o erro, código do erro e uma mensagem especifica trazendo mais detalhes.

**Crud.php:** nesta classe está todos os métodos para inserir, atualizar, apagar dados. No ficheiro index esta uma demonstração de como instanciar e utilizar os métodos. 
