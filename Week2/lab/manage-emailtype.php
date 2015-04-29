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
        
        $feedback="";        
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
        
        $emailtypeid = $emailtypeModel->getEmailtypeid();
        $emailType = filter_input(INPUT_POST, 'emailtype');  
        $active = filter_input(INPUT_POST, 'active');   
 
         
        if ( $util->isPostRequest() ) {
            
                $validator = new Validator(); 
                $errors = array();
                
                if ( !$validator->emailTypeIsValid($emailType) ) {
                     $errors[] = 'E-mail type,' .$emailType. ' invalid.';
                }      
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid.';
                }            
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p style="background-color:maroon;color:white;text-align:center;">',$value,'</p>';
                    }
                } else {
                    $emailtypeModel = new EmailTypeModel();
                    
                    $emailtypeModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($emailtypeModel);
                    if ( $emailTypeDAO->save($emailtypeModel) ) {
                        echo '<div style="background-color:green;color:white;text-align:center;">E-mail type added/updated.</div>';
                    } else {
                        echo '<div style="background-color:red;color:white;text-align:center;">E-mail type not added/updated.</div>';
                    }
                                      
                }            
            
            //$emailtypeModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailtypeModel = $emailTypeDAO->getById($emailtypeid);
        }
        
        $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailtypeModel);
        
        if ( $emailTypeDAO->idExisit($emailtypeModel->getEmailtypeid()) ) {
            $emailTypeService->saveForm();
        }
        
        
        ?>
        
<table class="tg" style="table-layout: fixed; width: 50%; margin-top: 2%;">
<colgroup>
<col style="width: 689px">
</colgroup>
  <tr>
    <th class="tg-fasd">
  <h3>Manage E-Mail Types</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="manage-email.php">Manage E-mails </a> | <a href="manage-emailtype.php">Manage E-mail Types</a></td>
  </tr>
  
  <tr>
      <td class="tg-y8od">
          <div style="font-size:16px;font-weight:bold;padding-left:30px;padding-top:10px;">Add New</div>          
          <div id="feedback"><?php echo $feedback; ?></div>          
     
        <form action="#" method="post" style="padding:25px 25px 25px 25px;">
             <input type="hidden" name="emailtypeid" value="<?php echo $emailtypeid; ?>" />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <input type="submit" value="Submit" />
        </form><br/>
         
         
         <?php         
             $emailTypeService->displayEmailsActions();          
         ?>
         

      </td>

  </tr>
</table>   
        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Lab 2 - Advanced PHP SE396.57</footer>   
    </body>
</html>