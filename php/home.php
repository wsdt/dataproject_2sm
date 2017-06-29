<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Blue Surface Seeker</title>
    <link href="../css/general.css" rel="stylesheet">

</head>
<body>
<?php
    if (empty($_POST)) {
        if (!empty($_COOKIE['username']) && !empty($_COOKIE['password'])) {
            $user = $_COOKIE['username'];
            $pwd = $_COOKIE['password'];
        } else {
            include_once 'db/dbNoAuthorization.php';
        }
    } else if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username']; //TODO: evtl escapen über php klasse dbEscapeStrings
        $pwd = $_POST['password'];

        setcookie("username",$user,time()+60*60*12); //Cookies laufen in 12h ab
        setcookie("password",$pwd,time()+60*60*12); //Cookies laufen in 12h ab
    } else {
        include_once 'db/dbNoAuthorization.php';
    }

    //Variables User and Password are used in following file
    include_once 'db/dbNewConnection.php'; //Connection can be only established when user and pwd are defined!

    // LOAD PAGE -------------------------------------------------------------------------------------------------

    echo "<h1>Success!!!!!</h1>";








    // LOAD PAGE END ----------------------------------------------------------------------------------------------

    //Close database connection and report an error if it did not work
    if(!mysqli_close($tunnel)) {
        echo "<p><strong style='color:#ff0000;'>PHP Error: </strong>Verbindung konnte nicht geschlossen werden.</p>";
    }

?>
</body>
</html>