
<?php //namespace kvasile\week2;
include 'bootstrap.php'



?>


<!DOCTYPE html>


<html>
    <head>

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <title>Index</title>
    </head>
    <body>

<?php
// define variables and set to empty values

session_start();

if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
}
    

/*if (!$_SESSION['username'])
{
    header("Location: login.php");
}*/

$username = "Username";
$password = "Password";
 
?>
<table class="tg" style="table-layout: fixed; width: 50%; margin-top: 2%;">
<colgroup>
<col style="width: 689px">
</colgroup>
  <tr>
    <th class="tg-fasd">
  <h3>Virtual Pet Center</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="index.php">Home</a> ★  
          <a href="profile.php">Profile</a> ★ <a href="adopt.php">Adopt</a> ★ <a href="login.php">Log-in</a> ★ <a href="logout.php">Log-out</a> </td>
  </tr>
  

  
  <tr>
      <td class="tg-y8od" style="font-size:16px;">
  <h1>Your Profile</h1>
       <img src="http://pngimg.com/upload/cat_PNG93.png" width="50%" align="right"><br/>                    
       <p>Username: <input type="text" name="name" value="<?php echo $username;?>" readonly></p>
       <p>Password: <input type="password" name="pass" value="<?php echo $password;?>" readonly></p>     

          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>