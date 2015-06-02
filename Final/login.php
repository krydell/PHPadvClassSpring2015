<!DOCTYPE html>


<html>
    
    <head>
<?php

include 'bootstrap.php';
// Inialize session

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve username and password from database according to user's input

    
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $util = new Util();        
        $validator = new Validator();            
    
   /* 
    if ( $num_rows > 0) {
    // Set username session variable
    $_SESSION['username'] = $_POST['username'];
    // Jump to secured page
    header('Location: index.php');
    }
    else {
    // Jump to login page
    header('Location: index.php');
    }*/
} 

?>
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
  <h3>Virtual Pet Center</h3></th>
  </tr>
      <td class="tg-qwer"><a href="index.php">Home</a> ★  
          <a href="profile.php">Profile</a> ★ <a href="adopt.php">Adopt</a> ★ <a href="login.php">Log-in</a> ★ <a href="logout.php">Log-out</a> </td>
  </tr>
  
  <tr>
      <td class="tg-y8od" style="font-size:16px;">
          <h1>Login / Register</h1>
          &nbsp;To log-in, input your credentials and hit login. If your do not have an account, you may create your login credentials by inputting them here and clicking submit all the same. Alternatively, to register, click the registration button!<br/><br/>
          
<form method="POST">

    <table><tr align="center">
    <trtr align="center"> <td>UserName</td><td> <input type="text" name="user"></td> </tr>
    <trtr align="center"> <td>Password</td><td> <input type="password" name="pass"></td> </tr>
        </table>
    <table>
    <tr> <td><input id="button" type="submit" name="submit" value="Submit"> </td> </tr> </form>
</table>
          

          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Advanced PHP SE396.57 Final - Karley Vasile</footer>        
    </body>
    
</html>
