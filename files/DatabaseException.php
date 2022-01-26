<?php

class DatabaseException
{


    public static function dbException($error): array
    {
        return [
            "Error code" => $error->getCode(),
            "Error message" => $error->getMessage(),
            "Error file" => $error->getFile(),
            "Error line" => $error->getLine()
        ];
    }
}