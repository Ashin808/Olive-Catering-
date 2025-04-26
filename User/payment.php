<?php
ob_start();

include("../Asset/Connection/Connection.php");
if (isset($_POST["btn_pay"])) {
    
    $transactionId = uniqid('txn_', true); 

   
    $a = "UPDATE tbl_booking SET booking_status='3', transaction_id='$transactionId' WHERE booking_id='" . $_GET["bid"] . "'";
    
    if ($con->query($a)) {
        ?>
        <script>
            alert('Payment Completed. Transaction ID: <?php echo $transactionId; ?>');
            window.location = "MyBookings.php";
        </script>
        <?php
    } else {
        echo "<script>alert('Failed to update booking status.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #f5f5f5;
            font-family: Arial, Helvetica, sans-serif;
        }
        .wrapper {
            background-color: #fff;
            width: 500px;
            padding: 25px;
            margin: 25px auto 0;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        }
        .wrapper h2 {
            background-color: #fcfcfc;
            color: #7ed321;
            font-size: 24px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px dotted #333;
        }
        h4 {
            padding-bottom: 5px;
            color: #7ed321;
        }
        .input-group {
            margin-bottom: 8px;
            width: 100%;
            position: relative;
            display: flex;
            flex-direction: row;
            padding: 5px 0;
        }
        .input-box {
            width: 100%;
            margin-right: 12px;
            position: relative; 
        }
        .input-box:last-child {
            margin-right: 0;
        }
        .name {
            padding: 14px 10px 14px 50px;
            width: 100%;
            background-color: #fcfcfc;
            border: 1px solid #00000033;
            outline: none;
            letter-spacing: 1px;
            transition: 0.3s;
            border-radius: 3px;
            color: #333;
        }
        .name:focus, .dob:focus {
            box-shadow: 0 0 2px 1px #7ed32180;
            border: 1px solid #7ed321;
        }
        .input-box .icon {
            width: 48px;
            display: flex;
            justify-content: center;
            position: absolute;
            padding: 15px;
            top: 0px;
            left: 0px;
            color: #333;
            background-color: #f1f1f1;	
            border-radius: 2px 0 0 2px;
            transition: 0.3s;
            font-size: 20px;
            pointer-events: none;
            border: 1px solid #000000033;
            border-right: none;
        }
        .name:focus + .icon {
            background-color: #7ed321;
            color: #fff;
            border-right: 1px solid #7ed321;
        }
        input[type=submit] {
            width: 100%;
            background: #7ed321;
            color: #fff;
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.35s ease;
        }
        input[type=submit]:hover {
            cursor: pointer;
            background: #5eb105;
        }
        .nav-links {
            text-align: center;
            padding: 15px 0;
        }
        .nav-links a {
            background: #7ed321;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .nav-links a:hover {
            background: #5eb105;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
    <title>PSST - Payment Gateway</title>
</head>
<body>
    <div class="wrapper">
        <h2>Payment Gateway</h2>
        <form method="POST">
            <h4>Account</h4>
            <div class="input-group">
                <div class="input-box">
                    <input class="name" type="text" name="txtname" id="txtname" placeholder="First Name" required>
                    <i class="fa fa-user icon" aria-hidden="true"></i>
                </div>
                <div class="input-box">
                    <input class="name" type="text" name="txtnname" id="txtnname" placeholder="Second Name" required>
                    <i class="fa fa-user icon" aria-hidden="true"></i>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input class="name" type="email" name="txtemail" id="txtemail" placeholder="Email Address" required>
                    <i class="fa fa-envelope icon" aria-hidden="true"></i>
                </div>
            </div>	
            <!-- <div class="input-group">
                <div class="input-box">
                    <h4>Payment Details</h4>
                    <input type="radio" name="rdbpay" id="cc" checked class="radio">
                    <label for="cc">
                        <span><i class="fa fa-cc-visa" aria-hidden="true"></i> Credit Card</span>
                    </label>
                    <input type="radio" name="rdbpay" id="dc" class="radio">
                    <label for="dc">
                        <span><i class="fa fa-cc-visa" aria-hidden="true"></i> Debit Card</span>
                    </label>
                </div>
            </div> -->
            <div class="input-group">
                <div class="input-box">
                    <input class="name" type="tel" id="txtcardno" name="txtcardno" maxlength="19" placeholder="Card Number" required>
                    <i class="fa fa-credit-card icon" aria-hidden="true"></i>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input class="name" type="text" name="txtcvc" id="txtcvc" maxlength="3" placeholder="CVC" required>
                    <i class="fa fa-user icon" aria-hidden="true"></i>
                </div>
                <div class="input-box">
                    <input class="name" type="text" name="txtmonthyear" id="txtmonthyear" maxlength="5" placeholder="MM/YY" required>
                    <i class="fa fa-calendar-alt icon" aria-hidden="true"></i>
                </div>
            </div>
            <input type="submit" name="btn_pay" value="Pay Now">
        </form>
        <div class="nav-links">
            <a href="MyBookings.php">Back to My Bookings</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#txtcardno').mask('0000 0000 0000 0000');
            $('#txtcvc').mask('000');
            $('#txtmonthyear').mask('00/00');
        });

        function validateExpirationDate(inputValue) {
            const [month, year] = inputValue.split('/');
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth() + 1;
            const currentYear = currentDate.getFullYear() % 100;

            if (
                parseInt(month) < 1 || 
                parseInt(month) > 12 || 
                parseInt(year) < currentYear || 
                (parseInt(year) === currentYear && parseInt(month) < currentMonth)
            ) {
                alert('Invalid expiration date');
                document.getElementById("txtmonthyear").value = '';
            }
        }

        document.getElementById("txtmonthyear").addEventListener("blur", function() {
            const inputValue = this.value;
            validateExpirationDate(inputValue);
        });
    </script>
</body>
</html>
