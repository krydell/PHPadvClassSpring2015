<?php include './bootstrap.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>E-mail Submission</title>
    </head>
    <body>
        
<?php 

// Create an e-mail class, and run the get-email function from it

$emailType = filter_input(INPUT_POST, 'emailtype');       

?>


        <h3>Add email type</h3>
        <form action="#" method="post">
            <label>E-mail Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>

<?php 

// Create an e-mail class, and run the get-email function from it

$em = new emailTypeDB();

$em ->saveEmails();

$em ->getEmails();

?>
   
    </body>
</html>