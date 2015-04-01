<?php include './bootstrap.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
 
<?php 

// Create an e-mail class, and run the get-email function

$emailType = filter_input(INPUT_POST, 'emailtype');

$em = new emailTypeDB();

$em ->saveEmails();

$em ->getEmails();

?>

        <h3>Add email type</h3>
        <form action="#" method="post">
            <label>E-mail Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>



    
         
         
         
    </body>
</html>