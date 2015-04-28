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
         
        if ( $util->isPostRequest() ) {
            
            $emailtypeModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailtypeModel = $emailTypeDAO->getById($emailtypeid);
        }
        
        
        $emailtypeid = $emailtypeModel->getEmailtypeid();
        $emailType = $emailtypeModel->getEmailtype();
        $active = $emailtypeModel->getActive();  
              
        
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
  <h3>Update E-mail Type</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="manage-email.php">Manage E-mails </a> | <a href="manage-emailtype.php">Manage E-mail Types</a></td>
  </tr>
  
  <tr>
      <td class="tg-y8od"> 
          
          <div id="feedback"><?php echo $feedback; ?></div>          

        <form action="#" method="post" style="padding:25px 25px 25px 25px;">
             <input type="hidden" name="emailtypeid" value="<?php echo $emailtypeid; ?>" />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <input type="submit" value="Update" />
        </form><br/>
         
         
         <?php         
             $emailTypeService->displayEmailsActions();
                          
         ?>
          
      </td>

  </tr>
</table>   
        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Lab 3 - Advanced PHP SE396.57</footer>           
        
    </body>
</html>