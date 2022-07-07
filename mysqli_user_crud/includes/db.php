<?php

    $link = mysqli_connect('localhost', 'root', '', 'mysqli_user_crud');
    if (!$link) {
        echo "Database connection failed";
    }

?>