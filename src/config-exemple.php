<?php

$highway = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

//Database environment variables
define("DATABASE_HOST", "");
define("DATABASE_NAME", "");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "");

//Highways
define("BASE_URL", "/public");
define("HOME_PAGE", BASE_URL . "/home");
define("LOGIN_PAGE", BASE_URL . "/login");
define("COURSES_PAGE", BASE_URL . "/courses");
define("ROLES_PAGE", BASE_URL . "/roles");
define("PROMOTION_PAGE", BASE_URL . "/promotions");
define("USERS_PAGE", BASE_URL . "/users");