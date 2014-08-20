<?php include_once $_SERVER['DOCUMENT_ROOT'].'/phptest/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>List of movies</title>
</head>
<body>
<p><a href="?addmovie">Add a movie</a></p>

<p>Here is the list of movies:</p>


<?php foreach ($movies as $movie): ?>
    <form action="?deletemovie" method="post">
        <p>
            <?php htmlout($movie['m_name']) . ' -- ' .
                htmlout($movie['m_desc']); ?>
            <input type="hidden" name="id" value="<?php echo $movie['m_id'] ?>">
            <input type="submit" value="Delete">
            (by <a href="mailto:<?php htmlout($movie['a_email']) ?>">
                <?php htmlout($movie['a_name']) ?></a>)
        </p>
    </form>

<?php endforeach; ?>

</body>
</html>