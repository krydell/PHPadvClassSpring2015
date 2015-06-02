<!DOCTYPE html>
<?php //namespace kvasile\week2;
include 'bootstrap.php'; ?>
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
$welcomemsg="";

if ($_SESSION['username'])
{
    $welcomemsg = "Welcome, " + $_SESSION['username'];
}

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
       <img src="http://pngimg.com/upload/dog_PNG2453.png" width="30%" align="right"><br/>       
       <?php echo $welcomemsg; ?>
       &nbsp;&nbsp;Welcome to the Virtual Pet Center, a project made for Gabe Forti's Advanced PHP class!  <br/><br/>
       &nbsp;&nbsp;To get started, register for an account, and then head over to the adopt page. After you adopt your pet, you can go to your profile to interact with it. 
       

          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>