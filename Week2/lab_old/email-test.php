<?php //namespace kvasile\week2;
include './bootstrap.php'; ?>
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
        
        
        $email = filter_input(INPUT_POST, 'email');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        
         $emailTypeDAO = new EmailTypeDAO($db);
         $emailDAO = new EmailDAO($db);
         
         $emailTypes = $emailTypeDAO->getAllRows();
        
         $util = new Util();
         
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
                        echo '<p>',$value,'</p>';
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
        
         <h3>Add E-mail</h3>
         <p><a href="email-test.php">Add E-mail </a> | <a href="update.php">Update E-mail</a> | <a href="emailtype-update.php">Update e-mail types</a></p>
        <form action="#" method="post">
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
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td><td><a href="update.php?id=',$value->getEmailid(),'">Update</a></td> <td><a href="delete.php?id=',$value->getEmailid(),'">Delete</a></td> </tr>';
            }
         ?>
            </table>
         
        
    </body>
</html>