<?php //namespace kvasile\week2;
include 'bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
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
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
         
         
        $email = filter_input(INPUT_POST, 'email');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');

        $emailTypes = $emailTypeDAO->getAllRows();
        
         
          if ( $util->isPostRequest() ) {
                            
                $validator = new Validator(); 
                $errors = array();
                if( !$validator->emailIsValid($email) ) {
                    $errors[] = 'E-mail is invalid.';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid.';
                }
                
                if ( empty($emailTypeid) ) {
                     $errors[] = 'E-mail type is invalid.';
                }
                
                
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p style="background-color:maroon;color:white;text-align:center;">',$value,'</p>';
                    }
                } else {
                    
                    
                    $emailModel = new EmailModel();
                    
                    $emailModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($emailtypeModel);
                    if ( $emailDAO->save($emailModel) ) {
                        echo '<div style="background-color:green;color:white;text-align:center;">E-mail added/updated.</div>';
                    } else {
                        echo '<div style="background-color:red;color:white;text-align:center;">E-mail not added/updated.</div>';
                    }
                    
                }
          }
        
        ?>

<table class="tg" style="table-layout: fixed; width: 50%; margin-top: 2%;">
<colgroup>
<col style="width: 689px">
</colgroup>
  <tr>
    <th class="tg-fasd">
  <h3>Manage E-Mails</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="manage-email.php">Manage E-mails </a> | <a href="manage-emailtype.php">Manage E-mail Types</a></td>
  </tr>
  
  <tr>
      <td class="tg-y8od">
          
          <div style="font-size:16px;font-weight:bold;padding-left:30px;padding-top:10px;">Add New</div>
          
          
        <form action="#" method="post" style="padding:25px 25px 25px 25px;">
            <label>E-mail:</label>            
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
            <table border="1" cellpadding="5">
                <tr>
                    <th>E-mail</th>
                    <th>E-mail Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows(); 
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td><td><a href="update-emails.php?id=',$value->getEmailid(),'">Update</a></td> <td><a href="delete.php?id=',$value->getEmailid(),'">Delete</a></td> </tr>';
            }
         ?>
            </table>          
          
          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Lab 2 - Advanced PHP SE396.57</footer>        
    </body>
</html>