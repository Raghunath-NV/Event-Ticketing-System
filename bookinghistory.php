<?php
    session_start();
    if ($_SESSION["login"] != "YES") {
	  header("Location: home.html");
	}
        $customer_id = $_SESSION['customerid'];
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
                <h1>Event Management System</h1>
                <h4 class = "userlabel">Welcome, <?php echo $_SESSION['username']?>!!</h4>
                <a href ="userhome.php">Home</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <a href ="bookinghistory.php">Booking History</a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <a href="logout.php">Logout</a>
        <div class ="container" id="events_table">
            <div class="table-responsive">          
                <table class="table filterable" id="events_table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Event Name</th>
                            <th>Venue Name</th>
                            <th>Play Date</th>
                            <th>Play Time</th>
                            <th>Number of Tickets</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

        <?php
            $sql = "SELECT * FROM booking_details WHERE `Customer ID` = ".$customer_id.";";
           
            $result1 = $conn->query($sql);
            if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                echo "<tr><td>".$row['Booking ID']."</td><td>".$row['Event Name']."</td><td>".$row['Venue Name'].
                                        "</td><td>".$row['Date']."</td><td>".$row['Time']."</td><td>".$row['Number of Tickets'].
                                        "</td><td>".$row['Total Cost']."</td><td>".$row['Status']."</td><td><a href='cancel.php?booking_id=".$row['Booking ID']."'>Cancel Tickets</a></td></tr>";
                            }
            }
        ?>
                    </tbody>
                </table>
        
    </body>
</html>



