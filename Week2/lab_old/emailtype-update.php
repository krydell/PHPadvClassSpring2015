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
        $emailTypeDAO = new EmailTypeDAO($db);
        
        
        $emailtypeModel = new EmailTypeModel();
        
        $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');

        
        if ( $util->isPostRequest() ) {
            if (null != $emailtypeid) { 
                $emailtypeModel = $emailTypeDAO->getById($emailtypeid);  
            $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailtypeModel);

                if ( $emailTypeDAO->idExisit($emailtypeModel->getEmailtypeid()) ) {
                    $emailTypeService->saveForm();
                }            
            }

            $emailtypeModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailtypeModel = $emailTypeDAO->getById($emailtypeid);
        }
        
        
        $emailtypeid = $emailtypeModel->getEmailtypeid();
        $emailType = $emailtypeModel->getEmailtype();
        $active = $emailtypeModel->getActive();  
              
        

        
        
        ?>
        
        
         <h3>Update E-mail Type</h3>
         <p><a href="email-test.php">Add E-mail </a> | <a href="update.php">Update E-mail</a> | <a href="emailtype-update.php">Update e-mail types</a></p>
         
        <form action="#" method="post">
             <input type="hidden" name="emailtypeid" value="<?php echo $emailtypeid; ?>" />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <input type="submit" value="Save" />
        </form><br/>
         
         
         <?php         
             $emailTypeService->displayEmailsActions();
                          
         ?>
         <p><a href="email-test.php">Go back.</a></p>                 
    </body>
</html>