<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <title>Index</title>
    </head>
    <body>

<table class="tg" style="table-layout: fixed; width: 50%; margin-top: 2%;">
<colgroup>
<col style="width: 689px">
</colgroup>
  <tr>
    <th class="tg-fasd">
  <h3>E-mail Database Manager</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="email">Manage E-mails </a> |  
          <a href="emailtype">Manage E-mail Types</a></td>
  </tr>
  
  <tr>
      <td class="tg-y8od">
                      

        <?php
        // put your code here
                
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'E-mail added!';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'E-mail deleted!';
             }
             
         }
        
            $email = $scope->view['model']->getEmail();
            $active = $scope->view['model']->getActive();
            $emailTypeid = $scope->view['model']->getEmailtypeid();
        ?>
        
        <h2>Add email</h2>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Email Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($scope->view['emailTypes'] as $value) {
                    if ( $value->getEmailtypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        </form>
        
        
        
         <br />
         <br />
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
        
         <?php 
         
          if ( count($scope->view['emails']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="5"><tr><th>Email</th><th>Email Type</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['emails'] as $value) {
                    echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                    echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getEmailid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getEmailid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Lab 3 - Advanced PHP SE396.57</footer>        
    </body>
</html>


