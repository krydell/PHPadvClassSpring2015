
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

/*
 * 
 * Sessions begin
 */

session_start();

if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
}
else {$username = $_SESSION['username'];}
    
// define variables and set to empty values
/*
if (!$_SESSION['username'])
{
    header("Location: login.php");
}*/



$nameErr = $petErr = "";
$name = $pet = "";

        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
/*
 * Upon posting...
 * 
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) { // Checks to make sure name isn't blank
     $nameErr = "<font color=\"red\">Name is required</font>.";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "<font color=\"red\">Only letters and white space allowed</font>"; 
     }
   }
   
   if (empty($_POST["pet"])) { // Checks to make sure species isn't blank
     $petErr = "<font color=\"red\">Pet choice is required.</font>";
   } else {
     $pet = test_input($_POST["pet"]);
   }
   
   if($petErr == "" && $nameErr == "")
   {
       
           /*           
$petModel = new PetModel();
$petDAO = new PetDAO($db);                    
$petModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($emailtypeModel);
if ( $petDAO->save($petModel) ) {
                        echo '<div style="background-color:green;color:white;text-align:center;">E-mail added/updated.</div>';
                    } else {
                        echo '<div style="background-color:red;color:white;text-align:center;">E-mail not added/updated.</div>';
                    }    
   } */
       // If it all checks out, insert
    $query = "INSERT INTO pets
                 (pet_id, pet_name, species, happy, hungry, owner)
              VALUES
                 ('', '$name','$pet', 10, 100, '$username');"; // add row
    
    $db->exec($query);
       
       echo "<div style=\"background-color:white;text-align:center;\">Pet adopted!</div>";
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
       <table><tr><td width="442" style="border: none;text-align:center;"><span class="error"><?php echo $petErr;?></span></td></tr></table>
       <table>
           
       <form action="#" method="post">    
           <tr>
               <td><img src="http://pngimg.com/upload/dog_PNG2407.png" width="100"/></td>
               <td><img src="http://pngimg.com/upload/cat_PNG100.png" width="100"/></td>
               <td><img src="http://pngimg.com/upload/rat_mouse_PNG2455.png" width="100"/></td>
               <td><img src="http://pngimg.com/upload/fish_PNG1157.png" width="100"/></td>
           </tr>
           <tr>
               <td width="100" align="center"><input type="radio" name="pet" <?php if (isset($pet) && $pet=="Dog") echo "checked";?>  value="Dog"></td>
               <td width="100" align="center"><input type="radio" name="pet" <?php if (isset($pet) && $pet=="Cat") echo "checked";?>  value="Cat"></td>
               <td width="100" align="center"><input type="radio" name="pet" <?php if (isset($pet) && $pet=="Rat") echo "checked";?>  value="Rat"></td>
               <td width="100" align="center"><input type="radio" name="pet" <?php if (isset($pet) && $pet=="Fish") echo "checked";?>  value="Fish"></td>
           </tr>
       </table>
       <table>
           <tr>
               <td width="432" style="padding: 10px;text-align:center;">Pet Name: <input type="text" name="name" value="<?php echo $name;?>"><br/>
                   <span class="error"><?php echo $nameErr;?></span><br/><br/>
                   <form><input type="submit" name="submit" value="Go!"> </td>
           </tr></table>      
</form>
          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>