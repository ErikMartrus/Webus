<?php // Example 26-9: members.php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");
if (isset($_GET['view']))
{
    $view = sanitizeString($_GET['view']);
    if ($view == $user) $name = "Your";
    else                $name = "$view's";
    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<a data-role='button'
          href='messages.php?view=$view'>View $name messages</a>";
    die("</div></body></html>");
}
if (isset($_GET['add']))
{
    $add = sanitizeString($_GET['add']);
    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
    if (!$result->num_rows)
        queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
}
elseif (isset($_GET['remove']))
{
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
}
$result = queryMysql("SELECT email FROM users ORDER BY email");
$num    = $result->num_rows;
echo "<h3>Other Members</h3><ul>";
for ($j = 0 ; $j < $num ; ++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['email'] == $user  || $row['email'] =="admin@admin.com" ) continue;
    echo "<li><a  href='members.php?view=" .
        $row['email'] . "'>" . $row['email'] . "</a>";
    $follow = "Seguir";
    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='" . $row['email'] . "' AND friend='$user'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='$user' AND friend='" . $row['email'] . "'");
    $t2      = $result1->num_rows;
    if (($t1 + $t2) > 1) echo " &harr; os seguís mutuamente";
    elseif ($t1)         echo " &larr; le sigues";
    elseif ($t2)       { echo " &rarr; te sigue";
        $follow = "Seguir :3"; }
    if (!$t1) echo " [<a 
      href='members.php?add=" . $row['email'] . "'>$follow</a>]";
    else      echo " [<a 
      href='members.php?remove=" . $row['email'] . "'>Dejar de seguir</a>]";
}
?>
</ul></div>
</body>
</html>