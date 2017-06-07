<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Blue Surface Seeker</title>
    <link href="../css/authorization.css">

</head>
<body>
<?php
    if (empty($_REQUEST)) {
        echo "<div class='authorization_failed'><h1>Authorization Error</h1>";
        echo "<p>You have no permission to view this site. Please call your system-administrator. </p></div>";
    }


?>
</body>
</html>