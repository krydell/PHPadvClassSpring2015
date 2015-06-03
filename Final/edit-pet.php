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
$username = "Username";
$password = "Password";
if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
}
else { $username = $_SESSION['username']; }

        
             $dbConfig = array(
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>''
                );
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            $pet_id = filter_input(INPUT_GET, 'id'); 
            
        $petDAO = new PetDAO($db);
        $userDAO = new UserDAO($db);
        $petModel = new PetModel();
 
        $pets = $petDAO->getSpecificPet($pet_id);   
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
       header("Location: login.php");
       echo 'No name entered!';
   }
   else {
    $new_name = $_POST["name"];
       $query = "UPDATE pets SET pet_name = '$new_name' WHERE pet_id = '$pet_id'"; // add row
    
    $db->exec($query);       
    
    echo 'Done!';
   }
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
       <h1>Pet Renaming Page<i>!</i></h1>
<?php
       foreach ($pets as $value) {
           echo '<p>Name: <input type="text" name="name" value=', $value->getPetName(),'>';
           echo '<p>Species: <input type="text" name="species" value=', $value->getSpecies(),' readonly>';
          
       }
       
       /*<p>Species: <input type="password" name="pass" value="<?php echo $value->getSpecies(); ?>" readonly></p>
?>*/
     ?>   
       <br/>
        <form><input type="submit" name="submit" value="Rename!"> 
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>