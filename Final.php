<?php
    session_start();

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "car_rental";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if(!$conn){
        die("Connection failed");
    }


    $stmt = $conn->prepare("SELECT * FROM Order_det WHERE License_ID = ?");
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Car Rental System</title>
        <link rel="icon" type="image/x-icon" href="Images/racing.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chelsea+Market">
        <link rel="stylesheet" href="Styles.css">
    </head>

    <body>
        <div class="header">
            <a class="title" style="font-family: Chelsea Market;">
                <img src="Images/racing.png" style="height: 40px; width: 40px;">
                DANNY RENTALS
            </a>
            <div class="header-right">
                <a class="active" href="Sec_Page.php"><i class="fa fa-fw fa-home"></i>Home</a>
                <a class="active" href="Home_page.html"><i class="fa fa-fw fa-sign-out"></i>Sign-out</a>
            </div>
        </div>
        <div class="register" style="margin-top: 4.5%;">
            <h1>Booking details</h1>
            <div class="table">
                <table>
                    <tr>
                        <th><h2>Order ID</h2></th>
                        <th><h2>Vehicle ID</h2></th>
                        <th><h2>Pickup/Drop Location</h2></th>
                        <th><h2>Start info</h2></th>
                        <th><h2>End info</h2></th>
                        <th><h2>Amount</h2></th>
                    </tr>

                    <?php
                        while($rows = $stmt_result->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $rows['Ord_ID']; ?></td>
                            <td><?php echo $rows['Vehicle_ID']; ?></td>
                            <td><?php echo $rows['Sel_loc']; ?></td>
                            <td><?php echo $rows['Start_dt']; ?></td>
                            <td><?php echo $rows['End_dt']; ?></td>
                            <td><?php echo $rows['Total_amt']; ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
