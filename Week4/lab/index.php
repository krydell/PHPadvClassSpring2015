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
  <h3>E-mails with a REST API</h3></th>
  </tr>
  <tr>
      <td class="tg-qwer">A demonstration of the REST API</td>
  </tr>
  
  <tr>
      <td class="tg-y8od">
                      

        <style type="text/css">
            textarea {
                width: 500px;
                height: 100px;
            }
            
            textarea[name="results"] {
                 height: 300px;
            }
        </style>
        
        
        Verb/HTTP Method:<br />
        <select name="verb">
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
        </select>
        <br />
        <br />
        Resource for endpoint:<br />
        <input name="resource" value="emailtypes/" />
        <br /><div style="color:grey; font-style: italic;">Both <b>emailtypes/</b> and <b>emails/</b> work.</div>
        <br />
        Data (optional):<br />        
        <textarea name="data">Emailtype=SampleTest&Active=1</textarea>
        <br />
        <br />
        <button>Make Call</button>
        <h2>Results</h2>
        
        <textarea name="results"></textarea>
        
        <script type="text/javascript">
        
            var callBtn = document.querySelector('button');
            
            callBtn.addEventListener('click', makeCall);
        
            function makeCall() {
                var verbfield = document.querySelector('select[name="verb"]');
                var verb = verbfield.options[verbfield.selectedIndex].value;
                var resource = document.querySelector('input[name="resource"]').value;
                var data = document.querySelector('textarea[name="data"]').value;            
                var results = document.querySelector('textarea[name="results"]');

                var xmlhttp = new XMLHttpRequest();

                var url = 'proxyAPI.php?resource=' + resource;

                xmlhttp.open(verb, url, true);

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4 ) {

                        console.log(xmlhttp.responseText);
                        results.value = xmlhttp.responseText;
                    } else {
                        // waiting for the call to complete
                    }
                };
                //var username = 'test';
               // xmlhttp.setRequestHeader("Authorization", "Basic " + btoa(username + ":"));

                 if ( verb === 'GET' ) {
                      xmlhttp.send(null);
                 } else {
                    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                    xmlhttp.send(data);
                }
            }
        </script>
          
      </td>

  </tr>
</table>        

        <footer style="margin-top:50px;bottom:0px;color:grey;text-align:center;">Lab 4 - Advanced PHP SE396.57</footer>        
    </body>
</html>
