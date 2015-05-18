<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        $util = new Util();
        
        $phoneType = filter_input(INPUT_POST, 'phonetype');
        
        if ( !empty($phoneType) ) {
            echo 'Phone type is good';
        } else {
            echo 'Phone type is empty';
        }
        
        //phpinfo();
        ?>
        
        <h3>Add phone type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label>
            <input type="text" name="phonetype" value="<?php"
        
        
    </body>
</html>
