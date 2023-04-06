<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "car_rental";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if(!$conn){
        die("Connection failed");
    }

    session_start();

    $l_id = $_POST['uname'];
    $pass = $_POST['psw'];

    if($l_id === 'ADMIN' && $pass === '12345') {
        header("Location: http://localhost/Mini%20Project/Car%20rental%20system/admin.php?ll=NULL");
        exit(0);
    }

    $stmt = $conn->prepare("SELECT * FROM customer WHERE L_id = ?");
    $stmt->bind_param("s", $l_id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if($stmt_result->num_rows>0) {
        $data = $stmt_result->fetch_assoc();
        if($data['Passkey'] === $pass) {
            echo "";
        }
        else {
            echo "<h2>Invalid credentials, Please enter valid credentials</h2>";
            exit(0);
        }
    }
    else {
        echo "<h2>Invalid user ID</h2>";
        exit(0);
    }

    $_SESSION['user_id'] = $l_id;
    $_SESSION['user_name'] = $data['Full_name'];

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
                <a class="active" href="Final.php"><i class="fa fa-fw fa-car"></i> My Rentals</a>
                <a><i class="fa fa-fw fa-user"></i><?php echo $data['Full_name']; ?></a>
            </div>
        </div>
        <div class="register" style="margin-top: 4.5%;">
            <form class="selection" action="Cars.php" method="post">
                <div class="container">
                    <h2>Enter the details below</h2>
                    <label for="location">
                        <h3><i class="fa fa-fw fa-location-arrow"></i>Select location</h3>
                    </label>
                    <select name="location" id="location">
                        <option value="Bangalore" selected>Bangalore</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Chennai">Chennai</option>
                        <option value="Mumbai">Mumbai</option>
                        <option value="New Delhi">New Delhi</option>
                    </select>
                    <label for="start">
                        <h3><i class="fa fa-fw fa-calendar-times-o"></i>Select start date and time</h3>
                        <input type="date" class="sdate" name="start_dt" min="<?php echo date('Y-m-d'); ?>" required>
                    </label>
                    <label for="end">
                        <h3><i class="fa fa-fw fa-calendar-times-o"></i>Select return date and time</h3>
                        <input type="date" class="sdate" name="end_dt" min="<?php echo date('Y-m-d'); ?>" required>
                    </label><br><br>
                    <a href="Cars.php"><button type="submit" class="sel_car"><b style="font-family: Audiowide;">SELECT CAR</b></button></a>
                </div>
            </form>
        </div>
    </body>
</html>
