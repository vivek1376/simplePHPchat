<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 5/5/14
 * Time: 3:44 PM
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
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php htmlout($email) ?>">
    </div>
    <div>
        <label for="password">Set password</label>
        <input type="password" name="password" id="password">
    </div>
    <fieldset>
        <legend>Roles</legend>
        <?php for($i=0; $i<count($roles); $i++): ?>
        <div>
            <label for="role<?php echo $i; ?>">
            <input type="checkbox" name="roles[]" id="role<?php echo $i; ?>" value="<?php htmlout($roles[$i]['id']); ?>"
                <?php if($roles[$i]['selected']) echo 'checked'; ?>>
            <?php htmlout($roles[$i]['id']); echo ' -- '; ?><?php htmlout($roles[$i]['description']); ?></label>
        </div>
        <?php endfor; ?>
    </fieldset>
    <div>
        <input type="hidden" name="id" value="<?php htmlout($id) ?>">
        <input type="submit" value="<?php htmlout($button); ?>">
    </div>
</form>
</body>
</html>

