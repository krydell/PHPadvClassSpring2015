<?php //namespace kvasile\week2;
include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">           
        <title></title>
    </head>
    <body>
        <?php
        
/*
 * 
 * Login session.
 * 
 * 
 */
session_start();
$username = "Username";
$password = "Password";
if (!isset($_SESSION['username']))
{ 
    header("Location: login.php");
}

/*
 * 
 * If your username is valid, pet will be deleted.
 * 
 */

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
            
            /*
             * If your pet_id isn't null, it will delete it from the database.
             * 
             */
            if ( NULL !== $pet_id ) {
               $petDAO = new PetDAO($db);
               
               if ( $petDAO->delete($pet_id) ) {
                   
                   header( 'Location: profile.php' ) ;
          
               }               
            }
            
            
        
        ?>
    </body>
</html>