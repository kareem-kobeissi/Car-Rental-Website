
<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db = "carritta";
$con = mysqli_connect($sname, $uname, $password, $db);

if (!$con) {
    echo "Connection Failed!";
    exit();
}
?>