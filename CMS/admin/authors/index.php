<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 4/5/14
 * Time: 4:28 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/access.inc.php';


if (!userIsLoggedIn()) {
    include '../login.html.php';
    exit();
}

if (!userHasRole('Account Administrator')) {
    $error = 'Only Account Administrators may access this page';
    include '../accessdenied.html.php';
    exit();
}

if (isset($_GET['add'])) {

    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    $pageTitle = 'New Author';
    $action = 'addform';
    $name = '';
    $email = '';
    $id = '';
    $button = 'Add Author';

    //build the list of roles
    try {
        $result = $pdo->query('SELECT id,description FROM roles');
    } catch (PDOException $e) {
        $error = 'Error fetching list of roles';
        include 'error.html.php';
        exit();
    }

    foreach ($result as $row) {
        $roles[] = array(
            'id' => $row['id'],
            'description' => $row['description'],
            'selected' => false
        );
    }

    include 'form.html.php';
    exit();
}

//add author into table
if (isset($_GET['addform'])) {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'INSERT INTO authors SET
        name=:name,
        email=:email';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'error inserting submitted author: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $authorid = $pdo->lastInsertId();

    if ($_POST['password'] != '') {
        $password = hash('sha256', $_POST['password']);

        try {
            $sql = 'UDPATE authors SET
            password= :password
            WHERE id= :id';
            $s = $pdo->prepare($sql);
            $s->bindValue(':password', $password);
            $s->bindValue(':id', $authorid);
            $s->execute();
        } catch (PDOException $e) {
            $error = 'Error setting author password: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }
    }

    if (isset($_POST['roles'])) {
        foreach ($_POST['roles'] as $role) {
            try {
                $sql = 'INSERT INTO authorrole SET
                authorid=:authorid,
                roleid=:roleid';

                $s = $pdo->prepare($sql);
                $s->bindValue(':authorid', $authorid);
                $s->bindValue(':roleid', $role);
                $s->execute();
            } catch (PDOException $e) {
                $error = 'Error assigning selected role to author: ' . $e->getMessage();
                include 'error.html.php';
                exit();
            }
        }
    }

    header('Location: .');
    exit();
}

//show edit author from
if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'SELECT id,name,email FROM authors WHERE id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error fetching author details: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $row = $s->fetch();

    $pageTitle = 'Edit Author';
    $action = 'editform';
    $name = $row['name'];
    $email = $row['email'];
    $id = $row['id'];
    $button = 'Update Author';

    //get list of roles assigned to author
    try {
        $sql = 'SELECT roleid FROM authorrole WHERE authorid=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $id);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error fetching list of assigned roles: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    $selectedRoles = array();
    foreach ($s as $row) {
        $selectedRoles[] = $row['roleid'];
    }

    //build the list of all roles
    try {
        $result = $pdo->query('SELECT id,description FROM roles');
    } catch (PDOException $e) {
        $error = 'Error fetching list of roles: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    foreach ($result as $row) {
        $roles[] = array(
            'id' => $row['id'],
            'description' => $row['description'],
            'selected' => in_array($row['id'], $selectedRoles)
        );
    }

    include 'form.html.php';
    exit();
}

//edit author
if (isset($_GET['editform'])) {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'UPDATE authors SET
        name=:name,
        email=:email
        WHERE id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':email', $_POST['email']);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error updating submitted author: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    if($_POST['password']!='')
    {
        $password=hash('sha256',$_POST['password']);

        try
        {
            $sql='UPDATE authors SET password=:password WHERE id=:id';
            $s=$pdo->prepare($sql);
            $s->bindValue(':password',$password);
            $s->bindValue(':id',$_POST['id']);
            $s->execute();
        }
        catch(PDOException $e)
        {
            $error='Error setting author password: '.$e->getMessage();
            include 'error.html.php';
            exit();
        }
    }

    try
    {
        $sql='DELETE FROM authorrole WHERE authorid=:id';
        $s=$pdo->prepare($sql);
        $s->bindValue(':id',$_POST['id']);
        $s->execute();
    }
    catch(PDOException $e)
    {
        $error='Error removing obsolete authorrole entries: '.$e->getMessage();
        include 'error.html.php';
        exit();
    }

    if(isset($_POST['roles']))
    {
        foreach($_POST['roles'] as $role)
        {
            try{
                $sql='INSERT INTO authorrole SET
                authorid=:authorid,
                roleid=:roleid';
                $s=$pdo->prepare($sql);
                $s->bindValue(':authorid',$_POST['id']);
                $s->bindValue(':roleid',$role);
                $s->execute();
            }
            catch(PDOException $e)
            {
                $error='Error assigning selected roles to author: '.$e->getMessage();
                include 'error.html.php';
                exit();
            }
        }
    }

    header('Location: .');
    exit();
}

//Delete author
if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
    include 'confirmdelete.html.php';
    exit();
}

if (isset($_POST['confirmdelete']) and $_POST['confirmdelete'] == 'yes') {
    //connect to DB
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    //delete role assignments for this author
    try
    {
        $sql='DELETE FROM authorrole WHERE
        authorid=:id';
        $s=$pdo->prepare($sql);
        $s->bindValue(':id',$_POST['id']);
        $s->execute();
    }
    catch(PDOException $e)
    {
        $error='Error removing author from roles: '.$e->getMessage();
        include 'error.html.php';
        exit();
    }

    //get movies belonging to author
    try {
        $sql = 'SELECT id FROM movies WHERE authorid=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'error getting list of movies to delete: ' . $e->getMessage();
        include 'error.html.php';
    }

    $rows = $s->fetchAll();

    //delete moviegenre entry
    try {
        $sql = 'DELETE FROM moviegenre WHERE movieid=:id';
        $s = $pdo->prepare($sql);

        //for each movieid
        foreach ($rows as $row) {
            $s->bindValue(':id', $row['id']);
            $s->execute();
        }
    } catch (PDOException $e) {
        $error = 'Error deleting moviegenre entries: ' . $e->getMessage();
        include 'error.html.php';
    }

    //delete movie entries belonging to author
    try {
        $sql = 'DELETE FROM movies where authorid=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error deleting movies: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    //delete the author
    try {
        $sql = 'DELETE FROM authors WHERE id=:id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error deleting author: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}
//connect to DB
include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

//list all authors
try {
    $selauthors = $pdo->query('SELECT id,name FROM authors');
} catch (PDOException $e) {
    $error = 'Error fetching authors from database';
    include 'error.html.php';
    exit();
}

foreach ($selauthors as $row) {
    $authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'authors.html.php';
?>