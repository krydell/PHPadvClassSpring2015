<?php include './bootstrap.php'; ?>
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
       
        $util = new Util();
        $validator = new Validator();
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
         
        if ( $util->isPostRequest() ) {
            
            $emailModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailid = filter_input(INPUT_GET, 'id');
            $emailModel = $emailDAO->getById($emailid);
        }
        
        
        $emailid = $emailModel->getEmailtypeid();
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();  
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);
        
        if ( $emailDAO->idExisit($emailModel->getEmailtypeid()) ) {
            $emailService->saveForm();
        }
        
        
        ?>
        
        
         <h3>Update E-mail</h3>
        <form action="#" method="post">
             <input type="hidden" name="emailid" value="<?php echo $emailid; ?>" />
            <label>Email:</label> 
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             $emailService->displayEmailsActions();           
         ?>
         
         <p><a href="email-test.php">Go back.</a></p>
                  
    </body>
</html>