<html>
<head>
    <!-- Viewport für Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <!-- Verlinken der Css Dateien -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/general.css">
    <script type="text/javascript" src="../js/login_logout.js"></script>
</head>
<title>News</title>
<body>
<?php
require_once 'functions.php';
require_once 'Newsclass.php';
pageAuthentification(true); //Login-Page is the only exception where false should be placed!


// Navigation einfügen und verlinken
echo "<header>";
createNav();
echo "</header>";

//Evtl. delete news article
if (isset($_POST['delete_news'])) {
    $delete_news = new Newsclass();
    $delete_news->setnewsID($_POST['news_id']);
    $delete_news->DB_deleteNews();
}



?>

<section>
    <div class="text-center"><h1>Breaking News</h1>
        <?php
        require_once 'Employee.php';
        $curr_user = new Employee();
        $curr_user = $curr_user->loadUser_from_DB($_COOKIE['Username']);
        if ($curr_user !== false) {
            if ($curr_user->isAdmin()) { /*IDE says that method not found because loadUser_from_DB() also gives a boolean (=false) if User not found*/
                //If User is Admin he can add news articles
                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method=\"POST\">
            Titel:     <input type=\"text\" name=\"title\"/><br/>
            Text:      <textarea id=\"text\" name=\"textarea\" cols=\"35\" rows=\"4\"></textarea><br/>
            <input type=\"submit\" value=\"Absenden\"/>
            </form>";
            } else {
                echo "<span style='color:#ff0000;'>Info: Please get admin rights to add or delete news articles! (Profile.php)</span>";
            }
        } else {
            echo "ERROR: Cannot get user data. (in News.php)";
        }
        $curr_user->__destruct();
        ?>
    </div>
    <?php
    if(!empty($_POST) && isset($_POST['title'])) {
        INCLUDE 'db/dbNewConnection.php';
        $title = $_POST['title'];
        $textarea = $_POST['textarea'];
        if (strlen($title) > 0 && strlen($textarea) > 0) {
            $news = "INSERT INTO News (title, newstext) VALUES ('" . $title . "','" . $textarea . "');";
            $pushnews = mysqli_query($tunnel, $news);
            echo "<div class='text-center'>Der Eintrag war erfolgreich</div>";
        } else {
            echo "<div class='text-center'>Fehler: Ihre Angaben sind fehlerhaft</div>";
        }
        mysqli_close($tunnel);
    }


    ?>
    <?php
    INCLUDE 'db/dbNewConnection.php';

    $getnews="SELECT * FROM News ORDER BY newsID DESC;";
    $ergebnis1=mysqli_query($tunnel, $getnews);

    while($row1 = mysqli_fetch_array($ergebnis1))
    {
        echo"<h1 class='text-center'>".$row1['title']."</h1>";
        echo"<p class='text-center'>".$row1['newstext']."</p><br><br>";
                require_once 'Employee.php';
                $curr_user = new Employee();
                $curr_user = $curr_user->loadUser_from_DB($_COOKIE['Username']);
                if ($curr_user !== false) {
                    if ($curr_user->isAdmin()) { /*IDE says that method not found because loadUser_from_DB() also gives a boolean (=false) if User not found*/
                        //If User is Admin he can add news articles
                        echo"<div class='text-center'><form action='".$_SERVER['PHP_SELF']."' name='deletearticle' method='post'><input type='submit' name='delete_news' value='Delete'/>
                        <input type='hidden' value='".$row1['newsID']."' name='news_id'/></form></div>";
                } /*else {
                        echo "<div class='text-center'><span style='color:#ff0000;'>Info: Please get admin rights to delete Articles! (Profile.php)</span></div>";
                    }*/
                } else {
        echo "ERROR: Cannot get user data. (in News.php)";
    }
    $curr_user->__destruct();

    }


    /*if (isset($_POST['delete']))
    {
        $deletentry="DELETE * FROM News";
        $isdeleted=mysqli_query($tunnel,$deletentry);
    }
    */
    mysqli_close($tunnel);
    ?>
</section>

</body>
</html>
