<!DOCTYPE HTML>
<html>
<head>
       <title>Bob's Entertainment Universe</title>
<style>
       body {background-color:#9900FF;}
       h1 {color:#66FFFF; font-family:"Lucida Sans Unicode"}
       h2{font-family:"Verdana"}
	   p {font-family:"Verdana"; font-size: 13px;}
</style>
<!--FILENAME: williams-finalfive.php--->
<!--PROGRAMMER: Alexis Williams--->
<!--PURPOSE: Displays the user's payment info-->
</head>
<body>
<pre>
<h1>Bob's Entertainment Universe</h1>
<h2>Payment Information Receipt</h2>
<?
     extract($_POST);

     $link = mysqli_connect("localhost", "root", "s1r3nb1u3s");

     if(!$link){
         die("Could not connect to server." . mysqli_connect_error());
     }

     if(!mysqli_select_db($link, "cpt283db")){
        die("Issues with the database." . mysqli_connect_error());
     }

//assign variables from williams-finalfour form
$name = $_POST['namebox'];
$address = $_POST['mailbox'];
$city = $_POST['citybox'];
$state = $_POST['statebox'];
$zip = $_POST['zipbox'];
$phone = $_POST['phonebox'];
$card = $_POST['card'];
$cardnum = $_POST['numbox'];
$email = $_POST['email'];

//in case the user did not fill in the proper information
    if(empty($name)){
        die("Please go back and fill in your name.");
    }

    if(empty($address)){
        die("Please go back and fill in your complete street address.");
    }
    if(empty($city)){
        die("Please go back and fill in your city name.");
    }
    if(empty($state)){
        die("Please go back and fill in your state.");
    }
     if(empty($zip)){
        die("Please go back and fill in your complete zip code.");
    }
    
    if(empty($cardnum)){
        die("Your credit card number must be 16 digits long. Please go back and fill in your complete number.");
    }
        else if(strlen($cardnum) !=18){
            die("Your credit card number must be 16 digits long. Please make sure that you put it in the correct format.");
        }
    
    if(empty($phone)){
        die("Please go back and fill in your complete phone number.");
    }

    

//checking the credit card type
    switch($card){
        case "mastercard":
             $card = "MasterCard";
              break;
        case "amexp";
             $card = "Amercian Express";
             break;
        case "discover";
             $card = "Discover";
             break;
        case "boa";
             $card = "Bank of America";
             break;
        case "visa";
             $card = "Visa";
             break;
        case "chase";
             $card = "Chase";
             break;
        }
        

$fourdigits = substr($cardnum, 14);

$currentdate = date("F j, Y");

?>

<p><strong>Your card was approved. Thank you for your purchase!</strong></p>
<p><strong>Here are your payment details. You are welcome to print it out for your records.</strong></p>
<br>

<? echo <<<RECEIPT
   <b>Bobs Entertainment Universe<b>
   <b>$currentdate</b>\n


   <b>Name:</b>                   $name\n
   <b>Address:</b>                $address\n
                           $city, $state $zip\n
   <b>Phone:</b>                  $phone\n
   <b>Credit Card Carrier:</b>    $card\n
   <b>Card Number:</b>            **** ****** ** $fourdigits\n
   <b>E-mail:</b>                 $email\n

RECEIPT;
   
?>

<p><strong>Your shipment will be on its way soon! We hope to see you again!</strong></p>

<form action = "http://localhost/williams-finalone.php">
<input type = "submit" value = "Back to Home">
</form>
</pre>
</body>
</html>
