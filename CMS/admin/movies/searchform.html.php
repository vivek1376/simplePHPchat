<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 6/5/14
 * Time: 4:35 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Genres</title>
</head>
<body>
<h1>Manage Movies</h1>
<p><a href="?add">Add new Movie</a></p>
<form action="" method="get">
    <p>View movies according to following criteria</p>
    <div>
        <label for="author">By Author:</label>
        <select name="author" id="author">
            <option value="">Any Author</option>
            <?php foreach ($authors as $author): ?>
            <option value="<?php htmlout($author['id']); ?>"><?php htmlout($author['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="genre">By Genre:</label>
        <select name="genre" id="genre">
            <option value="">Any Genre</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php htmlout($genre['id']); ?>"><?php
                    htmlout($genre['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="text">Containing text:</label>
        <input type="text" name="text" id="text">
    </div>
    <div>
        <input type="hidden" name="action" value="search">
        <input type="submit" value="Search">
    </div>
    </form>
<p><a href="../">Return to MMS home page</a> </p>
<?php include '../logout.inc.html.php'; ?>
</body>
</html>