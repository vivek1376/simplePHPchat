<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 7/5/14
 * Time: 12:13 AM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Movies: Search results</title>
</head>
<body>
<h1>Search Results:</h1>
<?php if (isset($movies) and !empty($movies)): ?>

<table>
    <tr><th>Movie Name</th><th>Options</th></tr>

    <?php foreach ($movies as $movie): ?>
    <tr>
        <td><?php htmlout($movie['name']); ?></td>
        <td>
            <form action="?" method="post">
                <div>
                    <input type="hidden" name="id" value="<?php htmlout($movie['id']) ?>">
                    <input type="submit" name="action" value="Edit">
                    <input type="submit" name="action" value="Delete">
                </div>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
    <?php elseif (empty($movies)): ?>
    <p>Sorry, No results.</p>
<?php endif; ?>
<p><a href="?">New Search</a> </p>
<p><a href="../">Return to MMS home</a></p>
<?php include '../logout.inc.html.php'; ?>
</body>
</html>