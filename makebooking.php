<?php
    session_start();
    if ($_SESSION["login"] != "YES") {
	  header("Location: home.html");
	}
        

        $ev_id =  $_GET['ev_id'];
        
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "eventmanagementsystem";
    $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error){
            die("Connection Failed");
        }
?>
<html>
    <head>
        <title>Event Management System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <style>h1, h4, h2{text-align:center; color:black; font-family: verdana;}
            body{background:black url("images/12.jpg") no-repeat left bottom; background-size:cover;}
			a{ color:black; font-family: Lucida Console; font-size:17px; font-weight:bold;}
            h4.userlabel {text-align: right; font-family: Lucida Console; font-weight:bold;}
			button,label,tbody{font-family: Lucida Console; font-weight:bold; color:black; font-size:14px;}
            #flt0_events_table {
                width: 70px;
            }
            #flt3_events_table {
                width: 310px;
            }
            #flt5_events_table {
                width: 100px;
            }
            .table-responsive table.TF{
				font-family: Lucida Console;
				color:black;
				size: 40px;
				border:none;
            }
            .table-responsive table.TF th{
                background-color:transparent; 
                border-bottom: 2px solid #ddd;
                border-top: 1px solid #ddd;
                border-right:none;
                border-left:none;
                padding:8px;
                color:black;
				font-family: helvetica; 
				font-weight:bold;
				font-size: 17px;
            }
            .table-responsive table.TF td{
                padding:8px;
                border-bottom:none;
                border-right:none;
            }
            .table-responsive .fltrow{ /* filter grid row appearance */
                height:auto;
                background-color:transparent;
            }
            .table-responsive .fltrow td, .fltrow th{
                padding:2px !important;
            } 
            .table-responsive .flt {
				font-family: Lucida Console;
                font-size: 20px;
                border: 1px solid #ccc;
                margin: 0;
                width: 150;
                vertical-align: middle;
				color:black;
				
            }
            #num_tkts{width:5%;display: inline-block;}
        </style>
    </head>
    <body>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                <h1>Event Management System</h1>
                <h4 class = "userlabel">Welcome, <?php echo $_SESSION['username']?>!!</h4>
                <a href ="userhome.php">Home</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a href ="bookinghistory.php">Booking History</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                
        <a href="logout.php">Logout</a>
       
                <h4>You have chosen to book tickets for 
                <?php
                $sql_evname = "SELECT distinct event_name from event where event_id = (SELECT  event_id from event_venue where ev_id = ".$ev_id.");";
                $result= $conn->query($sql_evname);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }
                echo $row['event_name'];
                
                $sql_evname = "SELECT * FROM `view_event_venues1` WHERE ev_id = ".$ev_id.";";
                $result= $conn->query($sql_evname);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                }
                
                echo " on ".$row['play_date']." at ".$row['play_time']." in ".$row['venue_name'];
                echo "<br>You have ".$row['available_seats']." seats available for this show";
                
?>
                </h4>
                <form class="form-horizontal" role="form" action="book.php" method="post" name="book">
                    <div class="form-group">
                         <label for="numberoftkts">Choose Number of Seats:</label> 
                         <input type="number" class="form-control abc" name="num_tkts" id='num_tkts'>
                         <button type="submit" class="btn btn-default">Book Tickets</button>
                         <input type='hidden' id="evidbook" name='evidbook' value="<?php echo $ev_id;?>"/>
                        
                        
                    </div>
                </form>
                    </div>
                </div>
                    <div class="col-sm-1"></div>
                </div>
</body>    
</html>
