<?php
if (isset($_GET['id']));

{
    $id = $_GET["id"];
    $con = mysqli_connect('localhost','root','','library')or die (mysqli_connect_error());

 $sql = "DELETE FROM students WHERE (id = $id)";
 mysqli_query($con, $sql) or die (mysqli_error($con));
 mysqli_close($con);
    setcookie('massage','user suspended!', time ()+3);
}
header("location:read.php");

