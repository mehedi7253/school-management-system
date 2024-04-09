<?php
/**
 * Created by PhpStorm.
 * User: mdmeh
 * Date: 7/23/2019
 * Time: 3:17 AM
 */

   //connect with database
    require_once '../php/config.php';
    global $connect;

    //check login
    if(not_logged_in() === TRUE) {
        header('location: student_login.php'); //redirect page
    }

    $userdata = getUserDataByUserId($_SESSION['id']); //get students information using their id.


    // fetch files
    $sql = "SELECT * FROM tbl_files";
    $result = mysqli_query($connect, $sql);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Faculty File</title>
    <link rel="stylesheet" href="../assets/style/bootstrap.css" type="text/css">
    <link rel="icon" href="../images/Logo-Only.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
    <!--Start menu section-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #4267B2">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="view_faculty_file.php" class="nav-link text-white text-capitalize">View Faculty File</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="student_dasboard.php" class="nav-link text-white font-weight-bolder text-uppercase"><span class="mr-3"><img src="../images/<?php echo $userdata['image'] ?>" style="height: 50px; width: 70px; border-radius: 50%"></span><span class="text-white mr-3"><?php echo $userdata['first_name']; ?></span></a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-white font-weight-bold mt-2">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--end menu section-->

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 float-left mt-5 mb-5">
                <div class="col-md-4 float-left col-sm-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Wellcome <span class="float-right text-success"><?php echo $userdata['first_name']; ?></span></h3>
                        </div>
                        <div class="card-body">
                            <a href="student_dasboard.php" class="nav-link card-symbol"><span class="card_view"><i class="fas fa-eye" style="color: green;"></i><span class="ml-3">View Profile</span></span></a>
                            <a href="edit_student_info.php" class="nav-link card-symbol"><i class="fas fa-user-edit" style="color: red"></i><span class="card_view"><span class="ml-3">Update Profile</span></span></a>
                            <a href="changepassword.php" class="nav-link card-symbol"><i class="fas fa-unlock-alt" style="color: rebeccapurple"></i><span class="card_view"><span class="ml-3">Change Password</span></span></a>
                            <a href="change_profile_pic.php" class="nav-link card-symbol"><i class="fas fa-user"></i><span class="card_view"><span class="ml-3">Change profile Picture</span></span></a>
                        </div>
                    </div>
                </div>
                <div class="float-left col-md-8 col-sm-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                             <h3 class="">Your File</h3>
                            <span class="float-right" style="margin-top: -40px">
                                 <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control"  id="myInput" placeholder="Search File.." title="Type in a name">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                 </form>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="myTable">
                                    <thead>
                                    <tr>
                                        <th>File Name</th> 
                                        <th>Teacher Name</th>
                                        <th>Title</th>
                                        <th>Subject</th>
                                        <th>View</th>
                                        <th>Download</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php while($row = mysqli_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo $row['filename']; ?></td>
                                            <td><?php echo $row['fcname']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['subject'];?></td>
                                            <a href="../File%20Upload"></a>
                                            <td><a href="../File%20Upload/uploads/<?php echo $row['filename']; ?>" target="_blank">View<i class="fas fa-eye" style="color: red"></i></a></td>
                                            <td><a href="../File%20Upload/uploads/<?php echo $row['filename']; ?>" download>Download <i class="fas fa-download" style="color: green"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="footer-text col-md-12 col-sm-12">
                    <p class="text-white text-capitalize text-center font-italic p-4">Create By  <strong>@Md.Mehedi Hasan</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <!--        search script-->
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>
</html>

