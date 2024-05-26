<?php

    require "libs/functions.php";

    $id = $_GET["id"];

    if(deleteBlog($id)){
        header('Location: admin-blogs.php');
    }else{
        echo "Error deleting blog";
    }



?>