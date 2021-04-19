<?php
include 'protect.php';
 if (isset($_REQUEST["class"]) )
 {
     $pupils = $_REQUEST["pupils"];
     $adm_no = $_REQUEST["adm_no"];
     $class = $_REQUEST["class"];
     $date_adm = $_REQUEST["date_adm"];
     $club = $_REQUEST["club"];

     $con = mysqli_connect("localhost","root","","library") or die(mysqli_conect_error['off']);
     $sql ="INSERT INTO `students`(`id`, `pupils`, `adm_no`, `class`, `date_adm`, `club`) VALUES (null,'$pupils','$adm_no','$class','$date_adm','$club')";
     mysqli_query($con,$sql) or die (mysqli_error($con));
 }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>students admission form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body style="background-color: darkseagreen">
<?php include 'navbar.php'?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h4>Add student details</h4>
            <form action="students.php" method="post">
                <div class="form-group">
                    <label>Names</label>
                    <input type="text" class="form-control" name="pupils" required>
                </div>
                <div class="form-group">
                    <label>registration number</label>
                    <input type="number" class="form-control" name="adm_no" required>
                </div>
                <div class="form-group">
                    <label>class</label>
                    <input type="text" class="form-control" name="class" required>
                </div>
                <div class="form-group">
                    <label>date of admission</label>
                    <input type="date" class="form-control" name="date_adm" required>
                </div>
                <div class="form-group">
                    <label>club</label>
                    <input type="text" class="form-control" name="club" required>
                </div>
                <button class="btn btn-success" ">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include 'school_images.php'?>
<footer>
    <div class="col-sm-4">

    </div>
</footer>
</body>
</html>
