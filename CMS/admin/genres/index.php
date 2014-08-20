<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 5/5/14
 * Time: 11:53 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/access.inc.php';

if (!userIsLoggedIn()) {
    include '../login.html.php';
    exit();
}

if (!userHasRole('Site Administrator')) {
    $error = 'Only Site Administrators may access this page';
    include '../accessdenied.html.php';
    exit();
}


if (isset($_GET['add'])) {
    $pageTitle = 'New Genre';
    $action = 'addform';
    $name = '';
    $id = '';
    $button = 'Add Genre';
    include 'form.html.php';
    exit();
}
if (isset($_GET['addform'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    if ($_POST['name'] != '') {
        try {
            $sql = 'INSERT INTO genres SET name = :name';
            $s = $pdo->prepare($sql);
            $s->bindValue(':name', $_POST['name']);
            $s->execute();
        } catch (PDOException $e) {
            $error = 'Error adding submitted genre: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }
    }

    header('Location: .');
    exit();
}

//show edit genre from
if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'SELECT id,name FROM genres WHERE id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error fetching genre details: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $row = $s->fetch();

    $pageTitle = 'Edit Genre';
    $action = 'editform';
    $name = $row['name'];
    $id = $row['id'];
    $button = 'Update Genre';

    include 'form.html.php';
    exit();
}

//edit genre
if (isset($_GET['editform'])) {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'UPDATE genres SET
        name=:name WHERE id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error updating submitted genre: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

//Delete genre
if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
    include 'confirmdelete.html.php';
    exit();
}


if (isset($_POST['confirmdelete']) and $_POST['confirmdelete'] == 'yes') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    //delete moviegenre entry
    try {
        $sql = 'DELETE FROM moviegenre WHERE genreid=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error deleting moviegenre entries: ' . $e->getMessage();
        include 'error.html.php';
    }

    //delete genre from genres list
    try {
        $sql = 'DELETE FROM genres where id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error deleting genre: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

//connect to DB
include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

//display all genres
try {
    $sql = $pdo->query('SELECT id,name FROM genres');
} catch (PDOException $e) {
    $error = 'Error fetching genres from database: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

foreach ($sql as $row) {
    $genres[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'genres.html.php';

?>