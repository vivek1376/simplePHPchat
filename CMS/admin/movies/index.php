<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 6/5/14
 * Time: 4:28 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/access.inc.php';

if (!userIsLoggedIn()) {
    include '../login.html.php';
    exit();
}

if (!userHasRole('Content Editor')) {
    $error = 'Only Content Administrators may access this page';
    include '../accessdenied.html.php';
    exit();
}


if (isset($_GET['addform'])) {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    if ($_POST['author'] == '') {
        $error = 'You must choose an author for this joke. Click &lsquo;back&rsquo; and try again.';
        include 'error.html.php';
        exit();
    }

    try {
        $sql = 'INSERT INTO movies SET
        name=:name,
        description=:desc,
        authorid=:authorid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':desc', $_POST['desc']);
        $s->bindValue(':authorid', $_POST['author']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error adding submitted movie: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $movieid = $pdo->lastInsertId(); //movieid variable will be used in next query

    if (isset($_POST['genres'])) {
        try {
            $sql = 'INSERT INTO moviegenre SET
            movieid=:movieid,
            genreid=:genreid';
            $s = $pdo->prepare($sql);

            foreach ($_POST['genres'] as $genreid) {
                $s->bindValue(':movieid', $movieid);
                $s->bindValue(':genreid', $genreid);
                $s->execute();
            }
        } catch (PDOException $e) {
            $error = 'Error inserting movie into selected genres: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }
    }

    header('Location: .');
    exit();
}

if (isset($_GET['editform'])) {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    if ($_POST['author'] == '') {
        $error = 'Choose an author for this joke. Click &lsquo;back&rsquo; and try again.';
        include 'error.html.php';
        exit();
    }

    try {
        $sql = 'UPDATE movies SET
        name=:name,
        description=:desc,
        authorid=:authorid
        WHERE id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':desc', $_POST['desc']);
        $s->bindValue(':authorid', $_POST['author']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error updating submitted movie: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    try {
        $sql = 'DELETE FROM moviegenre WHERE movieid=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error removing obsolete movie genre entries: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    if (isset($_POST['genres'])) {
        try {
            $sql = 'INSERT INTO moviegenre SET
            movieid=:movieid,
            genreid=:genreid';
            $s = $pdo->prepare($sql);

            foreach ($_POST['genres'] as $genreid) {
                $s->bindValue(':movieid', $_POST['id']);
                $s->bindValue(':genreid', $genreid);
                $s->execute();
            }
        } catch (PDOException $e) {
            $error = 'Error inserting movie into selected genres: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }

        header('Location: .');
        exit();
    }
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    // Delete genre assignments for this joke
    try {
        $sql = 'DELETE FROM moviegenre WHERE movieid = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error removing movies from moviegenre.';
        include 'error.html.php';
        exit();
    }

    //delete the movie
    try {
        $sql = 'DELETE FROM movies WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error deleting movie: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

if (isset($_GET['add'])) {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    $pageTitle = 'New Movie';
    $action = 'addform';
    $name = '';
    $desc = '';
    $authorid = '';
    $id = '';
    $button = 'Add Movie';

    //build the list of authors
    try {
        $result = $pdo->query('SELECT id,name FROM authors');
    } catch (PDOException $e) {
        $error = 'Error fetching list of authors: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    foreach ($result as $row)
        $authors[] = array('id' => $row['id'], 'name' => $row['name']);

    try {
        $result = $pdo->query('SELECT id,name FROM genres');
    } catch (PDOException $e) {
        $error = 'Error fetching list of genres';
        include 'error.html.php';
        exit();
    }

    foreach ($result as $row) {
        $genres[] = array('id' => $row['id'],
            'name' => $row['name'],
            'selected' => FALSE);
    }
    include 'form.html.php';
    exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'SELECT id,name,description,authorid FROM movies where id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error fetching movie details: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $row = $s->fetch();

    $pageTitle = 'Edit Movie';
    $action = 'editform';
    $name = $row['name'];
    $desc = $row['description'];
    $authorid = $row['authorid'];
    $id = $row['id'];
    $button = 'Update Movie';

    //build list of authors
    try {
        $result = $pdo->query('SELECT id,name FROM authors');
    } catch (PDOException $e) {
        $error = 'Error fetching list of authors: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    foreach ($result as $row)
        $authors[] = array('id' => $row['id'], 'name' => $row['name']);

    //get list of genres containing this movie
    try {
        $sql = 'SELECT genreid FROM moviegenre WHERE movieid=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error fetching list of selected genres: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $selectedGenres[] = array();
    foreach ($s as $row) {
        $selectedGenres[] = $row['genreid'];
    }

    //build list of all genres
    try {
        $result = $pdo->query('SELECT id,name FROM genres');
    } catch (PDOException $e) {
        $error = 'fetching list of all genres: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    foreach ($result as $row) {
        $genres[] = array('id' => $row['id'],
            'name' => $row['name'], 'selected' => in_array($row['id'], $selectedGenres));
    }

    include 'form.html.php';
    exit();
}

if (isset($_GET['action']) and $_GET['action'] == 'search') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

// The basic SELECT statement
    $select = 'SELECT movies.id, movies.name,movies.description';
    $from = ' FROM movies';
    $where = ' WHERE TRUE';

    $placeholders = array();

    if ($_GET['author'] != '') {
        $where .= " AND authorid=:authorid";
        $placeholders[':authorid'] = $_GET['author'];
    }

    if ($_GET['genre'] != '') {
        $from .= ' INNER JOIN moviegenre ON movies.id=moviegenre.movieid';
        $where .= " AND genreid=:genreid";
        $placeholders[':genreid'] = $_GET['genre'];
    }

    if ($_GET['text'] != '') {
        $where .= " AND name LIKE :nametext";
        $placeholders[':nametext'] = '%' . $_GET['text'] . '%';
    }

    //now retrieve movies based on search criteria
    try {
        $sql = $select . $from . $where;
        $s = $pdo->prepare($sql);
        $s->execute($placeholders);
    } catch (PDOException $e) {
        $error = 'Error fetching movies: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    foreach ($s as $row)
        $movies[] = array('id' => $row['id'], 'name' => $row['name'], 'description' => $row['description']);

    include 'movies.html.php';
    //echo 'sdsasdasd';
    exit();
}

//connect to DB
include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

try {
    $result = $pdo->query('SELECT id,name FROM authors');
} catch (PDOException $e) {
    $error = 'Error fetching authors from database';
    include 'error.html.php';
    exit();
}

foreach ($result as $row)
    $authors[] = array('id' => $row['id'], 'name' => $row['name']);

try {
    $result = $pdo->query('SELECT id,name FROM genres');
} catch (PDOException $e) {
    $error = 'Error fetching genre list from database';
    include 'error.html.php';
    exit();
}

foreach ($result as $row)
    $genres[] = array('id' => $row['id'], 'name' => $row['name']);

include 'searchform.html.php';