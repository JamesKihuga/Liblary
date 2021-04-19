<?php
include 'protect.php';
require 'connect.php';

if (isset($_REQUEST["student_id"])){
    $students_id = $_REQUEST["student_id"];
    $staff_id = $_SESSION["id"];
    $books_id = $_SESSION["books"];
    $date_issue = date("Y-m-d");

    foreach ($students_id as $item){
        $query = "INSERT INTO `issue`(`id`, `staff_id`, `student_id`, `book_id`, `date_issue`) VALUES (null ,'$staff_id','$item','$books_id','$date_issue')";
        mysqli_query($con,$query) or die(mysqli_error($con));
    }
    //unset($_SESSION["books"]); clear all back to issue.
    $_SESSION["books"] = [];

}

if(isset($_GET["id"])){
    $_SESSION["books"] = array_diff($_SESSION["books"],[$_GET["id"]]);
}
if (count($_SESSION["books"]) ==0){
    header("location:issue.php");
}

$ids = array_unique($_SESSION["books"]);
$data = implode(",",$ids);

$sql = "SELECT * FROM books WHERE id IN($data)";
$result = mysqli_query($con, $sql) or die( mysqli_error($con) );
$rows = mysqli_fetch_all($result, 1);//associate the array

$sql2 = "SELECT * FROM students";
$result2 = mysqli_query($con, $sql2) or die( mysqli_error($con) );
$students = mysqli_fetch_all($result2, 1);



mysqli_close($con);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>

<?php include 'navbar.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form action="checkout.php" method="post" class="form-inline">
                <div class="form-group pr-2">
                <select name="student_id" class="form-control btn-sm">
                    <?php foreach ($students as $person): ?>
                        <option value="<?=$person["id"]?>"> <?=$person["pupils"]?></option>
                    <?php endforeach;?>

                </select>
                </div>
                <button class="btn btn-success btn-sm">check out</button>
            </form>

            <table class="table table-striped table-bordered">

                <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Serial_no</th>
                    <th>Cover</th>
                    <th>Remove book</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $books): ?>
                    <tr>
                        <td> <?= $books["title"] ?> </td>
                        <td> <?= $books["subject"] ?> </td>
                        <td> <?= $books["serial_no"] ?> </td>
                        <td> <img src="<?=$books['cover']?>" width="60" height="40" alt=""> </td>
                        <td> <a class="btn btn-danger btn-sm" href="checkout.php?id=<?=$books["id"]?>">remove</a>  </td>
                    </tr>
                <?php endforeach;?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

</body>
</html>
