<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 8/5/14
 * Time: 11:11 PM
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
        <label for="name">Type movie name</label>
        <input type="text" name="name" id="name" value="<?php htmlout($name); ?>">
    </div>
    <div>
        <label for="desc">Type Description</label>
        <textarea id="desc" name="desc" rows="3" cols="40"><?php htmlout($desc); ?></textarea>
    </div>
    <div>
        <label for="author">Author</label>
        <select name="author" id="author">
            <option value="">Select One</option>
            <?php foreach ($authors as $author): ?>
                <option value="<?php htmlout($author['id']); ?>"<?php
                if ($author['id'] == $authorid)
                    echo ' selected';
                ?>
                    ><?php htmlout($author['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <fieldset>
        <legend>Genres</legend>
        <?php foreach ($genres as $genre): ?>
            <div>
                <label for="genre<?php htmlout($genre['id']); ?>">
                    <input type="checkbox" name="genres[]" id="genre<?php htmlout($genre['id']) ?>"
                           value="<?php htmlout($genre['id']); ?>"
                        <?php if ($genre['selected'])
                            echo ' checked';
                        ?>><?php htmlout($genre['name']); ?>
                </label>
            </div>
        <?php endforeach; ?>
    </fieldset>
    <div>
        <input type="hidden" name="id" value="<?php htmlout($id) ?>">
        <input type="submit" value="<?php htmlout($button); ?>">
    </div>
</form>
</body>
</html>
