<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 6/5/14
 * Time: 12:25 AM
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Genres</title>
</head>
<body>
<h1>Manage Genres</h1>
<p><a href="?add">Add new Genre</a></p>

<ul>
    <?php foreach ($genres as $genre): ?>
    <li>
        <form action="" method="post">
            <div>
                <?php htmlout($genre['name']); ?>
                <input type="hidden" name="id" value="<?php echo $genre['id']; ?>">
                <input type="submit" name="action" value="Edit">
                <input type="submit" name="action" value="Delete">
            </div>
        </form>
    </li>
    <?php endforeach; ?>
</ul>
<p><a href="../">Return to MMS home</a></p>
<?php include '../logout.inc.html.php'; ?>
</body>
</html>



