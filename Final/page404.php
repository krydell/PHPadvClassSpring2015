<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8">
        <title>404 Error</title>
    </head>
    <body>

<table class="tg" style="table-layout: fixed; width: 50%; margin-top: 2%;">
<colgroup>
<col style="width: 689px">
</colgroup>
  <tr>
    <th class="tg-fasd">
  <h3>Virtual Pet Center</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer"><a href="index">Home</a> ★  
          <a href="profile">Profile</a> ★ <a href="adopt">Adopt</a> ★ <a href="login">Log-in</a> ★ <a href="logout">Log-out</a> </td>
  </tr>
  
  <tr>
      <td class="tg-y8od" align="center">
                      
                 <h3 style="color: black;">404<i>!</i></h1>           
         <?php
            echo $scope->view['error'];
         ?> 
          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
</html>

