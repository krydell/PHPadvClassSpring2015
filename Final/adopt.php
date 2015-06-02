
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


session_start();

if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
}
    
// define variables and set to empty values
/*
if (!$_SESSION['username'])
{
    header("Location: login.php");
}*/

$nameErr = $petErr = "";
$name = $pet = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["pet"])) {
     $petErr = "Species is required";
   } else {
     $pet = test_input($_POST["pet"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
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

       <h1>Adoption Center</h1>
       &nbsp;&nbsp;This is the adoption center. If you wish to register a pet, here is the place to do it!  <br/><br/>
       &nbsp;&nbsp;To adopt a pet, select the kind of animal you want, select a name, and click "Go!".<br/><br/>
       <table><tr>
               <td><img src="http://pngimg.com/upload/dog_PNG2407.png" width="100"/></td>
               <td><img src="http://pngimg.com/upload/cat_PNG100.png" width="100"/></td>
               <td><img src="http://pngimg.com/upload/rat_mouse_PNG2455.png" width="100"/></td>
               <td><img src="http://pngimg.com/upload/fish_PNG1157.png" width="100"/></td>
           </tr>
           <tr>
               <td width="100" align="center"><input type="radio" name="species" <?php if (isset($pet) && $pet=="Dog") echo "checked";?>  value="Dog"></td>
               <td width="100" align="center"><input type="radio" name="species" <?php if (isset($pet) && $pet=="Cat") echo "checked";?>  value="Cat"></td>
               <td width="100" align="center"><input type="radio" name="species" <?php if (isset($pet) && $pet=="Rat") echo "checked";?>  value="Rat"></td>
               <td width="100" align="center"><input type="radio" name="species" <?php if (isset($pet) && $pet=="Fish") echo "checked";?>  value="Fish"></td>
           </tr>
       </table>
       <table>
           <tr>
               <td width="432" style="padding: 10px;text-align:center;">Pet Name: <input type="text" name="name" value="<?php echo $name;?>"><br/>
                   <span class="error"><?php echo $nameErr;?></span><br/><br/>
               <input type="submit" name="submit" value="Go!"> </td>
           </tr></table>      

          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>