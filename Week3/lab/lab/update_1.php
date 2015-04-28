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
       
        $util = new Util();
        $validator = new Validator();
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
        
        
        $emailTypeDAO = new EmailTypeDAO($db);        
        $emailTypes = $emailTypeDAO->getAllRows();        
        
        $emailtypeModel = new EmailTypeModel();         
  
        
        
        if ( $util->isPostRequest() ) {
            //echo 'is post request';         
            
            $emailModel->map(filter_input_array(INPUT_POST));
            $emailid = filter_input(INPUT_GET, 'id');
            //$emailModel = $emailDAO->getById($emailid);  
            $active = $_POST['active']; 

            
            //echo $active;
                      
        } else {
            $emailid = filter_input(INPUT_GET, 'id');
            $emailModel = $emailDAO->getById($emailid);

            $emailTypeid = $emailModel->getEmailtypeid();        
            
            
        }
        
        
        //$emailid = $emailModel->getEmailtypeid();
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();  
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);
        
        if ( $emailDAO->idExisit(INPUT_GET, 'id') ) {
            //echo 'idexisit';
            $emailService->saveForm();
        }
        

        //else { echo 'noexist!'; }
        
        
        ?>
        
        
         <h3>Update E-mail</h3>
         <p><a href="email-test.php">Add E-mail </a> | <a href="update.php">Update E-mail</a> | <a href="emailtype-update.php">Update e-mail types</a></p>
         
        <form action="#" method="post">
             <input type="hidden" name="emailid" value="<?php echo $emailid; ?>" />
            <label>Email:</label> 
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <br /><br />
            <label>E-mail Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($emailTypes as $value) {
                    if ( $value->getEmailtypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
            <input type="submit" value="Submit" />
        </form>
        <br/>
         
         <?php         
             $emailService->displayEmailsActions();           
         ?>
         
         <p><a href="email-test.php">Go back.</a></p>
                  
    </body>
</html>