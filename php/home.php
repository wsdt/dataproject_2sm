<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Blue Surface Seeker</title>
    <link href="../css/general.css" rel="stylesheet">

</head>
<body>
<?php
    if (empty($_REQUEST) || empty($_COOKIE)) {
        if (!empty($_COOKIE['username']) && !empty($_COOKIE['password'])) {
            $user = $_COOKIE['username'];
            $pwd = $_COOKIE['password'];
        } else {
            include_once 'database/dbNoAuthorization.php';
        }
    } else if (!empty($_POST['username']) && !empty($_POST['$pwd'])) {
        $user = $_POST['username']; //TODO: evtl escapen über php klasse dbEscapeStrings
        $pwd = $_POST['password'];
        setcookie("username",$user,time()+60*60*12); //Cookies laufen in 12h ab
        setcookie("password",$pwd,time()+60*60*12); //Cookies laufen in 12h ab
    }

    include_once 'database/dbNewConnection.php'; //Connection can be only established when user and pwd are defined!

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