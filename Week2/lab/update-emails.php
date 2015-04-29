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
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
        
        
        $emailTypeDAO = new EmailTypeDAO($db);        
        $emailTypes = $emailTypeDAO->getAllRows();        
        
        $emailtypeModel = new EmailTypeModel();         
  
        
        
        if ( $util->isPostRequest() ) {    
            
            $emailModel->map(filter_input_array(INPUT_POST));
            $emailid = filter_input(INPUT_GET, 'id');
            
            $active = $_POST['active']; 

            
                      
        } else {
            $emailid = filter_input(INPUT_GET, 'id');
            $emailModel = $emailDAO->getById($emailid);

            $emailTypeid = $emailModel->getEmailtypeid();        
            
            
        }
        
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();  
              
        
        $emailService = new EmailService($db, $util, $validator, $emailDAO, $emailModel);
        
        if ( $emailDAO->idExisit(INPUT_GET, 'id') ) {

            $emailService->saveForm();
        }

        
        
        ?>
 <table class="tg" style="table-layout: fixed; width: 50%; margin-top: 2%;">
<colgroup>
<col style="width: 689px">
</colgroup>
  <tr>
    <th class="tg-fasd">
  <h3>Update E-Mails</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="manage-email.php">Manage E-mails </a> | <a href="manage-emailtype.php">Manage E-mail Types</a></td>
  </tr>
  
  <tr>
      <td class="tg-y8od"> 
          
          <div style="font-size:16px;font-weight:bold;padding-left:30px;padding-top:10px;">Update Existing</div>          
          
          <div id="feedback"><?php echo $feedback; ?></div>          
            
        <form action="#" method="post" style="padding:25px 25px 25px 25px;">
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
            
            <input type="submit" value="Update" />
        </form>
        <br/>
         
         <?php         
             $emailService->displayEmailsActions();           
         ?>
      </td>

  </tr>
</table>  
         <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Lab 2 - Advanced PHP SE396.57</footer>          
        
    </body>
</html>