<!DOCTYPE html>


<html>
    
    <head>
<?php

include 'bootstrap.php';
// Inialize session

session_start();
$error = "";
$user = "";
$pw = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = "";
    $user = "";
    $pw = "";

    
    
    // Retrieve username and password from database according to user's input
    if(isset($_POST['user'])){ $user = $_POST['user']; } // take all the inputted fields
    else{$error = "Input a username.";}
        
    if(isset($_POST['pw'])){ $pw = $_POST['pw'];}
    else{$error = "Input a password.";}
    
    if($error != "")
    { 
        echo $error;
        return; }
    
        
    if($user == "testme")
    { $_SESSION['username'] = $user;
      header("Location: index.php");
    }
    
    
    
    
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
          &nbsp;To log-in, input your credentials and hit submit. If your do not have an account, you may create your login credentials by inputting them here and clicking submit all the same. Alternatively, to register, click the registration button!<br/><br/>
          <br/>The sample account is named "testme" and doesn't need a password.<br/><br/>
<form method="POST">

    <table>
    <trtr align="center"> <td>UserName</td><td> <input type="text" name="user"></td> </tr>
    <trtr align="center"> <td>Password</td><td> <input type="password" name="pw"></td> </tr>
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
