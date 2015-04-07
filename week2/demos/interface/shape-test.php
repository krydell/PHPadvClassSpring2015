<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        include './IShapes.php';
        include './Square.php';
        include './Triagle.php';
        
        $square = new Square();
        $triangle = new Triangle();
        
        var_dump($square);
        var_dump($square instanceof IShapes);
        var_dump($triagle instanceof IShapes);
        
        
        
        ?>
    </body>
</html>
