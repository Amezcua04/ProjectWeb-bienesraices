<?php

function ConnectDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'root', 'bienesraices_crud');
    if(!$db) {
        echo "Error de conexión";
        exit;
    }

    return $db;
}