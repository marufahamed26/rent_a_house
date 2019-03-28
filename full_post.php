<?php
session_start();


include_once 'config.php';




//if (isset($_POST['commentsubmit'])) {
//    echo "adsfa";
//    if (isset($_SESSION['usr_id'])) {
//        $user_id = $_SESSION['usr_id'];
//        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
//        $postt_id;
//
//
//        if (empty($comment)) {
//            echo "adsfa";
//            $error = true;
//            $comment_error = " Comment error";
//        }
//        if (!$error) {
//
//            if (mysqli_query($conn, "INSERT INTO ad_comment(post_id,user_id,comment) VALUES('" . $postt_id . "', '" . $user_id . "' , '" . $comment . "')")) {
//                echo "dfasdf";
//            } else {
//                $errormsg = "Error in updating ... Please try again later!";
//            }
//        }
//    } else {
//        header("Location: login.php");
//    }
//} else if (isset($_POST['send_message'])) {
//
//    if (isset($_SESSION['usr_id'])) {
//        $user_id = $_SESSION['usr_id'];
//        $post_user_id = $_SESSION['post_user_id'];
//        $sendtext = mysqli_real_escape_string($conn, $_POST['sendtext']);
//        $postt_id;
//
//        if (empty($sendtext)) {
//            echo "adsfa";
//            $error = true;
//            $sendtext_error = " Address error";
//        }
//        if (!$error) {
//
//            if (mysqli_query($conn, "INSERT INTO user_message(user_id,from_user_id,message) VALUES('" . $post_user_id . "', '" . $user_id . "' , '" . $sendtext . "')")) {
//                echo "dfasdf";
//            } else {
//                $errormsg = "Error in updating ... Please try again later!";
//            }
//        }
//    } else {
//        header("Location: login.php");
//    }
//}
if (isset($_POST['search'])) {

    $district = $_POST['distict'];

    $area = $_POST['area'];
    $vacant = $_POST['vac_mon'];
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];



    $result = "SELECT post_id,title,district,area,address,vac_mon,rent FROM post_ad WHERE district='" . $district . "' AND vac_mon='" . $vacant . "' AND area='" . $area . "' AND rent>='" . $min_price . "' AND rent<='" . $max_price . "' ";

    $search_result = filterTable($result);
} else {
    $result = "SELECT post_id,title,district,area,address,vac_mon,rent FROM post_ad  ";
    $search_result = filterTable($result);
}

function filterTable($result) {
    $conn = new mysqli("127.0.0.1", "root", "", "rent_a_house");
    $filter_result = mysqli_query($conn, $result);
    return $filter_result;
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Full Post</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <style>
             @import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

            body {
                background-color: #90C3D4;
                font-family: "Roboto", helvetica, arial, sans-serif;
                font-size: 16px;
                font-weight: 400;
                text-rendering: optimizeLegibility;
            }

            div.table-title {
                display: block;
                margin: auto;
                max-width: 600px;
                padding:5px;
                width: 100%;
            }

            .table-title h3 {
                color: #050505;
                font-size: 30px;
                font-weight: 400;
                font-style:normal;
                font-family: "Roboto", helvetica, arial, sans-serif;
                text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
                text-transform:uppercase;
                text-align: center;
            }
            .table-title h5 {
                color: #050505;
                font-size: 30px;
                font-weight: 400;
                font-style:normal;
                font-family: "Roboto", helvetica, arial, sans-serif;
                text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
                text-transform:uppercase;
                text-align: center;
            }


            /*** Table Styles **/

            .table-fill {
                background: white;
                border-radius:3px;
                border-collapse: collapse;
                height: 320px;
                margin: auto;
                max-width: 600px;
                padding:5px;
                width: 100%;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                animation: float 5s infinite;
            }

            th {
                color:#D5DDE5;;
                background:#1b1e24;
                border-bottom:4px solid #9ea7af;
                border-right: 1px solid #343a45;
                font-size:23px;
                font-weight: 100;
                padding:24px;
                text-align:left;
                text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                vertical-align:middle;
            }

            th:first-child {
                border-top-left-radius:3px;
            }

            th:last-child {
                border-top-right-radius:3px;
                border-right:none;
            }

            tr {
                border-top: 1px solid #C1C3D1;
                border-bottom-: 1px solid #C1C3D1;
                color:#666B85;
                font-size:16px;
                font-weight:normal;
                text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
            }

            tr:hover td {
                background:#4E5066;
                color:#FFFFFF;
                border-top: 1px solid #22262e;
                border-bottom: 1px solid #22262e;
            }

            tr:first-child {
                border-top:none;
            }

            tr:last-child {
                border-bottom:none;
            }

            tr:nth-child(odd) td {
                background:#EBEBEB;
            }

            tr:nth-child(odd):hover td {
                background:#4E5066;
            }

            tr:last-child td:first-child {
                border-bottom-left-radius:3px;
            }

            tr:last-child td:last-child {
                border-bottom-right-radius:3px;
            }

            td {
                background:#FFFFFF;
                padding:20px;
                text-align:left;
                vertical-align:middle;
                font-weight:300;
                font-size:18px;
                text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
                border-right: 1px solid #C1C3D1;
            }

            td:last-child {
                border-right: 0px;
            }

            th.text-left {
                text-align: left;
            }

            th.text-center {
                text-align: center;
            }

            th.text-right {
                text-align: right;
            }

            td.text-left {
                text-align: left;
            }

            td.text-center {
                text-align: center;
            }

            td.text-right {
                text-align: right;
            }
        </style>
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
                        <?php
                        if (isset($_SESSION['usr_id'])) {
                            if(!empty($_SESSION['usr_id'])){
                                $user_id = $_SESSION['usr_id'];
                            }
 else { $user_id= ' ';}
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> 
                                    <strong><?php
                                        $usrname = $_SESSION['usr_name'];
                                        echo $usrname;
                                        ?></strong>
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
                                                    <p class="text-left"><strong><?php echo $usrname; ?></strong></p>

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
                                        <!--<li><a class="navbar-text" href="user_profile.php">Signed in as <?php //echo $_session['name'];        ?></a></li>
                                            <li><a href="logout.php">Log Out</a></li>-->
                        <?php } else { ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Sign Up</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>

        <div class="container-fluid">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content row">
                    <div class="modal-header custom-modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Full Post</h4>

                        <button type='button' value="" class="btn btn-primary btn-block" data-toggle='modal' data-target='#sendmessage'>Send Message</button>
                    </div>
                    <div class="modal-body">
                        <form name="info_form" class="form-inline" action="#" method="post">
                            <?php
                            if (isset($_POST['postid'])) {
                                $p_id = $_POST['postid'];
                                //echo $p_id;
                            } else {
                                echo "no id";
                            }


                            $result = mysqli_query($conn, "SELECT users.name, post_ad.post_id, post_ad.user_id,post_ad.title,post_ad.district,post_ad.area,post_ad.address,post_ad.rent_type,post_ad.no_of_room, post_ad.flat_type,post_ad.no_of_wash,post_ad.belcony,post_ad.vac_mon,post_ad.rent FROM post_ad INNER JOIN  users WHERE post_ad.user_id=users.user_id AND post_id= '" . $p_id . "' ");
                            if ($row = mysqli_fetch_array($result)) {
                                $_SESSION['post_user_id'] = $row['user_id'];
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['po_id'] = $row['post_id'];
                                $_SESSION['title'] = $row['title'];
                                $_SESSION['district'] = $row['district'];
                                $_SESSION['area'] = $row['area'];
                                $_SESSION['address'] = $row['address'];
                                $_SESSION['rent_type'] = $row['rent_type'];
                                $_SESSION['no_of_room'] = $row['no_of_room'];
                                $_SESSION['flat_type'] = $row['flat_type'];
                                $_SESSION['no_of_wash'] = $row['no_of_wash'];
                                $_SESSION['belcony'] = $row['belcony'];
                                $_SESSION['vac_mon'] = $row['vac_mon'];
                                $_SESSION['rent'] = $row['rent'];
                                //header("Location: user_profile.php");
                            }
                            ?>
                            <table class="table bio-table">
                                <tbody>
                                    <tr>      
                                        <td>Post BY:</td>
                                        <td>:<a href="post_user_profile.php?value_key=<?php $po_User_id = $_SESSION['post_user_id']; ?>" ><?php
                                                $postt_name = $_SESSION['name'];
                                                echo " " . $postt_name;
                                                ?></a> </td> 
                                    </tr>
                                    <tr>      
                                        <td>Post Id:</td>
                                        <td>:<?php
                                                    $po_id = $_SESSION['po_id'];
                                                    echo " " . $po_id;
                                                ?> </td> 
                                    </tr>

                                    <tr>    
                                        <td>Title</td>
                                        <td>: <?php
                                            $post_title = $_SESSION['title'];
                                            echo " " . $post_title;
                                                ?></td>       
                                    </tr>
                                    <tr>    
                                        <td>District</td>
                                        <td>:<?php
                                            $post_district = $_SESSION['district'];
                                            echo " " . $post_district;
                                                ?>
                                        </td>       
                                    </tr>
                                    <tr>
                                        <td>Area</td>
                                        <td>: <?php
                                            $post_area = $_SESSION['area'];
                                            echo " " . $post_area;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:<?php
                                            $post_address = $_SESSION['address'];
                                            echo " " . $post_address;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Rent Type</td>
                                        <td>:<?php
                                            $post_rent_type = $_SESSION['rent_type'];
                                            echo " " . $post_rent_type;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Number Of Room</td>
                                        <td>:<?php
                                            $posr_no_of_room = $_SESSION['no_of_room'];
                                            echo " " . $posr_no_of_room;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Flat Type</td>
                                        <td>:<?php
                                            $post_flat_type = $_SESSION['flat_type'];
                                            echo " " . $post_flat_type;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Number Of Washroom</td>
                                        <td>:<?php
                                            $post_no_of_wash = $_SESSION['no_of_wash'];
                                            echo " " . $post_no_of_wash;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Belcony</td>
                                        <td>:<?php
                                            $post_belcony = $_SESSION['belcony'];
                                            echo " " . $post_belcony;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Vacant From</td>
                                        <td>:<?php
                                            $post_vac_mon = $_SESSION['vac_mon'];
                                            echo " " . $post_vac_mon;
                                                ?> </td> 
                                    </tr>
                                    <tr>
                                        <td>Rent</td>
                                        <td>:<?php
                                            $post_rent = $_SESSION['rent'];
                                            echo " " . $post_rent;
                                                ?> </td> 
                                    </tr>
                                </tbody>
                            </table>

                            <div class="">

                                <label class="" >Comment Section</label> 
                                <hr>

                                <b>Comment As: <?php
                                            if (empty($usrname)) {
                                                $usrname = ' ';
                                            } echo $usrname;
                                                ?>

                                </b>
                                <div class="">

                                    <div class="input-group">
                                        <textarea style="width: 400px; height: 150px;" name="comment" rows="2" cols="155" placeholder=""></textarea>
                                        <br>
                                        <button type='button' value="" class="btn btn-primary btn-block" data-toggle='modal' name="commentsubmit">Send Message</button>

                                    </div>
                                </div>

                                <label class="" >Previous Comment</label> 
                                <hr>

                                <div id="display" class="col-md-8 col-md-offset-1">
                                    <?php
                                    /* set a query for retrieving the data . */
                                    $sqlQuery = "SELECT users.name,ad_comment.comment FROM users INNER JOIN ad_comment WHERE users.user_id=ad_comment.user_id AND ad_comment.post_id='" . $po_id . "'";

                                    /* execute the query */
                                    $result = mysqli_query($conn, $sqlQuery) or die(mysql_error());
                                    /* loop the executed query */
                                    while ($row = mysqli_fetch_array($result)) {
                                        $us_name = $row['name'];
                                        echo '<div class="panel panel-primary">';
                                        echo '<div class="panel-heading"><span class="glyphicon glyphicon-user"> </span> Posted by : ' . $us_name . '</div>';
                                        echo '<div class="panel-body">';
                                        echo $row['comment'];
                                        echo '</div>';

                                        echo '</div>';
                                    }
                                    ?>

                                </div>
                                <br>
                                <br>    
                                <!--                                    </from>-->

                                <!--                                </form>-->
                            </div>
                            <?php if ($user_id == $po_User_id) {
                                ?>
                                <input type="submit" value="Delete Post" value-target="#confirm">
                            <?php } ?>
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
                        </form>
                    </div>
                </div>
                <div id="sendmessage" class="modal fade in" role="dialog">
                    <div class="modal-dialog">


                        <div class="modal-content row">
                            <div class="modal-header custom-modal-header">
                                <button type="button" value="" class="close" data-dismiss="modal">×</button>
                                <h4 class="modal-title">Send Message </h4>
                                <hr>
                                <h4 class="modal-title"> To: <?php echo $postt_name ?></h4>
                                <hr>
                                <h4 class="modal-title"> From: <?php echo $usrname ?></h4>

                            </div>
                            <div class="modal-body">
                                <form name="info_form" class="form-inline" action="#" method="post">



                                    <div class="form-group col-md-10">
                                        <div class="col-md-6">
                                            <textarea style="width: 400px; height: 150px;" name="sendtext" rows="2" cols="155" placeholder=""></textarea>
                                            <input type="submit" name="send_message" value="Send Message" class="btn btn-warning submit-button" />
                                            <!--                                    <button type="submit" name="send" class="btn btn-warning submit-button" >Send Message</button>-->
                                            <button type="submit" class="btn btn-warning submit-button" class="close" data-dismiss="modal">Cancel</button>
                                            <br><br>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div> 
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("myBtn").value;
                document.getElementById("view_more").innerHTML = x;
            }
        </script>
    </body>
    <?php
    $error = FALSE;
    if (isset($_POST['send_message'])) {

        if (isset($_SESSION['usr_id'])) {
            $user_id = $_SESSION['usr_id'];
            $post_user_id = $_SESSION['post_user_id'];
            $sendtext = mysqli_real_escape_string($conn, $_POST['sendtext']);
            $p_id;

            if (empty($sendtext)) {
                echo "adsfa";
                $error = true;
                $sendtext_error = " Address error";
            }
            if (!$error) {

                if (mysqli_query($conn, "INSERT INTO user_message(user_id,from_user_id,message) VALUES('" . $post_user_id . "', '" . $user_id . "' , '" . $sendtext . "')")) {
                    echo "dfasdf";
                } else {
                    $errormsg = "Error in updating ... Please try again later!";
                }
            }
        } else {
            header("Location: login.php");
        }
    }

    if (isset($_POST['commentsubmit'])) {
        echo "adsfa";
        if (isset($_SESSION['usr_id'])) {
            $user_id = $_SESSION['usr_id'];
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
            $p_id;


            if (empty($comment)) {
                echo "adsfa";
                $error = true;
                $comment_error = " Comment error";
            }
            if (!$error) {

                if (mysqli_query($conn, "INSERT INTO ad_comment(post_id,user_id,comment) VALUES('" . $p_id . "', '" . $user_id . "' , '" . $comment . "')")) {
                    echo "dfasdf";
                } else {
                    $errormsg = "Error in updating ... Please try again later!";
                }
            }
        } else {
            header("Location: login.php");
        }
    }
    ?>
</html>
