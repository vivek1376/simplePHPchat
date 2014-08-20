<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 10/5/14
 * Time: 11:35 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cookie counter</title>
</head>
<body>
<p>
    <?php
if($visits>1)
    echo 'This is visit number '.$visits;
else
    echo 'Welcome';
?>
    </p>
</body>
</html>

