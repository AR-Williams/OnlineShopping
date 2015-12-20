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
<!--FILENAME: williams-finaltwo.php--->
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

     if(empty($_POST['depart'])){
         die("<p>Whoops! You didn't select the department you wanted to view! Press the back button and try again.</p>");
     }


function header_title(){
    foreach($_POST['depart'] as $value){
        $header = $value;
    }
return $header;
}


//set up the first query
foreach($_POST['depart'] as $dept){
     $query = "SELECT ID, entertainerauthor, title, media, feature FROM products WHERE department = '$dept' ORDER BY entertainerauthor;";
}

$result = mysqli_query($link, $query);
?>
<h1>Bob's Entertainment Universe</h1>
<h2><? echo header_title(); ?> Department</h2>

<p>Here is the list of items available in this department.</p>
<p>To learn more information about the items you are interested in, simply select the item and submit.</p>

<table>
<tr>
    <th>ID Number</th>
    <th>Entertainer/Author</th>
    <th>Title</th>
    <th>Media</th>
    <th>Feature</th>
</tr>

<? //start up while loop to process the query results
while($prod_row = mysqli_fetch_assoc($result)){
    $ID = $prod_row['ID'];
    $EAUTH = $prod_row['entertainerauthor'];
    $title = $prod_row['title'];
    $media = $prod_row['media'];
    $feature = $prod_row['feature'];
?>

<form action = "http://localhost/williams-finalthree.php" method = "POST">
<tr>
    <td><input type= "checkbox" name= "select[]" value= "<? echo $ID; ?>"><? echo $ID ?></td>
    <td><? echo " ", $EAUTH; ?></td>
    <td><? echo " ", $title ?></td>
    <td><? echo " ", $media ?></td>
    <td><? echo " ", $feature ?></td>
</tr>

<?
} //end while loop ?>
</table>

<input type = "submit" value = "submit"><br>
<input type = "reset" value = "reset"><br>
</form>

<form action = "http://localhost/williams-finalone.php">
<input type = "submit" value = "Back to Home">
</form>

<? mysqli_close($link); ?>

</pre>
</body>
</html>
