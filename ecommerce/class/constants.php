<?php
error_reporting(0);
define("COMPANY_NAME","The Uppal Store");
define("COMPANY_MAIL","test@website.com");

define("SERVER_NAME","localhost");
define("USER_NAME","root");
define("USER_PASSWORD","");
define("DATABASE_NAME","tarunuppalshop");
define("BASE_URL","/ecommerce/");
define("WEBSITE_URL","http://" . $_SERVER['HTTP_HOST'] . BASE_URL);
define("UPLOADS_URL",WEBSITE_URL."products/");
define("UPLOADS_PATH",$_SERVER['DOCUMENT_ROOT'].BASE_URL."products/");

define("ADMIN_URL",WEBSITE_URL."myadmin/");