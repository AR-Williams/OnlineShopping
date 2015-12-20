<!DOCTYPE HTML>
<html>
<head>
       <title>Bob's Entertainment Universe</title>
<style>
       body {background-color:#9900FF;}
       h1 {color:#66FFFF; font-family:"Lucida Sans Unicode"}
       h2, h3{font-family:"Verdana"}
	   p {font-family:"Verdana"; font-size: 13px;}
       table {border: 3px solid black;, width:50%;}
       td {font-family:"Geneva", text-align: center; font-size: 13px;, width:100%;}
</style>
<!--FILENAME: williams-finalfour.php--->
<!--PROGRAMMER: Alexis Williams--->
<!--PURPOSE: Displays the user's final choices and total cost and takes user info-->
</head>
<body>
<pre>

<?
     extract($_POST);

     $link = mysqli_connect("localhost", "root", "s1r3nb1u3s");

     if(!$link){
         die("Could not connect to server." . mysqli_connect_error());
     }

     if(!mysqli_select_db($link, "cpt283db")){
        die("Issues with the database." . mysqli_connect_error());
     }

     if(empty($_POST['choice'])){
         die("<p>It appears you have no items you would like to purchase! If that's not the case, please press the back button and try again.</p>");
     }


//foreach loop to generate respective header titles of the dept.s
foreach($_POST['choice'] as $value){
    $h_query = "SELECT department FROM products WHERE ID = '$value'";
    $h_result = mysqli_query($link, $h_query);
}

$header = mysqli_fetch_assoc($h_result);
$header_title = $header['department'];

?>



<h1>Bob's Entertainment Universe</h1>
<h2><? echo $header_title; ?> Department</h2>
<h3>Payment Confirmation</h3>

<p>Here are the items you would like to purchase: </p>

<table>
<tr>
    <th>ID Number</th>
    <th>  Entertainer/Author</th>
    <th>Title</th>
    <th>Price</th>
    <th>Summary</th>
</tr>

<?

$total = 0;
$stocktotal = 0;

//now it's time to generate the user's choices
foreach($_POST['choice'] as $prod){
    $queryOne = "SELECT ID, entertainerauthor, title, summary FROM products WHERE ID = '$prod' ORDER BY entertainerauthor";
    $resultOne = mysqli_query($link, $queryOne);

    $queryTwo = "SELECT UnitPrice FROM prodinv WHERE ID = '$prod'";
    $resultTwo = mysqli_query($link, $queryTwo);


        if($resultTwo){
            $dept = mysqli_fetch_assoc($resultOne);
             $ID = $dept['ID'];
             $EAUTH = $dept['entertainerauthor'];
             $title = $dept['title'];
             $summary = $dept['summary'];

             $inv = mysqli_fetch_assoc($resultTwo);

             $price = $inv['UnitPrice'];
             $total += $price;
             } //end if statement


?>

<tr>
    <td><? echo $ID; ?></td>
    <td><? echo "  ", $EAUTH;?></td>
    <td><? echo " " , $title;?></td>
    <td><? echo $total;?></td>
    <td><? echo "  ", $summary;?></td>

    
<? } //end foreach loop ?>

</tr>
</table>

<p><strong>Total: $<? echo number_format($total,2,".",","); ?></strong></p>
<hr>
<p><strong>Please enter your information:</strong></p>

<form action = "http://localhost/williams-finalfive.php" method = "POST">
<p>Full Name:                 <input type = "text" name = "namebox" placeholder = "Jane Doe"></p>
<p>Street Address:         <input type = "text" name = "mailbox" size = "60" placeholder = "Street Address"></p>
<p>City:                        <input type = "text" name = "citybox" placeholder = "City"> State: <input type = "text" name = "statebox" placeholder = "TX"> Zip: <input type = "text" name = "zipbox" placeholder = "76306"></p>
<p>Phone:                     <input type "text" name = "phonebox" placeholder = "(555)-555-5555"></p>

<p><strong>Please enter your payment information: </strong><p>

<p>Credit Card Type:         <select name = "card">
          <option value = "mastercard">MasterCard</option>
          <option value = "amexp">American Express</option>
          <option value = "discover">Discover</option>
          <option value = "boa">Bank of America</option>
          <option value = "visa">Visa</option>
          <option value = "chase">Chase</option>
</select></p>
<p>Credit Card Number:      <input type = "text" name = "numbox" placeholder = "2345-987765-098977" maxlength = "18"></p>

<p><strong>If you would like updates on your shipping progress, you may also enter your e-mail address: </strong></p>
<p>E-mail Address:  <input type = "text" name = "email"></p>


<input type = "submit" value = "Confirm"><br>
<input type = "reset" value = "Reset"><br>
</form>

<form action = "http://localhost/williams-finalone.php">
<input type = "submit" value = "Back to Home">
</form>

</pre>
</body>
</html>
