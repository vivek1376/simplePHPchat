<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 19/5/14
 * Time: 11:47 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Log In</title>
</head>
<body>
<h1>Login</h1>

<p>Please login to view the page that you requested.</p>
<?php if (isset($loginError)): ?>
    <p><?php htmlout($loginError); ?></p>
<?php endif; ?>
<form action="" method="post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Log in">
    </div>
</form>
<p><a href="/phptest/admin/">Return to MMS home</a></p>
</body>
</html>

