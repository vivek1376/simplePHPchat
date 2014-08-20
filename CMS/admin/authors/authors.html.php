<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 4/5/14
 * Time: 4:39 PM
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Authors</title>
</head>
<body>
<h1>Manage Authors</h1>

<p><a href="?add">Add new author</a></p>
<ul>
    <?php foreach ($authors as $author): ?>
    <li>
        <form action="" method="post">
            <div>
                <?php echo htmlout($author['name']) ?>
                <input type="hidden" name="id" value="<?php echo $author['id'] ?>">
                <input type="submit" name="action" value="Edit">
                <input type="submit" name="action" value="Delete">
            </div>
        </form>
    </li>
    <?php endforeach; ?>
</ul>
<p><a href="../">Return to MMS home page</a></p>
<?php include '../logout.inc.html.php'; ?>
</body>
</html>
