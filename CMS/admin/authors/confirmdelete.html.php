<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 5/5/14
 * Time: 2:44 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Confirm Delete</title>
</head>
<body>
<form action="" method="post">
    <p>Confirm Delete?</p>
    <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
    <input type="submit" name="confirmdelete" value="yes">
    <input type="submit" name="confirmdelete" value="no">
</form>
</body>
</html>
