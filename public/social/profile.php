<?php // Example 26-8: profile.php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");
echo "<h3>Tu perfil</h3>";
$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
if (isset($_POST['text']))
{
    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);
    if ($result->num_rows)
        queryMysql("UPDATE profiles SET text='$text' where user='$user'");
    else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
}
else
{
    if ($result->num_rows)
    {
        $row  = $result->fetch_array(MYSQLI_ASSOC);
        $text = stripslashes($row['text']);
    }
    else $text = "";
}
$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
if (isset($_FILES['image']['name']))
{
    $saveto = "$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    switch($_FILES['image']['type'])
    {
        case "image/gif":   $src = imagecreatefromgif($saveto); break;
        case "image/jpeg":  // Both regular and progressive jpegs
        case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
        case "image/png":   $src = imagecreatefrompng($saveto); break;
        default:            $typeok = FALSE; break;
    }
    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);
        $max = 100;
        $tw  = $w;
        $th  = $h;
        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
        {
            $tw = $th = $max;
        }
        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
    }
}
showProfile($user);
echo <<<_END
      <form data-ajax='false' method='post'
        action='profile.php' enctype='multipart/form-data'>
      <h3>Edita tu estado o imagen</h3>
      <textarea class="form-control" name='text'>$text</textarea><br>
      <div class="custom-file"> <input type="file" class="custom-file-input" name="image" id="customFile" size="14">
        <label class="custom-file-label" for="customFile">Choose file</label><br></div><br>
      <input class="btn btn-outline-dark" type='submit' value='Save Profile'>
      </form>
    </div><br>
  </body>
</html>
_END;
?>