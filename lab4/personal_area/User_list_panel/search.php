<?php
session_start();
include "../../database/db.php";
include "../../classes/class_user_list.php";
$what_search=$_GET['search'];
$select=$_GET['select'];

$search = mysqli_query($db_phpmyadmin->connect(), "SELECT * FROM `users` WHERE `$select` LIKE '%$what_search%'");
$emparray = array();
    while($row =mysqli_fetch_assoc($search))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);