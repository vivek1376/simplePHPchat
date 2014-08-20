<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 24/5/14
 * Time: 4:17 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/magicquotes.inc.php';

require_once 'access.inc.php';

//check if user is logged in
if (!userIsLoggedIn()) {
    include 'login.html.php';
    exit();
}

if (isset($_POST['searchFriend']) and $_POST['searchFriend'] == 'Search') {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    //if(isset($_POST['friendname']) and $_POST['friendname']!='')
    //{
    try {
        $sql = 'SELECT id,name,username FROM chatusers where name LIKE "%' . $_POST['friendname'] . '%"' .
            ' AND id NOT IN (SELECT friendid FROM chatfriends WHERE userid="' . $_SESSION['userid'] . '")' .
            ' AND id NOT IN (SELECT userid FROM chatfriends WHERE friendid="' . $_SESSION['userid'] . '")' .
            ' AND id NOT IN (SELECT requesteeid FROM friendrequests WHERE userid="' . $_SESSION['userid'] . '")' .
            ' AND id !="' . $_SESSION['userid'] . '"';
        $result = $pdo->query($sql);
    } catch (PDOException $e) {
        $error = 'Error fetching details of users: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
    $searchedUsers = $result->fetchAll();
    // }
}


if (isset($_POST['friendRequest'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'INSERT INTO friendrequests SET
    userid=:userid,
    requesteeid=:requesteeid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $_SESSION['userid']);
        $s->bindValue(':requesteeid', $_POST['requesteeid']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error creating friend request: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}


if (isset($_POST['approveRequest'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $sql = 'INSERT INTO chatfriends SET
    userid=:userid,
    friendid=:friendid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $_SESSION['userid']);
        $s->bindValue(':friendid', $_POST['requestorid']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error adding friend : ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    //now delete friend request
    try {
        $sql = 'DELETE FROM friendrequests WHERE requesteeid=:requesteeid and
userid=:userid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':requesteeid', $_SESSION['userid']);
        $s->bindValue(':userid', $_POST['requestorid']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error deleting friend request: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}

if(isset($_POST['chatFriend']))
{
    $friendid=$_POST['chatFriend'];
    include 'chatwindow.html.php';
    include 'logout.inc.html.php';
    exit();
}


include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

//prepare list of friends
try {
    $sql = 'SELECT id,name,username,online FROM chatusers CU INNER JOIN chatfriends CF ON CU.id=CF.friendid WHERE userid="' . $_SESSION['userid'] . '"';
    $s = $pdo->prepare($sql);
    $s->execute();
} catch (PDOException $e) {
    $error = 'Error fetching friends details: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

$chatFriends1 = $s->fetchAll();

unset($s);

try {
    $sql = 'SELECT id,name,username,online FROM chatusers CU INNER JOIN chatfriends CF ON CU.id=CF.userid WHERE friendid="' . $_SESSION['userid'] . '"';
    $s = $pdo->prepare($sql);
    $s->execute();
} catch (PDOException $e) {
    $error = 'Error fetching friends details: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

$chatFriends2 = $s->fetchAll();

try {
    $sql = 'SELECT userid,name FROM friendrequests FR INNER JOIN chatusers CU ON FR.userid=CU.id WHERE requesteeid="' . $_SESSION['userid'] . '"';
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    $error = 'Error searching friend requests: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}

$friendRequests = $result->fetchAll();

include 'friendForm.html.php';

include 'logout.inc.html.php';

//include 'chatwindow.html.php';

?>