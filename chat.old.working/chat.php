<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 25/5/14
 * Time: 12:55 PM
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php';

if (isset($_POST['msg'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

    try {
        $msgtimestamp = date("Y-m-d H:i:s");
        $sql = 'INSERT INTO messages SET
        message=:msg,
        timestamp ="' . $msgtimestamp . '"';
        $s = $pdo->prepare($sql);
        $s->bindValue(':msg', $_POST['msg']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error inserting message into table: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
    //$msgarr[] = array('ts' => $msgtimestamp, 'bd' => $_POST['msg']);
    //$msgarr[] = array('ts' => $msgtimestamp, 'bd' => 'bye');
    //$xmlout = $msgtimestamp . '---' . $_POST['msg'];
    echo 'x'; //json_encode($msgarr);
    //htmlout(json_encode($msgarr)); //is it ok??
    exit();
}

if (isset($_POST['latestMsg'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';
    //echo 'xyz';

    if ($_POST['latestMsg'] == '') {
        $sql='SELECT MAX(id) FROM messages';
        $s=$pdo->query($sql);
        $val=$s->fetch();
        $msgs[] = array('ts' => date("Y-m-d H:i:s"), 'bd' => 'fIrSt');
        echo json_encode($msgs);
        unset ($msgs);
    } else {
        try {
            $tt = '';
            $sql = 'SELECT message,timestamp FROM messages WHERE timestamp >"' . $_POST['latestMsg'] . '"';
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            $error = 'Error retrieving message: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }

        foreach ($result as $row) {
            $msgs[] = array('ts' => $row['timestamp'], 'bd' => $row['message']);
        }
        echo json_encode($msgs);
        unset($msgs);
        //htmlout($msgs);

        //exit();
    }
}