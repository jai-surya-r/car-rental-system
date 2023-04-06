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

    $i = $_GET['i'];

    //For updating customer records
    if($i === '1') {
        $cid = $_POST['cus_id'];
        $cnm = $_POST['cus_name'];
        $phno = $_POST['phno'];
        $mail = $_POST['mail'];
        $addr = $_POST['addr'];

        $stmt = $conn->prepare("UPDATE Customer SET Full_name = ?, Ph_No = ?, Email = ?, Addr = ? WHERE L_id = ?");
        $stmt->bind_param("sssss", $cnm, $phno, $mail, $addr, $cid);
        $stmt->execute();

        header("Location: http://localhost/Mini%20Project/Car%20rental%20system/admin.php?ll=NULL");
    }
    
    //For deleting customer records
    else if($i === '2') {
        $ll = $_GET['ll'];
        $stmt = $conn->prepare("UPDATE Order_det SET License_id = NULL WHERE License_id = ?");
        $stmt->bind_param("s", $ll);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM Customer WHERE L_id = ?");
        $stmt->bind_param("s", $ll);
        $stmt->execute();

        header("Location: http://localhost/Mini%20Project/Car%20rental%20system/admin.php?ll=NULL");
    }

    //For Car Booking
    else if ($i === '3') {
        $car_id = $_GET['car_id'];

        $stmt = $conn->prepare("SELECT * FROM Cars WHERE Vehicle_ID = ?");
        $stmt->bind_param("s", $car_id);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        $cars = $stmt_result->fetch_assoc();

        $prc = $cars['Price'];

        $stmt = $conn->prepare("INSERT INTO order_det (Vehicle_ID, License_ID, Sel_loc, Start_dt, End_dt, Total_amt) VALUES (?, ?, ?, ?, ? ,?)");
        $stmt->bind_param("sssssi", $car_id, $_SESSION['user_id'], $_SESSION['Location'], $_SESSION['start_dt'], $_SESSION['end_dt'], $prc);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE Cars SET Available = 0 WHERE Vehicle_ID = ?");
        $stmt->bind_param("s", $car_id);
        $stmt->execute();

        header("Location: http://localhost/Mini%20Project/Car%20rental%20system/Final.php");
    }
?>
