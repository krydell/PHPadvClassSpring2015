<?php



spl_autoload_register(function($base) {    
    $baseName = explode( '\\', $base );
    $class = end( $baseName );     
    include '../../class/'.$class . '.php';
});


use App\Model\Service\ZIPCodeDAO;
use App\Model\Service\DB;

class MyAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);

        // Abstracted out for example
        /*
        $APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;
        */
    }

    /**
     * Example of an Endpoint
     */
     protected function example() {
        if ($this->method == 'GET') {
            return "Your name is " ;//. $this->User->name;
        } else {
            return "Only accepts GET requests";
        }
     }
     
      protected function zip() {
          
        $db = new DB();         
        $zip = new ZIPCodeDAO($db->getDB());        
        $zipfound = $zip->getById($this->request['Zipcode']);
        $db->closeDB();
        return $zipfound->getAll();
      }
     
     
     
 } 
 // Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}



$valid_passwords = array ("test" => "test");
$valid_users = array_keys($valid_passwords);

$user = ( array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : NULL );
$pass = ( array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : NULL );

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  echo json_encode(Array('error' => '401 Unauthorized'));
  exit();
}


try {   //filter_input(INPUT_GET, 'endpoint')
    $API = new MyAPI(filter_input(INPUT_GET, 'endpoint'), $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}