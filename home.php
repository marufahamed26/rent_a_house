<?php
session_start();
ob_start();
include_once 'config.php';

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
<html>
    <head>
        <title>Home | Rent A House </title>
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
                        <?php if (isset($_SESSION['usr_id'])) { ?>
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
                                        <!--<li><a class="navbar-text" href="user_profile.php">Signed in as <?php //echo $_session['name'];       ?></a></li>
                                            <li><a href="logout.php">Log Out</a></li>-->
                        <?php } else { ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Sign Up</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>



        <br>
        <nav class="navbar navbar-default" role="navigation">
            <div class="table-title">
                <h5>Search Tolet</h5>
            </div>
            <div class="container-fluid">
                <form method="post" action="">
                    <b>District:</b>

                    <select name="distict" class="form-control selectpicker">
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

                    <b>Area:</b>
                    <select name="area" class="form-control selectpicker">
                        <option value="">Select Area</option>
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
                    </select>
                    <b>Vacant From</b>
                    <select name="vac_mon" class="form-control selectpicker" >
                        <option value="" >Select Month</option>
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
                    <b>Minimum Price:</b>
                    <select name="min_price" class="form-control selectpicker">
                        <option value="">Any</option>
                        <option value="4999">Below 5000 BDT</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="15000">15000</option>
                        <option value="20000">20000</option>
                        <option value="25000">25000</option>
                        <option value="30000">30000</option>
                        <option value="35000">35000</option>
                        <option value="40000">40000</option>
                        <option value="45000">45000</option>
                        <option value="50000">50000</option>
                        <option value="55000">55000</option>
                        <option value="60000">60000</option>
                        <option value="65000">65000</option>
                        <option value="70000">70000</option>
                        <option value="75000">75000</option>
                        <option value="80000">80000</option>
                        <option value="85000">85000</option>
                        <option value="90000">90000</option>
                        <option value="95000">95000</option>
                        <option value="100000">100000</option>
                        <option value="100001">Above 100000 BDT</option>


                    </select>

                    <b>Maximum Price:</b>
                    <select name="max_price" class="form-control selectpicker">
                        <option value="">Any</option>
                        <option value="4999">Below 5000 BDT</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="15000">15000</option>
                        <option value="20000">20000</option>
                        <option value="25000">25000</option>
                        <option value="30000">30000</option>
                        <option value="35000">35000</option>
                        <option value="40000">40000</option>
                        <option value="45000">45000</option>
                        <option value="50000">50000</option>
                        <option value="55000">55000</option>
                        <option value="60000">60000</option>
                        <option value="65000">65000</option>
                        <option value="70000">70000</option>
                        <option value="75000">75000</option>
                        <option value="80000">80000</option>
                        <option value="85000">85000</option>
                        <option value="90000">90000</option>
                        <option value="95000">95000</option>
                        <option value="100000">100000</option>
                        <option value="100001">Above 100000</option>


                    </select>
                    <br>

                    <div class="form-group col-md-10">
                        <div class="form-group">
                            <input type="submit" name="search" value="SEARCH" class="btn btn-primary" />
                        </div>
                    </div>
                </form>

            </div>


        </nav>



        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <div class="table-title">
            <h3>ALL TOLET</h3>
        </div>

        <table class="table-fill " >
            <?php
            if (empty($search_result)) {
                echo "<tr>";
                echo "<th> No Tolet Found </th> ";

                echo "</tr>";
            } else {
                echo "<tr>

                      <th> Title</th>
                      <th> District</th>
                      <th> Area</th>
                      <th> Address</th>
                      <th> Vaccant From</th>
                      <th> Rent </th>
                      <th> Details </th>
                      </tr>";



//$row= mysqli_fetch_assoc($result);



                while ($row = mysqli_fetch_assoc($search_result)) {
                    $p_id = $row['post_id'];
                    echo "<tr>";
                    echo "<form action='full_post.php' method='post'>";

                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['district'] . "</td>";
                    echo "<td>" . $row['area'] . "</td>";
                    echo "<td >" . $row['address'] . "</td>";
                    echo "<td>" . $row['vac_mon'] . "</td>";
                    echo "<td>" . $row['rent'] . "</td>";
                    echo "<input type='hidden' value='$p_id' name='postid'/>";
                    //echo "<td><span class=right><a href='#view_more?id=$p_id' target='_self'>[edit]</a> </td>";
                    echo "<td><input type='submit' name='post_id' value='Details' class='btn btn-info btn-lg' data-toggle='modal' data-target='#view_more' /></td>";
                    echo "</form>";
                    echo "</tr>";
                }
            }
            ?>


        </table>


        <br><br>

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
            $postt_id;

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