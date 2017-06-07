<?php
/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 07.06.2017
 * Time: 14:53
 */
echo "<div class='authorization_failed'><h1>Authorization Error</h1>";
echo "<p>You have no permission to view this site. Please call your system-administrator. </p>";

echo "<img src='../images/authorization_error_minions.jpg' alt='sadcat' id='authorization_error_pic'/>";

echo "</div>";



exit(); //stops loading page, when authorization fails

?>