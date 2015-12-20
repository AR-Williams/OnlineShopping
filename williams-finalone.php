<!DOCTYPE HTML>
<html>
<head>
       <title>Bob's Entertainment Universe</title>
<style>
       body {background-color:#9900FF;}
       h1 {color:#66FFFF; font-family:"Lucida Sans Unicode"}
       h2{font-family:"Verdana"}
	   p {font-family:"Verdana"; font-size: 13px;}
       table {border: 3px solid black;, width:50%;}
       td {font-family:"Geneva", text-align: center; font-size: 13px;, width:100%;}
</style>
<!--FILENAME: williams-finalone.php--->
<!--PROGRAMMER: Alexis Williams--->
<!--PURPOSE: Presents the departments for the user to choose from-->
</head>
<body>
<h1>Bob's Entertainment Universe</h1>
<?php
     extract($_POST);

     $link = mysqli_connect("localhost", "root", "s1r3nb1u3s");
     if(!$link){
         die("Could not connect to server." . mysqli_connect_error());
     }

     if(!mysqli_select_db($link, "cpt283db")){
         die("Issues with the database." . mysqli_connect_error());
     }


?>

<form action = "http://localhost/williams-finaltwo.php" method = "POST">
<p>Here is a list of all our current departments of media! Take your pick!</p>

<?
     $query = "SELECT DISTINCT department FROM products";
     $q_results = mysqli_query($link, $query);

//start up while loop to iterate the department listings
     while($dept_list = mysqli_fetch_assoc($q_results)){
         $department = $dept_list['department'];
?>

<p><input type = "radio" name = "depart[]" value = "<? echo $department; ?>"><? echo $department; ?></p>

<?
} //end while loop

?>

<input type = "submit" value = "submit"><br>
<input type = "reset" value = "reset"><br>
</form>

<? mysqli_close($link); ?>

</body>
</html>
