<?php
    include('php/setup.php');
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

    require_once 'php/Google/autoload.php';
    $client_id = 'CLIENT_ID';
    $client_secret = 'CLIENT_SECRET';
    $redirect_uri = 'REDIRECT_URI';
    
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope(array('profile', 'email'));

    $oauth = new Google_Service_Oauth2($client);

    if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    }

    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        $client->setAccessToken($_SESSION['access_token']);
    } else {
        $authUrl = $client->createAuthUrl();
        header("Location: " . $authUrl);
    }

    //Sign In Success
    if ($client->getAccessToken()) {
        $_SESSION['access_token'] = $client->getAccessToken();
        $token_data = $client->verifyIdToken()->getAttributes();
        $userData = $oauth->userinfo->get();

        if ($userData['hd'] == 'sooryen.com') {  
            $name = $userData['name'];
            $image = $userData['picture'];
            $domain = $userData['hd'];
            $id = $userData['id'];

            $_SESSION['user_id'] = $id;
            $insert = "INSERT INTO users (id, name, image_url, wins, losses, elo) VALUES('$id','$name','$image', 0, 0, 1400) ON DUPLICATE KEY UPDATE name='$name', image_url='$image';";
            $cxn->query($insert);
            header("Location: index.php");
        }
        else {
            header("Location: index.php?err=1");
        }
    }
?>