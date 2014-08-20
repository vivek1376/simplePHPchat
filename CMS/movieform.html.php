<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 1/5/14
 * Time: 7:28 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add new movie</title>
</head>
<body>
<form action="?" method="post">
    <div>
        <label for="moviename">Name of the movie</label>
        <input type="text" id="moviename" name="moviename">
    </div>
    <div>
        <label for="year">Year of release</label>
        <input type="text" id="year" name="year">
    </div>
    <div>
        <label for="moviedesc">About the movie</label>
        <textarea id="moviedesc" name="moviedesc"></textarea>
    </div>
    <div>
        <input type="submit" value="Add">
    </div>
</form>
</body>
</html>