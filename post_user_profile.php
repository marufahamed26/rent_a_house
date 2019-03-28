<?php
session_start();
include_once 'config.php';
if (isset($_SESSION['usr_name'])) {
    $username = $_SESSION['usr_name'];
}
if (isset($_SESSION['usr_id'])) {
    $user_id = $_SESSION['usr_id'];
}
if (isset($_SESSION['id_password'])) {
    $prepassword = $_SESSION['id_password'];
}
$p_name = $_SESSION['name'];
$p_user_id = $_SESSION['post_user_id'];

$error = FALSE;
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
            .navbar-inverse .navbar-nav>li>a {color:rgb(255, 102, 0);font-family: 'Open Sans', sans-serif; line-height:3;font-weight: bold;}
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
            .modal-content { background-color:rgb(255, 102, 0);}
            .modal-title {color: #ffffff !important;}



            /*nav css close*/




            .page-header {background:#ccc;margin:0;}

            .profile-head { width:100%;background-color: rgb(255, 102, 0);float: left;padding: 15px 5px;}
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

            .hve-pro {    background-color:rgb(255, 102, 0);padding: 5px; width:100%; height:auto;float:left;}
            .hve-pro p {float: left;color:#fff;font-size: 15px;text-transform: capitalize;padding: 5px 20px;font-family: 'Noto Sans', sans-serif;}
            h2.register { padding:10px 25px; text-transform:capitalize;font-size: 25px;color: rgb(255, 102, 0);}
            .fom-main { overflow:hidden;}

            legend {font-family: 'Bitter', serif;color:#ff3200;border-bottom:0px solid;}
            .main_form {background-color: rgb(255, 102, 0);}
            label.control-label {font-family: 'Noto Sans', sans-serif;font-weight: 100; margin-bottom:5px !important; 
                                 text-align:left !important; text-transform:uppercase; color:#798288;}
            .submit-button {color: #fff;background-color:rgb(255, 102, 0);width:190px;border: 0px solid;border-radius: 0px; transition:all ease 0.3s;margin: 5px;
                            float:left;}
            .submit-button:hover, .submit-button:focus {color: #fff;background-color:rgb(0, 4, 51);}
            .hint_icon {color:#ff3200;}
            .form-control:focus {border-color: #ff3200;}
            select.selectpicker { color:#99999c;}
            select.selectpicker option { color:#000 !important;}
            select.selectpicker option:first-child { color:#99999c;}
            .input-group { width:100%;}
            .uplod-picture {width: 100%; background-color:rgb(255, 102, 0);color: #fff; padding:20px 10px;margin-bottom:10px;}
            .uplod-file {position: relative;overflow: hidden;color: #fff;background-color: rgb(0, 4, 51);border: 0px solid #a02e09;border-radius: 0px;
                         transition:all ease 0.3s;margin: 5px;}
            .uplod-file input[type=file] {position: absolute;top: 0;right: 0;min-width: 100%;min-height: 100%;font-size: 100px;text-align: right;
                                          filter: alpha(opacity=0);opacity: 0;outline: none;background: white;cursor: inherit;display: block;}
            .uplod-file:hover, .uplod-file:focus {color: #fff;background-color:rgb(255, 102, 0);}
            h4.pro-title { font-size:24px; color:rgba(0, 4, 51, 0.96); text-transform:capitalize; text-align:justify;padding: 10px 15px;font-family: 'Bitter', serif;}
            .bio-table { width:75%;border:0px solid;}
            .bio-table td {text-transform: capitalize;text-align: left;font-size: 15px;}
            .bio-table>tbody>tr>td { border:0px solid;text-transform: capitalize;color: rgb(0, 4, 51); font-size:15px;}
            .responsiv-table { border:0px solid;}
            .nav-menu li a {margin: 5px 5px 5px 5px;position: relative;display: block;padding: 10px 50px;border: 0px solid !important;box-shadow: none !important;
                            background-color: rgb(0, 4, 51) !important;color: #fff !important;    white-space: nowrap;}
            .nav-menu li.active a {background-color: rgb(255, 102, 0) !important;}
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
                        <a href="post_user_profile.php.php" > <h5><?php echo $p_name; ?></h5></a>


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


                    <li><a href="#timeline" role="tab" data-toggle="tab">
                            <i class="fa fa-key"></i> Timeline
                        </a>
                    </li>

                </ul><!--nav-tabs close-->

                <!-- Tab panes -->
                <div class="tab-content">


                    <!--inbox-->


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
                                                    <td>:<?php echo "    " . $p_name; ?> </td> 
                                                </tr>

                                                <tr>    
                                                    <td>Email</td>
                                                    <td>: <?php
$result = mysqli_query($conn, "SELECT email FROM users WHERE user_id = '" . $p_user_id . "' ");
$row = mysqli_fetch_array($result);
$p_email = $row['email'];
if (empty($p_email)) {
    $p_email = ' ';
}
echo $p_email;
?></td>       
                                                </tr>
                                                <tr>    
                                                    <td>Gender</td>
                                                    <td>:<?php
                                                        $result = mysqli_query($conn, "SELECT gender FROM user_info WHERE user_id = '" . $p_user_id . "' ");
                                                        $row = mysqli_fetch_array($result);
                                                        $p_gender = $row['gender'];
                                                        if (empty($p_gender)) {
                                                            $p_gender = ' ';
                                                        }
                                                        echo $p_gender;
                                                        ?>
                                                    </td>       
                                                </tr>
                                                <tr>
                                                    <td>Phone NO</td>
                                                    <td>: <?php
                                                        $result = mysqli_query($conn, "SELECT phone FROM user_info WHERE user_id = '" . $p_user_id . "' ");
                                                        $row = mysqli_fetch_array($result);
                                                        $p_phone = $row['phone'];
                                                        // $usr_phone=$_SESSION['usr_phone'];
                                                        if (empty($p_phone)) {
                                                            $p_phone = " ";
                                                        }
                                                        echo " " . $p_phone;
                                                        ?> </td> 
                                                </tr>
                                                <tr>
                                                    <td>Date Of Birth</td>
                                                    <td>:<?php
                                                        $result = mysqli_query($conn, "SELECT date_of_birth FROM user_info WHERE user_id = '" . $p_user_id . "' ");
                                                        // $usr_date=$_SESSION['usr_date'];
                                                        $row = mysqli_fetch_array($result);
                                                        $p_date = $row['date_of_birth'];
                                                        if (empty($p_date)) {
                                                            $p_date = '';
                                                        }
                                                        echo " " . $p_date;
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

                                <form class="form-horizontal main_form text-left" action=" " method="post"  id="contact_form">
                                    <fieldset>
                                        <div class="table-responsive responsiv-table">
                                            <table class="table bio-table" >
                                                <tbody>
<?php
echo "<tr>
    <th> Post ID </th>
                      <th> Title</th>
                      <th> District</th>
                      <th > Area</th>
                      <th > Address</th>
                      <th> Vacant From</th>
                      <th > Rent </th>
                      </tr>";
$result = mysqli_query($conn, "SELECT post_id,title,district,area,address,vac_mon,rent FROM post_ad WHERE user_id = '" . $p_user_id . "' ");

//$row= mysqli_fetch_assoc($result);
while ($row = mysqli_fetch_assoc($result)) {
    $postt_id = $row['post_id'];
    echo "<tr>";
    echo "<form action='full_post.php' method='post'>";
    echo "<td>" . $postt_id . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['district'] . "</td>";
    echo "<td>" . $row['area'] . "</td>";
    echo "<td >" . $row['address'] . "</td>";
    echo "<td>" . $row['vac_mon'] . "</td>";
    echo "<td>" . $row['rent'] . "</td>";
    echo "<td><input type='hidden' value='$postt_id' name='postid'/></td>";
    //echo "<td><span class=right><a href='#view_more?id=$postt_id'>[edit]</a> </td>";
    echo "<td><input type='submit' name='postid' value='$postt_id' class='btn btn-info btn-lg' data-toggle='modal' data-target='full_post.php' /></td>";
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