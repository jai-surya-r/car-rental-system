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

    $stmt = $conn->prepare("SELECT * FROM Customer");
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
                <a class="active" href="Home_page.html"><i class="fa fa-fw fa-sign-out"></i>Sign-out</a>
            </div>
        </div>
        <div class="register" style="margin-top: 4.5%;">
            <h1>Customer Details</h1>
            <div class="table">
                <table>
                    <tr>
                        <th><h2>Full Name</h2></th>
                        <th><h2>Licence ID</h2></th>
                        <th><h2>DOB</h2></th>
                        <th><h2>E-mail</h2></th>
                        <th><h2>Phone Number</h2></th>
                        <th><h2>Address</h2></th>
                        <th><h2>Operation</h2></th>
                    </tr>

                    <?php
                        while($rows = $stmt_result->fetch_assoc())
                        {
                    ?>
                        <tr>
                            <td><?php echo $rows['Full_name']; ?></td>
                            <td><?php echo $rows['L_id']; ?></td>
                            <td><?php echo $rows['DOB']; ?></td>
                            <td><?php echo $rows['Email']; ?></td>
                            <td><?php echo $rows['Ph_No']; ?></td>
                            <td><?php echo $rows['Addr']; ?></td>
                            <td>
                                <a href="Order.php?ll=<?php echo $rows['L_id']; ?>&i=2">
                                    <button class="btn">Delete</button>
                                </a><br><br>
                                <a href="admin.php?ll=<?php echo $rows['L_id']; ?>&#id01">
                                    <button class="btn" onclick="document.getElementById('id01').style.display='block'">Update</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        <div id="id01">
            <?php
                $ll = $_GET['ll'];
                $stmt = $conn->prepare("SELECT * FROM Customer WHERE L_id = ?");
                $stmt->bind_param("s", $ll);
                $stmt->execute();
                $stmt_result = $stmt->get_result();
                if ($stmt_result->num_rows > 0) {
                    $res = $stmt_result->fetch_assoc();
            ?>
            <form class="modal-content" action="Order.php?i=1" method="post">
                <div class="container">
                    <label style="font-size: 25px;"><b>Customer details updataion</b></label><br><br>
                    <label for="cus_id"><b>Customer ID*</b></label>
                    <input type="text" value="<?php echo $res['L_id'] ?>" name="cus_id" readonly>
                    <label for="cus_name"><b>Customer Name*</b></label>
                    <input type="text" value="<?php echo $res['Full_name'] ?>" name="cus_name" required>
                    <label for="phno"><b>Phone Number*</b></label>
                    <input type="text" value="<?php echo $res['Ph_No'] ?>" name="phno" required>
                    <label for="mail"><b>E-Mail*</b></label>
                    <input type="text" value="<?php echo $res['Email'] ?>" name="mail" required>
                    <label for="addr"><b>Address*</b></label>
                    <input type="text" value="<?php echo $res['Addr'] ?>" name="addr" required><br>
                    <div class="clearfix">
                        <button type="submit" class="signupbtn">Update</button><br>
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" style="width: 100%;">Cancel</button>
                    </div>
                </div>
            </form>
            <?php
                }
                else {
                    exit(0);
                }
            ?>
        </div>
    </body>
</html>
