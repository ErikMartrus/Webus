<?php // Example 26-11: messages.php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");
if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else                      $view = $user;
if (isset($_POST['text'])) {
    $text = sanitizeString($_POST['text']);
    if ($text != "") {
        $pm = substr(sanitizeString($_POST['pm']), 0, 1);
        $time = time();
        queryMysql("INSERT INTO messages VALUES(NULL, '$user',
        '$view', '$pm', '$time', '$text')");
    }
}
if ($view != "") {
    if ($view == $user) $name1 = $name2 = "Your";
    else {
        $name1 = "<a href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
    }
    echo "<h3>$name1 Messages</h3>";
    $result = queryMysql("SELECT * FROM friends WHERE user='$view' AND friend ='$user'");
    if ($result->num_rows||$view == $user)
    {
    echo <<<_END
      <form method='post' action='messages.php?view=$view'>
       
                  <legend>Escribe un mensaje</legend>
            <label class="btn btn-secondary">
            <input type='radio' name='pm' id='public' value='0' checked> Public
            </label>
            <label class="btn btn-secondary">
            <input type='radio' name='pm' id='private' value='1'> Private
            </label>
      <textarea class="form-control" name='text'></textarea>
      <input class="btn btn-outline-dark" type='submit' value='Post Message'>
    </form><br>
_END;
}else{
    echo "<p>No sigues a este usuario</p>";
}
    date_default_timezone_set('UTC');
    if (isset($_GET['erase'])) {
        $erase = sanitizeString($_GET['erase']);
        queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }
    $query = "SELECT * FROM messages WHERE recip='$view'  ORDER BY time DESC";
    $result = queryMysql($query);
    $num = $result->num_rows;
    for ($j = 0; $j < $num; ++$j) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user) {
            echo date('M jS \'y g:ia:', $row['time']);
            echo " <a href='messages.php?view=" . $row['auth'] .
                "'>" . $row['auth'] . "</a> ";
            if ($row['pm'] == 0)
                echo "wrote: &quot;" . $row['message'] . "&quot; ";
            else
                echo "whispered: <span class='whisper'>&quot;" .
                    $row['message'] . "&quot;</span> ";
            if ($row['recip'] == $user)
                echo "[<a href='messages.php?view=$view" .
                    "&erase=" . $row['id'] . "'>Eliminar</a>]";
            echo "<br>";
        }
    }
}
if (!$num)
    echo "<br><span class='info'>No hay mensajes</span><br><br>";
echo "<br><a data-role='button' class=\"badge badge-secondary\"
        href='messages.php?view=$view'>Actualizar</a>";
?>

</div><br>
</body>
</html>