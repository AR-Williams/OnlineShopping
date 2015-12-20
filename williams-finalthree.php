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
<!--FILENAME: williams-finalthree.php--->
<!--PROGRAMMER: Alexis Williams--->
<!--PURPOSE: Displays the department's respective data-->
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

     if(empty($_POST['select'])){
         die("<p>Oh! You have no items selected for purchase. If you are still interested, please press the back button and try again.</p>");
     }


//foreach loop to generate respective header titles of the departments
foreach($_POST['select'] as $value){
    $h_query = "SELECT department FROM products WHERE ID = '$value'";
    $h_result = mysqli_query($link, $h_query);
}

$header = mysqli_fetch_assoc($h_result);
$header_title = $header['department'];

?>



<h1>Bob's Entertainment Universe</h1>
<h2><? echo $header_title; ?> Department</h2>
<h3>Shopping Cart</h3>
<p><strong>Please select any or all items that you would like to purchase.
When you are ready, press the "Buy" button below and enter your payment details to purchase.</strong></p>

<table>
<tr>
    <th>ID Number</th>
    <th>Entertainer/Author</th>
    <th>Title</th>
    <th>Price</th>
    <th> In Stock</th>
    <th>Summary</th>
</tr>

<?

foreach($_POST['select'] as $item){
    $prod_query = "SELECT ID, entertainerauthor, title, summary FROM products WHERE ID = '$item' ORDER BY entertainerauthor";
    $prod_result = mysqli_query($link, $prod_query);

    $inv_query = "SELECT UnitsInStock, UnitPrice FROM prodinv WHERE ID = '$item'";
        if($prod_result){
            $prod_info = mysqli_fetch_assoc($prod_result);

             $ID = $prod_info['ID'];
             $EAUTH = $prod_info['entertainerauthor'];
             $title = $prod_info['title'];
             $summary = $prod_info['summary'];

             $inv_result = mysqli_query($link, $inv_query);
             $prodinv_row = mysqli_fetch_assoc($inv_result);



?>
<form action = "http://localhost/williams-finalfour.php" method = "POST">
<tr>
    <td><input type= "checkbox" name = "choice[]" value="<? echo $ID;?>"><? echo $ID;?></td>
    <td><? echo $EAUTH;?></td>
    <td><? echo " " , $title;?></td>
    <td><? echo $prodinv_row['UnitPrice'];?></td>
    <td><? echo "  ", $prodinv_row['UnitsInStock'];?></td>
    <td><? echo "  ", $summary;?></td>
</tr>
<?
} //end if statement

} //end foreach loop

?>

</table>

<p>

<input type = "submit" value = "Buy"><br>
<input type = "reset" value = "Reset"><br>
</form>

<form action = "http://localhost/williams-finalone.php">
<input type = "submit" value = "Back to Home">
</form>

</pre>
</body>
</html>
