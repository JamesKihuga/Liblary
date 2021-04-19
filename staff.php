<?php
//include 'protect.php';
if (isset($_REQUEST["email"]) )
{
    $staff_names = $_REQUEST["staff_names"];
    $email = $_REQUEST["email"];
    $reg_no = $_REQUEST["reg_no"];
    $password = $_REQUEST["password"];
    $password = password_hash($password, PASSWORD_BCRYPT);

    $con = mysqli_connect("localhost","root","","library") or die(mysqli_conect_error['off']);
    $sql ="INSERT INTO `staffs`(`id`, `staff_names`, `email`, `reg_no`, `password`) VALUES (null ,'$staff_names','$email','$reg_no','$password')";
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
    <title>staff</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #9fcdff">
<?php include 'navbar.php'?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <h4>Admin details</h4>
            <form action="staff.php" method="post">
                <div class="form-group">
                    <label>Names</label>
                    <input type="text" class="form-control" name="staff_names" required>
                </div>
                <div class="form-group">
                    <label>staff email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>staff reg no</label>
                    <input type="text" class="form-control" name="reg_no" required>
                </div>
                <div class="form-group">
                    <label>Enter password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
</div>



</body>
</html>
