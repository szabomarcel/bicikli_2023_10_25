<?php

switch ($menu) {
    case 'felhasznalo':
        require_once './login/felhasznalo.php';
        break;
    case 'logout':
        require_once './login/logout.php';
        break;
    case 'vendeg':
        require_once './login/vendeg.php';
        break;
    case 'login':
        require_once './login/login.php';
        break;
    case 'regisztracio':
        require_once './login/regisztracio.php';
        break;
    case 'rolunk':
        require_once './login/rolunk.php';
        break;
    case 'home':
        if ($id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)) {
            require_once './login/kivalasztottkerekpar.php';
        } else {
            require_once './login/home.php';
        }
        break;
    default:
        require_once './login/home.php';
        break;
}