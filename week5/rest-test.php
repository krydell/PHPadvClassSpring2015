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
        
        <script type="text/javascript">
        
             var xmlhttp = new XMLHttpRequest();
             
             //xmlhttp.open('POST', './api/v1/phonetype', true);
            //xmlhttp.open('POST', './restserver-test.php', true);
            xmlhttp.open('DELETE', './api/v1/phonetype/7', true);
            //xmlhttp.open('PUT', './api/v1/phonetype', true);
             
             xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
	
                    console.log(xmlhttp.responseText);
                } else {
                    // waiting for the call to complete
                }
            };

            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  
            xmlhttp.send('phonetypeid=7&Phonetype=postest&Active=1');


/*

            var xmlhttp2 = new XMLHttpRequest();
             
             //xmlhttp2.open('GET', './php-rest-test.php?Zipcode=00604', true);
             xmlhttp2.open('GET', './api/v1/phonetype/1', true);
             
             xmlhttp2.onreadystatechange = function() {
                if (xmlhttp2.readyState === 4 && xmlhttp2.status === 200) {
	
                    console.log(xmlhttp2.responseText);
                } else {
                    // waiting for the call to complete
                }
            };

            // Make the actual request
            
            xmlhttp2.send(null);
        */
        
        </script>
        
        
        <?php
        // put your code here
        
        var_dump(function_exists('password_hash'));
        ?>
    </body>
</html>
