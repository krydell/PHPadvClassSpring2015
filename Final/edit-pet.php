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

        
             $dbConfig = array( // Set up DB
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
        
if ($_SERVER["REQUEST_METHOD"] == "POST") { // If it's a post...
   if (empty($_POST["petname"])) {
       echo '<div style="text-align:center;background-color:red;">No name entered!</div>';
   }
   else {
       
    $new_name = $_POST["petname"];
    
    //echo $new_name;
       $query = "UPDATE pets SET pet_name = '$new_name' WHERE pet_id = '$pet_id'"; // add row
    
    $db->exec($query);       
    
    header("Location: profile.php");;
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
       <img src="http://downloads.alteryx.com/Alteryx/Help/DynamicRename.png" width="30%" align="right"><br/> 
       <h1>Pet Renaming Page<i>!</i></h1>
       <form action="#" method="post">
<?php
       foreach ($pets as $value) {
                if($value->getSpecies()=="Dog") // If species is a dog, show dog image
                {echo '<p><img src="http://pngimg.com/upload/dog_PNG2407.png" width="100"/>';}
                if($value->getSpecies()=="Cat") // Etc...
                {echo '<p><img src="http://pngimg.com/upload/cat_PNG100.png" width="100"/>';}
                if($value->getSpecies()=="Rat")
                {echo '<p><img src="http://pngimg.com/upload/rat_mouse_PNG2455.png" width="100"/>';}
                if($value->getSpecies()=="Fish")
                {echo '<p><img src="http://pngimg.com/upload/fish_PNG1157.png" width="100"/>';}
                echo '<p>Name: <input type="text" name="petname" value=', $value->getPetName(),'>';
                echo '<p>Species: <input type="text" name="species" value=', $value->getSpecies(),' readonly>';
          
       }
       
       /*<p>Species: <input type="password" name="pass" value="<?php echo $value->getSpecies(); ?>" readonly></p>
?>*/
     ?>   
       <br/><br/>
       <input type="submit" name="submit" value="Rename!"> </form>
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>