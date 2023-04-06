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

    $loc = $_POST['location'];
    $sdt = date("Y-m-d", strtotime($_POST["start_dt"]));
    $edt = date("Y-m-d", strtotime($_POST["end_dt"]));

    $_SESSION['Location'] = $loc;
    $_SESSION['start_dt'] = $sdt;
    $_SESSION['end_dt'] = $edt;

    $stmt = $conn->prepare("SELECT * FROM cars");
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    $cars = array();
    $ava = array();

    while ($rows = $stmt_result->fetch_assoc()) {
        $ava[] = $rows['Available'];
        $cars[] = $rows['Vehicle_ID'];
    }

    function check ($available) {
        if ($available === 1) {
            echo "Available";
        }
        else {
            echo "Not Available";
        }
    }

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Select Cars</title>
        <link rel="icon" type="image/x-icon" href="Images/racing.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chelsea+Market">
        <link rel="stylesheet" href="Styles2.css">
    </head>

    <body>
        <div class="header">
            <a class="title" style="font-family: Chelsea Market;">
                <img src="Images/racing.png" style="height: 40px; width: 40px;">
                DANNY RENTALS
            </a>
            <div class="header-right">
                <a class="active" href="Home_page.html"><i class="fa fa-fw fa-home"></i>Home</a>
                <a class="active" href="Home_page.html"><i class="fa fa-fw fa-sign-out"></i>Sign-out</a>
            </div>
        </div><br>
            <div class="row">

                <div class="column">
                    <h2>Tata Nano</h2>
                    <img class="cars" src="Images/Nano.jpg">
                    <p>Seats, Doors: 4, 4</p>
                    <p>Bags/Suitcases: 1 Large</p>
                    <p>Status: <?php check($ava[0]); ?></p>
                    <p>Price: ₹2500/day + taxes</p>
                    <a href="Order.php?car_id=<?php echo $cars[0]; ?>&i=3">
                        <button class="sel_cars"  <?php if ($ava[0] === 0){ ?> disabled <?php } ?> >Select car</button>
                    </a>
                </div>

                <div class="column">
                    <h2>Hyundai Grand i10 Nios</h2>
                    <img class="cars" src="Images/Grandi10.jpg">
                    <p>Seats, Doors: 4/5, 4</p>
                    <p>Bags/Suitcases: 1 Large and 1 small</p>
                    <p>Status: <?php check($ava[1]); ?></p>
                    <p>Price: ₹3500/day + taxes</p>
                    <a href="Order.php?car_id=<?php echo $cars[1]; ?>&i=3">
                        <button class="sel_cars"  <?php if ($ava[1] === 0){ ?> disabled <?php } ?> >Select car</button>
                    </a>
                </div>

                <div class="column">
                    <h2>Maruti Suzuki Swift</h2>
                    <img class="cars" src="Images/Swift.jpg">
                    <p>Seats, Doors: 5, 4</p>
                    <p>Bags/Suitcases: 2 Large</p>
                    <p>Status: <?php check($ava[2]); ?></p>
                    <p>Price: ₹4200/day + taxes</p>
                    <a href="Order.php?car_id=<?php echo $cars[2]; ?>&i=3">
                        <button class="sel_cars"  <?php if ($ava[2] === 0){ ?> disabled <?php } ?> >Select car</button>
                    </a>
                </div>
            <br>

            <div class="row">

                <div class="column">
                    <h2>Skoda Octavia</h2>
                    <img class="cars" src="Images/Octavia.jpg">
                    <p>Seats, Doors: 5, 4</p>
                    <p>Bags/Suitcases: 2 Large and 1 small</p>
                    <p>Status: <?php check($ava[3]); ?></p>
                    <p>Price: ₹4800/day + taxes</p>
                    <a href="Order.php?car_id=<?php echo $cars[3]; ?>&i=3">
                        <button class="sel_cars"  <?php if ($ava[3] === 0){ ?> disabled <?php } ?> >Select car</button>
                    </a>
                </div>

                <div class="column">
                    <h2>Mahindra XUV500</h2>
                    <img class="cars" src="Images/XUV500.jpg">
                    <p>Seats, Doors: 6, 4</p>
                    <p>Bags/Suitcases: 3 Large</p>
                    <p>Status: <?php check($ava[4]); ?></p>
                    <p>Price: ₹5500/day + taxes</p>
                    <a href="Order.php?car_id=<?php echo $cars[4]; ?>&i=3">
                        <button class="sel_cars"  <?php if ($ava[4] === 0){ ?> disabled <?php } ?> >Select car</button>
                    </a>
                </div>

                <div class="column">
                    <h2>Mercedes Benz GLS</h2>
                    <img class="cars" src="Images/GLS.jpg">
                    <p>Seats, Doors: 6, 4</p>
                    <p>Bags/Suitcases: 3 Large</p>
                    <p>Status: <?php check($ava[5]); ?></p>
                    <p>Price: ₹6700/day + taxes</p>
                    <a href="Order.php?car_id=<?php echo $cars[5]; ?>&i=3">
                        <button class="sel_cars"  <?php if ($ava[5] === 0){ ?> disabled <?php } ?> >Select car</button>
                    </a>
                </div>
            </div>
        <br>
    </body>
</html>
