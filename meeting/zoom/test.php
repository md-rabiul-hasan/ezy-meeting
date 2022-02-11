<?php  

session_start();

require __DIR__ . '/vendor/autoload.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'woz4EgVS3y6zKG6xUz3w',
    'clientSecret'            => 'n7canokWtfwVpK7925atgKhOvA43B6nZ',
    'redirectUri'             => 'http://localhost/teste_oauth2/',
    'urlAuthorize'            => 'https://zoom.us/oauth/authorize',
    'urlAccessToken'          => 'https://zoom.us/oauth/token',
    'urlResourceOwnerDetails' => 'https://api.zoom.us/v2/users/me'
]);


// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {    
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    $_SESSION['oauth2state'] = $provider->getState();

    // Redirect the user to the authorization URL.
    header('Location: ' . $authorizationUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} 
elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    try {

        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $request = $provider->getAuthenticatedRequest(
            'GET',
            'https://api.zoom.us/v2/users/email',
            $accessToken,
            ['email' => 'meuemail@gmail.com']
        );


        var_dump($provider->getResponse($request));
        die('aqui');

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        // Failed to get the access token or user details.
        echo $e->getMessage();
        exit;

    }
}

?>
As you can see, I am passing the email on the request. But I am getting the Fatal error: Uncaught G