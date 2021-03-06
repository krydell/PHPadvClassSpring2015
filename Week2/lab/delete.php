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
        
             $dbConfig = array(
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>''
                );
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            $emailid = filter_input(INPUT_GET, 'id');
            
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            
            if ( NULL !== $emailid ) {
               $emailDAO = new EmailDAO($db);
               
               if ( $emailDAO->delete($emailid) ) {
                   
                   header( 'Location: ./manage-email.php' ) ;
          
               }               
            }
            
            if ( NULL !== $emailtypeid ) {
               $emailtypeDAO = new EmailTypeDAO($db);
               
               if ( $emailtypeDAO->delete($emailtypeid) ) {
                   
                   header( 'Location: ./manage-emailtype.php' ) ;
               }                
            }             
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
        ?>
    </body>
</html>