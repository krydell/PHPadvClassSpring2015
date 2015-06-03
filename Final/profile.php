
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
$username = "Username";
$password = "Password";
if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
}
else { $username = $_SESSION['username']; }
    
    

/*if (!$_SESSION['username'])
{
    header("Location: login.php");
}*/


 

        $dbConfig = array( // Database setup to interact with DB
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig); // Making databae..
        $db = $pdo->getDB();
        
        $util = new Util();        
        $validator = new Validator();        
        
        $petDAO = new PetDAO($db); // Creating pet 
        $userDAO = new UserDAO($db);
        $petModel = new PetModel();
 
        $pets = $petDAO->getUsersPets($username);    // Get the pets based on the user that is currently logged in     
        
  
        
        /* 
        $email = filter_input(INPUT_POST, 'email');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        */
     


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
       <p>Username: <input type="text" name="name" value="<?php echo $username;?>" readonly></p>
       <p>Password: <input type="password" name="pass" value="<?php echo $password;?>" readonly></p>
       <hr>
       <h1>Your Pets</h1>
<?php         
                    
           /* echo $phoneTypes[0]->getPhonetype();
            echo $phoneTypes[1]->getPhonetype();
            echo $phoneTypes[2]->getPhonetype();
            */

            foreach ($pets as $value) { // Determine what image to display
                if($value->getSpecies()=="Dog") // If species is a dog, show dog image
                {echo '<p><img src="http://pngimg.com/upload/dog_PNG2407.png" width="100"/>';}
                if($value->getSpecies()=="Cat") // Etc...
                {echo '<p><img src="http://pngimg.com/upload/cat_PNG100.png" width="100"/>';}
                if($value->getSpecies()=="Rat")
                {echo '<p><img src="http://pngimg.com/upload/rat_mouse_PNG2455.png" width="100"/>';}
                if($value->getSpecies()=="Fish")
                {echo '<p><img src="http://pngimg.com/upload/fish_PNG1157.png" width="100"/>';}
                // Then, echo the pet's statistics, and links to update and delete
                echo '<p><b>Pet Name:</b> ',$value->getPetname(),'</p>';
                echo '<p><b>Species:</b> ',$value->getSpecies(),'</p>';
                echo '<a href="edit-pet.php?id=',$value->getPetID(),'">Rename ',$value->getPetname(), '</a> | ';
                echo '<a href="delete-pet.php?id=',$value->getPetId(),'">Abandon ',$value->getPetname(), '</a>';

             }
           
            
           // var_dump($phoneTypes);
            
            /*
             * 
             * Why do this here when you can create a service class to do this for you
             
            
            if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($phoneTypes as $value) {
                    echo '<p>',$value['phonetype'],'</p>';
                }
            } else {
                echo '<p>No Data</p>';
            }
             * 
             */
         ?>
          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>