<?php include './bootstrap.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        <?php
        
        $util = new Util();
        
        $validator = new Validator();
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $errors = array();
        if ($util->isPostRequest()) {
            if (!$validator->emailTypeIsValid($emailType)) {
                $errors[] = 'E-mail type is not valid';
            }
        }
        if (count($errors) > 0) {
            foreach ($errors as $value) {
                echo '<p>', $value, '</p>';
            }
        } else {

            // Save the submission into the database. 
            
            $dbConfig = array(
                "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER" => 'root',
                "DB_PASSWORD" => ''
            );


            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");

            $values = array(":emailtype" => $emailType);
            if ($stmt->execute($values) && $stmt->rowCount() > 0) {
                echo 'E-mail Added';
            }
        }
        ?>

        <h3>Add email type</h3>
        <form action="#" method="post">
            <label>E-mail Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>



<?php 

$em = new emailTypeDB();

$em ->getEmails();

?>
    
         
         
         
    </body>
</html>