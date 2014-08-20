<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 30/4/14
 * Time: 12:53 AM
 */

/*$cc[0] = 2;
$cc[4] = 55;
echo $cc[4];*/

//remove magic quotes
include_once $_SERVER['DOCUMENT_ROOT'].'/phptest/includes/magicquotes.inc.php';

//connect to DB
include_once $_SERVER['DOCUMENT_ROOT'].'/phptest/includes/db.inc.php';  //use include instead of require to let rest of the page to execute

$output = 'database connection established';
include 'output.html.php';

//connected to db success

if (isset($_GET['addmovie'])) {
    include 'movieform.html.php';
    exit();
}

//insert new entry
if (isset($_POST['moviename'])) {

    try {

        $insertsql = 'INSERT INTO movies SET
        name=:moviename,
        year=:year,
        description=:moviedesc';

        $ins = $pdo->prepare($insertsql);

        $ins->bindValue(':moviename', $_POST['moviename']);
        $ins->bindValue(':year', $_POST['year']);
        $ins->bindValue(':moviedesc', $_POST['moviedesc']);

        $ins->execute();

        /*$insertsql = 'INSERT INTO movies SET
name="' . $_POST['moviename'] . '",
year="' . $_POST['year'] . '",
description="' . $_POST['moviedesc'] . '"';
        $pdo->exec($insertsql);*/

    } catch (PDOException $e) {
        $error = 'error inserting: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    //important prevents reload and duplication
    header('Location: .');
    exit();
}

//delete entry
if (isset($_GET['deletemovie'])) {
    //echo 'ha';
    //exit();
    try {
        $deletesql = 'DELETE FROM movies WHERE
        id=:id';

        $del = $pdo->prepare($deletesql);

        $del->bindValue(':id', $_POST['id']);

        $del->execute();
    } catch (PDOException $e) {
        $error = 'error deleting: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

//show list of movies
try {
    $sql ="SELECT m.id AS \"M_ID\", m.name AS \"M_NAME\", m.description AS \"M_DESC\", a.id AS \"A_ID\", a.name AS \"A_NAME\", a.email AS \"A_EMAIL\"\n"
        . "FROM movies m\n"
        . "LEFT OUTER JOIN authors a ON m.authorid = a.id";

    $result = $pdo->query($sql);
} catch (PDOException $e) {
    $error = 'error fetching movies\' names: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

while ($row = $result->fetch())
    $movies[] = array('m_id' => $row['M_ID'],
        'm_name' => $row['M_NAME'],
        'm_desc' => $row['M_DESC'],
        'a_id' => $row['A_ID'],
        'a_name' => $row['A_NAME'],
        'a_email' => $row['A_EMAIL']);

include 'movies.html.php';

//close DB connection
$pdo = null;