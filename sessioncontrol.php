<?php

function checkSession() {
    session_start();

    $url = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
    
    if ($url == "index.php") {
        if (isset($_SESSION['user'])) {
            header("Location: ./panel/static/panel.php");
        } else {
            if ($alert = checkLoginError()) {
                return $alert;
            }
        }


    } else {
       if (!isset($_SESSION['user'])) {
            header("Location: ./index.php");
        }
    }
}



function validateUser() {
    // Start session
    session_start();

    $user = $_POST['user'];
    $password = $_POST['password'];

    if (checkUser($user, $password)) {
        $_SESSION['user'] = $user;
        header("Location: ./panel/static/panel.php");
    } else {
        $_SESSION["loginError"] = "Invalid username or password!";
        header("Location: ./index.php");
    }

}

function checkUser(string $user, string $password) {
    $dbuser = "victor";
    $dbpassword = "121212";
    $dbpasswordEncoded = password_hash($dbpassword, PASSWORD_DEFAULT);

    if($dbuser == $user && password_verify($password, $dbpasswordEncoded)) return true;
    else return false;
}


function checkLoginError() {
    if (isset($_SESSION["loginError"])) {
       $infoText = $_SESSION["loginError"];
       unset($_SESSION["loginError"]);
       return ["text" => $infoText];
    }
}

function closeSession() {
    // Start session
    session_start();

    // unset all session variables
    unset($_SESSION);

    // destroy session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // destroy the session
    session_destroy();
    header("Location: index.php");
}