<?php
session_start();
include_once 'config.php';

$username = $_SESSION['usr_name'];
$user_id = $_SESSION['usr_id'];
$prepassword = $_SESSION['id_password'];
//$postt_id=$_SESSION['postt_id'];
//echo $postt_id;
$error = FALSE;

if (isset($_SESSION['usr_id'])) {
//    $result = mysqli_query($conn, "SELECT * FROM user_info WHERE user_id = '" . $user_id. "' ");
//    if ($row = mysqli_fetch_array($result)) {
//		
//		$_SESSION['usr_gender'] = $row['gender'];
//                $_SESSION['usr_date'] = $row['date_of_birth'];
//                $_SESSION['usr_phone']= $row['phone'];
//		//header("Location: user_profile.php");
//	} else {
//		$errormsg = "Incorrect Email or Password!!!";
//	}

    if (isset($_POST['save_ad'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $district = mysqli_real_escape_string($conn, $_POST['district']);
        $area = mysqli_real_escape_string($conn, $_POST['area']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $rent_type = mysqli_real_escape_string($conn, $_POST['rent_type']);
        $no_of_room = mysqli_real_escape_string($conn, $_POST['no_of_room']);
        $flat_type = mysqli_real_escape_string($conn, $_POST['apt_type']);
        $no_of_wash = mysqli_real_escape_string($conn, $_POST['no_of_wash']);
        $belcony = mysqli_real_escape_string($conn, $_POST['belcony']);
        $vac_mon = mysqli_real_escape_string($conn, $_POST['vac_mon']);
        $rate = mysqli_real_escape_string($conn, $_POST['Rate']);


        if (empty($vac_mon)) {
            $error = true;
            $vac_mon_error = "vac mon error";
        }


        if (empty($title)) {

            $error = true;
            $title_error = " Title error";
        }
        if (empty($address)) {

            $error = true;
            $address_error = " Address error";
        }
        if (!$rate) {

            $error = true;
            $rate_error = "Enter Rent amount";
        }

        if (!$belcony) {

            $error = true;
            $belcony_error = "select no of belcony";
        }

        if (!$no_of_wash) {

            $error = true;
            $no_of_wash_error = "select no of washroom";
        }

        if (!$no_of_room) {

            $error = true;
            $no_of_room_error = "select no of room";
        }

        if (!$district) {

            $error = true;
            $district_error = "select district";
        }
        if (!$area) {

            $error = true;
            $area_error = "select area";
        }
        if (!$rent_type) {

            $error = true;
            $rent_type_error = "select rent type";
        }
        if (!$flat_type) {

            $error = true;
            $flat_type_error = "select flat type";
        }
        if (!$error) {

            if (mysqli_query($conn, "INSERT INTO post_ad(user_id,title,district,area,address,rent_type,no_of_room,flat_type,no_of_wash,belcony,vac_mon,rent,lat,lag) VALUES('" . $user_id . "', '" . $title . "' , '" . $district . "' , '" . $area . "' , '" . $address . "' , '" . $rent_type . "' , '" . $no_of_room . "' , '" . $flat_type . "' , '" . $no_of_wash . "' , '" . $belcony . "','" . $vac_mon . "' , '" . $rate . "',2.021231,3.0122312)")) {
                $successmsg = "Successfully updated! <a href='user_profile.php'>Click here to Login</a>";
            } else {
                $errormsg = "Error in updating ... Please try again later!";
            }
        }
    }
    if (isset($_POST['save_edit_profile'])) {
        $phoneno = mysqli_real_escape_string($conn, $_POST['phone']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $date_0f_birth = date("Y-D-M", strtotime($date));

        if (empty($_POST["gender"])) {

            $error = true;
            $gender_error = "Gender Is Required";
        }
        if (filter_var($phoneno, FILTER_VALIDATE_INT && strlen($phoneno) < 11)) {

            $error = true;
            $phonno_error = "Please Enter Valid Phone Number";
        }
        if ($prepassword == md5($password)) {

            if (strlen($new_password) < 6) {
                $error = true;
                $password_error = "Password must be minimum of 6 characters";
            }
            if ($new_password != $cpassword) {
                $error = true;
                $cpassword_error = "Password and Confirm Password doesn't match";
            }
            if (!$error) {

                if (mysqli_query($conn, "INSERT INTO user_info(user_id,gender,date_of_birth,phone) VALUES('" . $user_id . "', '" . $gender . "', '" . $date_0f_birth . "','" . $phoneno . "')") && mysqli_query($conn, "UPDATE users SET password='" . md5($new_password) . "' WHERE user_id='" . $user_id . "'")) {
                    $successmsg = "Successfully updated! <a href='user_profile.php'>Click here to Login</a>";
                } else {
                    $errormsg = "Error in updating ... Please try again later!";
                }
            }
        } else {
            $password_error = "Wrong Password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Profile</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />

        <style>

            body { background:#ffffff;}

            /*nav css*/
            .navbar-inverse {background-color: #ffffff;border-radius: 0px;height:80px;width:100%;position: fixed;z-index: 999;border: 0px solid;
                             -webkit-box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);transition:all ease 0.8s;
                             -moz-box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);
                             box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);}
            .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus {
                color:rgb(0, 4, 51) !important;background-color: #0e364c;}
            .navbar-brand {padding: 0;margin-left: 0px !important;}
            .navbar-brand img { height:50px;margin-left: 20px;margin-top: 9%;transition:all ease 0.8s;}
            .navbar-inverse .navbar-nav>li>a {color:rgb(144, 195, 212);font-family: 'Open Sans', sans-serif; line-height:3;font-weight: bold;}
            .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus {color:rgb(0, 4, 51) !important;}
            .menu { display:none;}
            .search-box1 {padding: 20px 0px;z-index: 99999;width: 100%;}
            .search {padding: 30px 0px;float: left;width: 100%;}
            .serach-footer {left: 20px;position: absolute;top: 10px;}
            .search-wrap {display: block;width: 100%;height: 40px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;
                          background-image: none;border: 1px solid #e2e2e2;border-radius: 20px;
                          -webkit-box-shadow: inset 0 0px 0px rgba(0,0,0,.075);
                          box-shadow: inset 0 0px 0px rgba(0,0,0,.075);
                          -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                          -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                          transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                          width: 100% !important;padding-left: 45px;}
            .search-btn {background:rgb(0, 4, 51);
                         width: 100%;border-radius: 0px 20px 20px 0px;color: #fff !important;height: 40px;border: 0px solid;font-weight: 600;font-size: 14px;}
            .search-btn:hover, .search-btn:focus {background:rgb(0, 4, 51);color: #fff !important;}
            .modal-dialog {width: 90% !important;margin: 20% auto;}
            .modal-content { background-color:rgb(144, 195, 212);}
            .modal-title {color: #ffffff !important;}



            /*nav css close*/




            .page-header {background:#ccc;margin:0;}

            .profile-head { width:100%;background-color: rgb(144, 195, 212);float: left;padding: 15px 5px;}
            .profile-head img { height:150px; width:150px; margin:0 auto; border:5px solid #fff; border-radius:5px;}
            .profile-head h5 {width: 100%;padding:5px 5px 0px 5px;text-align:justify;font-weight: bold;color: #fff;font-size: 25px;text-transform:capitalize;
                              margin-bottom: 0;}
            .profile-head p {width: 100%;text-align: justify;padding:0px 5px 5px 5px;color: #fff;font-size:17px;text-transform:capitalize;margin:0;}
            .profile-head a {width: 100%;text-align: center;padding: 10px 5px;color: #fff;font-size: 15px;text-transform: capitalize;}

            .profile-head ul { list-style:none;padding: 0;}
            .profile-head ul li { display:block; color:#ffffff;padding:5px;font-weight: 400;font-size: 15px;}
            .profile-head ul li:hover span { color:rgb(0, 4, 51);}
            .profile-head ul li span { color:#ffffff;padding-right: 10px;}
            .profile-head ul li a { color:#ffffff;}
            .profile-head h6 {width: 100%;text-align: center;font-weight: 100;color: #fff;font-size: 15px;text-transform: uppercase;margin-bottom: 0;}


            .nav-tabs {margin: 0;padding: 0;border: 0;}
            .nav-tabs > li > a {background: #DADADA;border-radius: 0;
                                box-shadow: inset 0 -8px 7px -9px rgba(0,0,0,.4),-2px -2px 5px -2px rgba(0,0,0,.4);}
            .nav-tabs > li.active > a,
            .nav-tabs > li.active > a:hover {background: #F5F5F5;
                                             box-shadow: inset 0 0 0 0 rgba(0,0,0,.4),-2px -3px 5px -2px rgba(0,0,0,.4);}
            .tab-pane {background: #ffffff;box-shadow: 0 0 4px rgba(0,0,0,.4);border-radius: 0;text-align: center;padding: 10px;}
            .tab-content>.active {margin-top:50px;/*width:100% !important;*/} 

            /* edit profile css*/

            .hve-pro {    background-color:rgb(144, 195, 212);padding: 5px; width:100%; height:auto;float:left;}
            .hve-pro p {float: left;color:#fff;font-size: 15px;text-transform: capitalize;padding: 5px 20px;font-family: 'Noto Sans', sans-serif;}
            h2.register { padding:10px 25px; text-transform:capitalize;font-size: 25px;color: rgb(144, 195, 212);}
            .fom-main { overflow:hidden;}

            legend {font-family: 'Bitter', serif;color:#ff3200;border-bottom:0px solid;}
            .main_form {background-color: rgb(144, 195, 212);}
            label.control-label {font-family: 'Noto Sans', sans-serif;font-weight: 100; margin-bottom:5px !important; 
                                 text-align:left !important; text-transform:uppercase; color:#798288;}
            .submit-button {color: #fff;background-color:rgb(144, 195, 212);width:190px;border: 0px solid;border-radius: 0px; transition:all ease 0.3s;margin: 5px;
                            float:left;}
            .submit-button:hover, .submit-button:focus {color: #fff;background-color:rgb(0, 4, 51);}
            .hint_icon {color:#ff3200;}
            .form-control:focus {border-color: #ff3200;}
            select.selectpicker { color:#99999c;}
            select.selectpicker option { color:#000 !important;}
            select.selectpicker option:first-child { color:#99999c;}
            .input-group { width:100%;}
            .uplod-picture {width: 100%; background-color:rgb(144, 195, 212);color: #fff; padding:20px 10px;margin-bottom:10px;}
            .uplod-file {position: relative;overflow: hidden;color: #fff;background-color: rgb(0, 4, 51);border: 0px solid #a02e09;border-radius: 0px;
                         transition:all ease 0.3s;margin: 5px;}
            .uplod-file input[type=file] {position: absolute;top: 0;right: 0;min-width: 100%;min-height: 100%;font-size: 100px;text-align: right;
                                          filter: alpha(opacity=0);opacity: 0;outline: none;background: white;cursor: inherit;display: block;}
            .uplod-file:hover, .uplod-file:focus {color: #fff;background-color:rgb(144, 195, 212);}
            h4.pro-title { font-size:24px; color:rgba(0, 4, 51, 0.96); text-transform:capitalize; text-align:justify;padding: 10px 15px;font-family: 'Bitter', serif;}
            .bio-table { width:75%;border:0px solid;}
            .bio-table td {text-transform: capitalize;text-align: left;font-size: 15px;}
            .bio-table>tbody>tr>td { border:0px solid;text-transform: capitalize;color: rgb(0, 4, 51); font-size:15px;}
            .responsiv-table { border:0px solid;}
            .nav-menu li a {margin: 5px 5px 5px 5px;position: relative;display: block;padding: 10px 50px;border: 0px solid !important;box-shadow: none !important;
                            background-color: rgb(0, 4, 51) !important;color: #fff !important;    white-space: nowrap;}
            .nav-menu li.active a {background-color: rgb(144, 195, 212) !important;}
            .stick{position:fixed !important;top:0;z-index:999 !important;width:100%;background:#ffffff !important;height:auto; transition:all ease 0.8s;
                   -webkit-box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);
                   -moz-box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);
                   box-shadow: 0px 2px 7px 0px rgba(0,0,0,0.75);}
            .stick a { line-height:20px !important;}
            .stick img { margin:0 !important;}



            @media all and (max-width:768px){

                .navbar-inverse .drop_menu {display: block;visibility: visible;width: 110px;height:1000px;padding:0px 20px;position: absolute;right:-100px;
                                            transition:all ease 0.5s;border-top: 0px solid;cursor: pointer;}
                .navbar-brand {padding: 0;margin-left: 10px !important;}
                a.menu { display:block !important;margin: 9px 2px;float: right;color: rgba(255, 102, 0, 0.98); border:0px solid; background:none; font-size:30px;width:27px;position: relative;
                         cursor:pointer;}
                a.menu:hover, a.menu:focus { color:rgb(0, 4, 51);}

                .drop_menu1 { display: block;visibility: visible;width:250px;height:1000px;padding:5px 30px;position: absolute;right:0 !important;
                              background-color:#ffffff !important; transition:all ease 0.5s;border-top: 0px solid;cursor: pointer;}

            }

            @media all and (max-width:430px){
                .profile-head ul li {font-size: 12px !important;}
                .nav-menu li { width:50%;}
                .bio-table>tbody>tr>td {font-size: 13px;}

            }

        </style>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
        <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css"
              rel="stylesheet" type="text/css" />

    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">Rent A House</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['usr_id'])) { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> 
                                    <strong><?php echo $username; ?></strong>
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                                <ul style="background-color:white;" class="dropdown-menu">
                                    <li>
                                        <div class="navbar-login">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p class="text-center">
                                                        <span class="glyphicon glyphicon-user icon-size"></span>
                                                    </p>
                                                </div>
                                                <div class="col-lg-8">
                                                    <p class="text-left"><strong><?php
                                                            // $username=$_SESSION['usr_name'];
                                                            echo $username;
                                                            ?></strong></p>

                                                    <p class="text-left">
                                                        <a href="user_profile.php" class="btn btn-primary btn-block btn-sm">Profile</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="navbar-login navbar-login-session">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>
                                                        <a href="logout.php" class="btn btn-danger btn-block">Sign Out</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                                        <!--<li><a class="navbar-text" href="user_profile.php">Signed in as <?php //echo $_session['name'];    ?></a></li>
                                            <li><a href="logout.php">Log Out</a></li>-->
                        <?php } else { ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Sign Up</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <section>

            <div class="container" style="margin-top: 30px;">
                <div class="profile-head">



                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <a href="user_profile.php" > <h5><?php echo $username; ?></h5></a>


                    </div>
                </div><!--profile-head close-->
            </div><!--container close-->


            <div id="sticky" class="container">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-menu" role="tablist">
                    <li class="active">
                        <a href="#profile" role="tab" data-toggle="tab">
                            <i class="fa fa-male"></i> Profile
                        </a>
                    </li>
                    <li><a href="#editprofile" role="tab" data-toggle="tab">
                            <i class="fa fa-key"></i> Edit Profile
                        </a>
                    </li>
                    <li>
                        <a href="#postadd" role="tab" data-toggle="tab">
                            <i class=" "></i> Post To-let
                        </a>
                    </li>
                    <li><a href="#timeline" role="tab" data-toggle="tab">
                            <i class="fa fa-key"></i> Timeline
                        </a>
                    </li>
                    <li><a href="#inbox" role="tab" data-toggle="tab">
                            <i class="fa fa-key"></i> Inbox
                        </a>
                    </li>
                </ul><!--nav-tabs close-->

                <!-- Tab panes -->
                <div class="tab-content">


                    <!--inbox-->

                    <div class="tab-pane fade" id="inbox">
                        <div class="container fom-main">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="register">Inbox</h2>
                                </div><!--col-sm-12 close-->

                            </div><!--row close-->
                            <br />
                            <div class="row">

                                <form class="form-horizontal main_form text-left" action=" " method="post"  id="contact_form">
                                    <fieldset>
                                        <div class="table-responsive responsiv-table">
                                            <table class="table bio-table" >
                                                <tbody>
                                                    <?php
                                                    echo "<tr>
    
                      <th> From</th>
                      <th> Message</th>
                      
                      </tr>";
                                                    $result = mysqli_query($conn, "SELECT from_user_id,message FROM user_message WHERE user_id = '" . $user_id . "' ");

//$row= mysqli_fetch_assoc($result);
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        echo "<tr>";
                                                        echo "<form action='full_post.php' method='post'>";

                                                        echo "<td>" . $row['from_user_id'] . "</td>";
                                                        echo "<td>" . $row['message'] . "</td>";

                                                        //echo "<td><input type='hidden' value='' name='postid'/></td>";
                                                        //echo "<td><span class=right><a href='#view_more?id=$postt_id'>[edit]</a> </td>";
                                                        //echo "<td><input type='submit' name='postid' value='View' class='btn btn-info btn-lg' data-toggle='modal' data-target='full_post.php' /></td>";
                                                        echo "</form>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    </fieldset>
                                </form>
                            </div><!--row close-->
                        </div><!--container close -->          
                    </div><!--tab-pane close-->

                    <!--Prifile-->

                    <div class="tab-pane fade active in" id="profile">
                        <div class="container">
                            <br clear="all" />
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="pro-title">Bio Graph</h4>
                                </div><!--col-md-12 close-->


                                <div class="col-md-6">

                                    <div class="table-responsive responsiv-table">
                                        <table class="table bio-table">
                                            <tbody>
                                                <tr>      
                                                    <td>Name</td>
                                                    <td>:<?php echo "    " . $username; ?> </td> 
                                                </tr>

                                                <tr>    
                                                    <td>Email</td>
                                                    <td>: <?php
                                                        $email_no = $_SESSION['email_id'];
                                                        echo " " . $email_no;
                                                        ?></td>       
                                                </tr>
                                                <tr>    
                                                    <td>Gender</td>
                                                    <td>:<?php
                                                        $result = mysqli_query($conn, "SELECT gender FROM user_info WHERE user_id = '" . $user_id . "' ");
                                                        $row = mysqli_fetch_array($result);
                                                        $usr_gender = $row['gender'];
                                                        if (empty($usr_gender)) {
                                                            $usr_gender = ' ';
                                                        }
                                                        echo $usr_gender;
                                                        ?>
                                                    </td>       
                                                </tr>
                                                <tr>
                                                    <td>Phone NO</td>
                                                    <td>: <?php
                                                        $result = mysqli_query($conn, "SELECT phone FROM user_info WHERE user_id = '" . $user_id . "' ");
                                                        $row = mysqli_fetch_array($result);
                                                        $usr_phone = $row['phone'];
                                                        // $usr_phone=$_SESSION['usr_phone'];
                                                        if (empty($usr_phone)) {
                                                            $usr_phone = " ";
                                                        }
                                                        echo " " . $usr_phone;
                                                        ?> </td> 
                                                </tr>
                                                <tr>
                                                    <td>Date Of Birth</td>
                                                    <td>:<?php
                                                        $result = mysqli_query($conn, "SELECT date_of_birth FROM user_info WHERE user_id = '" . $user_id . "' ");
                                                        // $usr_date=$_SESSION['usr_date'];
                                                        $row = mysqli_fetch_array($result);
                                                        $usr_date = $row['date_of_birth'];
                                                        if (empty($usr_date)) {
                                                            $usr_date = '';
                                                        }
                                                        echo " " . $usr_date;
                                                        ?> </td> 
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div><!--table-responsive close-->
                                </div><!--col-md-6 close-->
                            </div><!--row close-->




                        </div><!--container close-->
                    </div><!--tab-pane close-->

                    <!--Timeline-->


                    <div class="tab-pane fade" id="timeline">
                        <div class="container fom-main">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="register">Timeline</h2>
                                </div><!--col-sm-12 close-->

                            </div><!--row close-->
                            <br />
                            <div class="row">

                                <form class="form-horizontal main_form text-left" action="full_post.php " method="post"  id="contact_form">
                                    <fieldset>
                                        <div class="table-responsive responsiv-table">

                                            <table class="table bio-table" >
                                                <tbody>
                                                    <?php
                                                    echo "<tr>

                      <th> Title</th>
                      <th> District</th>
                      <th> Area</th>
                      <th> Address</th>
                      <th> Vaccant From</th>
                      <th> Rent </th>
                      <th> Details </th>
                      </tr>";
                                                    $result = mysqli_query($conn, "SELECT post_id,title,district,area,address,vac_mon,rent FROM post_ad WHERE user_id = '" . $user_id . "' ");

//$row= mysqli_fetch_assoc($result);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $p_id = $row['post_id'];
                                                        echo "<tr>";
                                                        echo "<form action='home.php' method='post'>";

                                                        echo "<td>" . $row['title'] . "</td>";
                                                        echo "<td>" . $row['district'] . "</td>";
                                                        echo "<td>" . $row['area'] . "</td>";
                                                        echo "<td >" . $row['address'] . "</td>";
                                                        echo "<td>" . $row['vac_mon'] . "</td>";
                                                        echo "<td>" . $row['rent'] . "</td>";
                                                        echo "<td><input type='hidden' value='$p_id' name='postid'/></td>";
                                                        //echo "<td><span class=right><a href='#view_more?id=$p_id' target='_self'>[edit]</a> </td>";
                                                        echo "<td><input type='submit' name='postid' value='$p_id' class='btn btn-info btn-lg' data-toggle='modal' data-target='#view_more' /></td>";
                                                        echo "</form>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    </fieldset>
                                </form>
                            </div><!--row close-->
                        </div><!--container close -->          
                    </div><!--tab-pane close-->


                    <div id="confirm" class="modal fade in" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content row">
                                <div class="modal-header custom-modal-header">
                                    <button type="button" value="" class="close" data-dismiss="modal">×</button>
                                    <h4 class="modal-title">Confirm Delete</h4>
                                </div>
                                <div class="modal-body">
                                    <form name="info_form" class="form-inline" action="#" method="post">



                                        <div class="form-group col-md-10">
                                            <div class="col-md-6">
                                                <button type="submit" name="delete_ad" class="btn btn-warning submit-button" >Confirm Delete</button>
                                                <button type="submit" class="btn btn-warning submit-button" class="close" data-dismiss="modal">Cancel</button>

                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                    <?php
                    if (isset($_POST['delete_ad'])) {
                        if (mysqli_query($conn, "DELETE FROM post_ad WHERE user_id='" . $user_id . "' AND post_id='" . $post_id . "' ")) {
                            mysqli_affected_rows($conn);
                            header("Location: home.php");
                        }
                    }
                    ?>        


                    <!--edit profile-->


                    <div class="tab-pane fade" id="editprofile">
                        <div class="container fom-main">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="register">Edit Your Profile</h2>
                                </div><!--col-sm-12 close-->

                            </div><!--row close-->
                            <br />
                            <div class="row">

                                <form class="form-horizontal main_form text-left" action=" " method="post"  id="contact_form">
                                    <fieldset>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">Name</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input value="<?php echo $username; ?>" name="name" placeholder="Name" class="form-control"  type="text" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Text input-->

                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">E-Mail</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input value="<?php echo $email_no; ?>" name="email" placeholder="E-Mail Address" class="form-control"  type="text" disabled>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Text input-->

                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">Phone #</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input name="phone" required value="<?php if ($error) echo $phoneno; ?>" placeholder="+880" class="form-control" type="text">
                                                    <span class="text-danger"><?php if (isset($phonno_error_error)) echo $phonno_error_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">Date Of Birth</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input name="date" placeholder=" " required value="<?php if ($error) echo $date_0f_birth ?>" data-date-inline-picker="false" data-date-open-on-focus="true" class="form-control" type="date">
                                                    <span class="text-danger"><?php if (isset($date_of_birth_error)) echo $date_0f_birth_error; ?></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">Password</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input  name="password" placeholder="Password" class="form-control"  type="password">
                                                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">New Password</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input  type="password" name="new_password" placeholder="password" class="form-control" >
                                                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">Confirm Password</label>  
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                                                    <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label">Gender</label>
                                            <div class="col-md-6">
                                                <div class="radio col-md-2">
                                                    <label>
                                                        <input type="radio" name="gender" value="Male" required value=" <?php if ($error) echo $gender ?>"/> Male
                                                        <span class="text-danger"><?php if (isset($gender_error)) echo $gender_error; ?></span>
                                                    </label>
                                                </div>
                                                <div class="radio col-md-2">
                                                    <label>
                                                        <input type="radio" name="gender" value="Female" required value=" <?php if ($error) echo $gender ?>"/> Female
                                                        <span class="text-danger"><?php if (isset($gender_error)) echo $gender_error; ?></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-10">
                                            <div class="col-md-6">
                                                <button type="submit" name="save_edit_profile" class="btn btn-warning submit-button" >Save</button>
                                                <button type="submit" name="cancel" class="btn btn-warning submit-button" >Cancel</button>

                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!--row close-->
                        </div><!--container close -->          
                    </div><!--tab-pane close-->


                    <!--Post ADD-->


                    <div class="tab-pane fade" id="postadd">
                        <div class="container fom-main">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2 class="register">Post Your AD</h2>
                                </div><!--col-sm-12 close-->

                            </div><!--row close-->
                            <br />
                            <div class="row">

                                <form class="form-horizontal main_form text-left" action=" " method="post"  id="contact_form">
                                    <fieldset>

                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label" >Title</label> 
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input name="title" placeholder="Title" class="form-control"  type="text">
                                                    <span class="text-danger"><?php if (isset($title_error)) echo $title_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">District</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="district" class="form-control selectpicker" >
                                                        <option >select district</option>
                                                        <option > Select District</option>
                                                        <option value="Bagerhat">Bagerhat</option>
                                                        <option value="Barisal">Barisal</option>
                                                        <option value="Barisal">Barguna</option>
                                                        <option value="Barguna">Bandarban</option>
                                                        <option value="Bhola">Bhola</option>
                                                        <option value="Bogra">Bogra</option>
                                                        <option value="Brahmanbaria">Brahmanbaria</option>
                                                        <option value="Chadpur">Chadpur</option>
                                                        <option value="Chapai Nawabganj">Chapai Nawabganj</option>
                                                        <option value="Chawmuhani">Chawmuhani</option>
                                                        <option value="Chittagong">Chittagong</option>
                                                        <option value="Chuadanga">Chuadanga</option>
                                                        <option value="Comilla">Comilla</option>
                                                        <option value="Cox’s Bazar">Cox’s Bazar</option>
                                                        <option value="Dawlatpur">Dawlatpur</option>
                                                        <option value="Dhaka">Dhaka</option>
                                                        <option value="Dinajpur">Dinajpur</option>
                                                        <option value="Faridpur">Faridpur</option>
                                                        <option value="Feni">Feni</option>
                                                        <option value="Gaibanda">Gaibanda</option>
                                                        <option value="Gopalganj">Gopalganj</option>
                                                        <option value="Habiganj">Habiganj</option>
                                                        <option value="Ishwardi">Ishwardi</option>
                                                        <option value="Jamalpur">Jamalpur</option>
                                                        <option value="Jessore">Jessore</option>
                                                        <option value="Jhalakathi">Jhalakathi</option>
                                                        <option value="Jhenaidah">Jhenaidah</option>
                                                        <option value="Joydebpur">Joydebpur</option>
                                                        <option value="Joypurhat">Joypurhat</option>
                                                        <option value="Kaptai">Kaptai</option>
                                                        <option value="Khargrachhari">Khargrachhari</option>
                                                        <option value="Khulna">Khulna</option>
                                                        <option value="Kishoregonj">Kishoregonj</option>
                                                        <option value="Kurigram">Kurigram</option>
                                                        <option value="Kushtia">Kushtia</option>
                                                        <option value="Madaripur">Madaripur</option>
                                                        <option value="Manikgonj">Manikgonj</option>
                                                        <option value="Maijdee">Maijdee</option>
                                                        <option value="Meherpur">Meherpur</option>
                                                        <option value="Mirzapur">Mirzapur</option>
                                                        <option value="Mongla">Mongla</option>
                                                        <option value="Moulvi-Bazar">Moulvi-Bazar</option>
                                                        <option value="Mymensingh">Mymensingh</option>
                                                        <option value="Narail">Narail</option>
                                                        <option value="Narshingdi">Narshingdi</option>
                                                        <option value="Natore">Natore</option>
                                                        <option value="Netrokona">Netrokona</option>
                                                        <option value="Nilfamari">Nilfamari</option>
                                                        <option value="Noakhali">Noakhali</option>
                                                        <option value="Pabna">Pabna</option>
                                                        <option value="Panchagar">Panchagar</option>
                                                        <option value="Rajshahi">Rajshahi</option>
                                                        <option value="Rangamati">Rangamati</option>
                                                        <option value="Rangpur">Rangpur</option>
                                                        <option value="Satkhira">Satkhira</option>
                                                        <option value="Shantahar">Shantahar</option>
                                                        <option value="Shariatpur">Shariatpur</option>
                                                        <option value="Sherpur">Sherpur</option>
                                                        <option value="Sirajgong">Sirajgong</option>
                                                        <option value="Shrimongal">Shrimongal</option>
                                                        <option value="Sunamgonj">Sunamgonj</option>
                                                        <option value="Sylhet">Sylhet</option>
                                                        <option value="Tangail">Tangail</option>
                                                        <option value="Thakurgaon">Thakurgaon</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($district_error)) echo $district_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Area</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="area" class="form-control selectpicker" >
                                                        <option >Select Area</option>
                                                        <option value="Mohammadpur">Mohammadpur</option>
                                                        <option value="Dhanmondi">Dhanmondi</option>
                                                        <option value="Gulsan">Gulsan</option>
                                                        <option value="Uttara">Uttara</option>

                                                        <!--Bagerhat-->
                                                        <option value="Mollahat">Mollahat</option>
                                                        <option value="Fakirhat">Fakirhat</option>
                                                        <option value="Kochua">Kochua</option>
                                                        <option value="Kachikata">Kachikata</option>
                                                        <option value="Morrelganj">Morrelganj</option>
                                                        <!--Barisal-->
                                                        <option value="Rajarchar">Rajarchar</option>
                                                        <option value="Kazipara">Kazipara</option>
                                                        <option value="Billabari">Billabari</option>
                                                        <option value="Rajarchar">Rajarchar</option>
                                                        <option value="Kashipur">Kashipur</option>
                                                        <!--Barguna-->
                                                        <option value="Phuljhuri">Phuljhuri</option>
                                                        <option value="Betagi">Betagi</option>
                                                        <option value="Kashipur">Kashipur</option>
                                                        <option value="Kathalia">Kathalia</option>
                                                        <option value="Dhalua">Dhalua</option>
                                                        <!--Bandarban-->
                                                        <option value="Ruma">Ruma</option>
                                                        <option value="Thanchi">Thanchi</option>
                                                        <option value="Alikadam">Alikadam</option>
                                                        <option value="Ssingpa">Ssingpa</option>
                                                        <option value="Barpara">Barpara</option>
                                                        <!--Bhola-->
                                                        <option value="Lalmohon">Lalmohon</option>
                                                        <option value="Char Fasson">Char Fasson</option>
                                                        <option value="Dular Hat">Dular Hat</option>
                                                        <option value="Sharifpara">Sharifpara</option>
                                                        <!--Bogra-->
                                                        <option value="Jahurul Nagar">Jahurul Nagar</option>
                                                        <option value="Sobujbag">Sobujbag</option>
                                                        <option value="Jamil Nagar">Jamil Nagar</option>
                                                        <option value="Thanthania">Thanthania</option>
                                                        <option value="Khandar">Khandar</option>
                                                        <!--Brahmanbaria-->
                                                        <option value="Bijoynagar">Bijoynagar</option>
                                                        <option value="area">Sreerampur</option>
                                                        <option value="Sreerampur">Akhaura</option>
                                                        <option value="Moind">Moind</option>
                                                        <option value="Bakail">Bakail</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($area_error)) echo $area_error; ?></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label" >Address</label> 
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <textarea name="address" rows="2" cols="155" placeholder="house,road,sector,post code etc"></textarea>
                                                    <span class="text-danger"><?php if (isset($address_error)) echo $addrss_error; ?></span>
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Rent Type</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="rent_type" class="form-control selectpicker" >
                                                        <option>Select Type</option>
                                                        <option value="Appartment">Appartment</option>
                                                        <option value="Room">Room</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($rent_type_error)) echo $rent_type_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Number Of Room</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="no_of_room" class="form-control selectpicker" >
                                                        <option >Select Number Of Room</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($no_of_room_error)) echo $no_of_room_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Number Of Bathroom</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="no_of_wash" class="form-control selectpicker" >
                                                        <option >Select Number Of Bathroom</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($no_of_wash_error)) echo $no_of_wash_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Number Of Belcony</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="belcony" class="form-control selectpicker" >
                                                        <option >Select Number Of Belcony</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($belcony_error)) echo $belcony_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Appertment Type</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="apt_type" class="form-control selectpicker" >
                                                        <option  >Select </option>
                                                        <option value="Family">Family</option>
                                                        <option value="Bechalor">Bechalor</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($flat_type_error)) echo $flat_type_error; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12"> 
                                            <label class="col-md-10 control-label">Vacancy From</label>
                                            <div class="col-md-12 selectContainer">
                                                <div class="input-group">
                                                    <select name="vac_mon" class="form-control selectpicker" >
                                                        <option  >Select Month</option>
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                    <span class="text-danger"><?php if (isset($vac_mon_error)) echo $vac_mon_error; ?></span>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Text input-->

                                        <div class="form-group col-md-12">
                                            <label class="col-md-10 control-label" >Rate</label> 
                                            <div class="col-md-12 inputGroupContainer">
                                                <div class="input-group">
                                                    <input name="Rate" placeholder="Rate" class="form-control"  type="text">
                                                    <span class="text-danger"><?php if (isset($rate_error)) echo $rate_error; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button -->
                                        <div class="form-group col-md-10">
                                            <div class="col-md-6">
                                                <button type="submit" name="save_ad" class="btn btn-warning submit-button" >Save</button>
                                                <button type="submit" class="btn btn-warning submit-button" >Cancel</button>

                                            </div>
                                        </div>


                                    </fieldset>
                                </form>
                            </div><!--row close-->
                        </div><!--container close -->          
                    </div><!--tab-pane close-->

                </div><!--tab-content close-->
            </div><!--container close-->

        </section><!--section close-->



        <script>
            //tab js//
            $(document).ready(function (e) {


                $('.form').find('input, textarea').on('keyup blur focus', function (e) {

                    var $this = $(this),
                            label = $this.prev('label');

                    if (e.type === 'keyup') {
                        if ($this.val() === '') {
                            label.removeClass('active highlight');
                        } else {
                            label.addClass('active highlight');
                        }
                    } else if (e.type === 'blur') {
                        if ($this.val() === '') {
                            label.removeClass('active highlight');
                        } else {
                            label.removeClass('highlight');
                        }
                    } else if (e.type === 'focus') {

                        if ($this.val() === '') {
                            label.removeClass('highlight');
                        } else if ($this.val() !== '') {
                            label.addClass('highlight');
                        }
                    }

                });

                $('.tab a').on('click', function (e) {

                    e.preventDefault();

                    $(this).parent().addClass('active');
                    $(this).parent().siblings().removeClass('active');
                    target = $(this).attr('href');

                    $('.tab-content > div').not(target).hide();

                    $(target).fadeIn(600);

                });
                //canvas off js//
                $('#menu_icon').click(function () {
                    if ($("#content_details").hasClass('drop_menu'))
                    {
                        $("#content_details").addClass('drop_menu1').removeClass('drop_menu');
                    } else {
                        $("#content_details").addClass('drop_menu').removeClass('drop_menu1');
                    }


                });

                //search box js//


                $("#flip").click(function () {
                    $("#panel").slideToggle("5000");
                });

                // sticky js//

                $(window).scroll(function () {
                    if ($(window).scrollTop() >= 500) {
                        $('nav').addClass('stick');
                    } else {
                        $('nav').removeClass('stick');
                    }
                });




            });

        </script>
    </body>
</html>