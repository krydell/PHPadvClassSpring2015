<?php

/**
 * Description of TestController
 *
 * @author 001314368
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class TestController extends BaseController implements IController {
    //put your code here
    
    public function execute(IService $scope) {
    
        $this->data['test1'] = 'hello';
        $this->data['test2'] = 'world';
        
        $scope->view = $this->data;
        $page = 'test';
        $this->view($page, $scope);
    }
}
