<?php
/**
 * Description of Config
 *
 * @author User
 */
namespace App\Model\Service;
class Config {
        
     const  DB_DNS = "mysql:host=localhost;port=3306;dbname=phpclass",
            DB_USER  = "root",
            DB_PASSWORD  = "",
            PAGE_KEY = "page",
            SESSION_KEY = "user",
            INDEX_PAGE = "index",
            DEFAULT_PAGE = "index",
            DEFAULT_PAGE_TITLE = "",
            FRAMEWORK_CLASSES_DIR = "framework/classes/",
            APPLICATION_CLASSES_DIR = "application/classes/",
            WEB_LAYOUT_DIR = "application/web/layout/",
            WEB_SCRIPT_DIR = "application/web/scripts/",
            WEB_PAGE_DIR = "application/web/page/";
}
