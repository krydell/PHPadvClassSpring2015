 <?php

            $method = 'DELETE';
            
            $url = 'http://localhost/PHPadvClassSpring2015/week5/api/v1/phonetype/9';
            $data = array("Phonetype"=>'postest',"Active"=>0);
            
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        header("HTTP/1.1 200 OK");
echo CallAPI($method, $url, $data);
        
function CallAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            //curl_setopt($curl, CURLOPT_PUT, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
             if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
             }
            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "test:test");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    return $result;
}

           
            

