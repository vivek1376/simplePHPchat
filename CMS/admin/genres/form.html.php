<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 6/5/14
 * Time: 12:37 AM
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php htmlout($pageTitle); ?></title>
</head>
<body>
<h1><?php htmlout($pageTitle); ?></h1>

<form action="?<?php htmlout($action); ?>" method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php htmlout($name) ?>">
    </div>
    <div>
        <input type="hidden" name="id" value="<?php htmlout($id) ?>">
        <input type="submit" value="<?php htmlout($button); ?>">
    </div>
</form>
</body>
</html>