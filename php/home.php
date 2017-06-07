<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Blue Surface Seeker</title>
    <link href="../css/general.css" rel="stylesheet">

</head>
<body>
<?php
    if (empty($_REQUEST)) {
        include_once 'database/dbNoAuthorization.php';
    } //no need for else, because script stops php from executing

    $user = mysqli_real_escape_string($tunnel,$_POST['username']);
    $pwd = mysqli_real_escape_string($tunnel, $_POST['password']);
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