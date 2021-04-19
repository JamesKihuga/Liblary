<?php
include 'protect.php';
require 'connect.php';

if (isset($_REQUEST["book_id"]))
{
    $staff_id = $_REQUEST["staff_id"];
    $student_id = $_SESSION["student_id"];
    $book_id = $_SESSION["book_id"];
    $date_issued = date("Y-m-d");
    //save
    foreach ($book_id as $pid){
        $query = "INSERT INTO `issue`(`id`, `staff_id`, `student_id`, `book_id`, `date_issue`)
                                    VALUES (null ,$staff_id,$student_id,$book_id,$date_issued";
        mysqli_query($con, $query) or die(mysqli_error($con));
    }
    //clear cart
    //unset($_SESSION["products"]); //remove
    $_SESSION["books"] = [];
}

if (isset($_GET["id"])) {
    $_SESSION["books"] = array_diff($_SESSION["books"], [$_GET["id"]] ); //[1,2,3] [1] = [2,3]
}
if ( count($_SESSION["books"]) == 0){
    header("location:issue.php");
}
$ids = array_unique($_SESSION["books"]);
//[1, 6, 10] => 1,6,10,100
$data = implode(",", $ids);
$sql = "SELECT * FROM books WHERE id IN($data)";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array

//fetch customers
$sql2 = "SELECT * FROM books";
$result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));// executing the query
$customers = mysqli_fetch_all($result2, 1);//assoc array

mysqli_close($con);//close the connection
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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

            <form action="allow_issue.php" method="post" class="form-inline mt-2 mb-2">
                <div class="form-group">
                    <select name="customer_id" class="form-control">
                        <?php foreach ($issue as $student): ?>
                            <option value="<?=$issue["id"]?>">  <?=$student["names"]?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-info btn-sm ml-2">allow issue</button>
            </form>

            <table class="table table-striped table-bordered">

                <thead>
                <tr>
                    <th>Title</th>
                    <th>subject</th>
                    <th>serial_no</th>
                    <th>cover</th>
                    <th>Remove</th>


                </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $issue): ?>
                    <tr>
                        <td> <?= $issue["title"] ?> </td>
                        <td> <?= $issue["subject"] ?> </td>
                        <td> <?= $issue["serial_no"] ?> </td>
                        <td><img src="<?= $issue['cover'] ?>" width="60" height="40" alt=""></td>

                        <td><a class="btn btn-danger btn-sm" href="delete.php?id=<?= $book_id["id"] ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

</body>
</html>
