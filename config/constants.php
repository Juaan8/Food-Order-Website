<?php  
//solution for the add image advertence in "add food"
ob_start();

//Start session
session_start();


//Create constants to Store non repeating Values
define('SITEURL', 'http://localhost/FoodOrderWebSite/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database conection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>