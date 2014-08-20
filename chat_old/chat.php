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
    if ($_POST['msg'] != '') {
        include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';

        try {
            //$msgtimestamp = date("Y-m-d H:i:s");
            $sql = 'INSERT INTO messages SET
        message=:msg';
            $s = $pdo->prepare($sql);
            $s->bindValue(':msg', $_POST['msg']);
            $s->execute();
        } catch (PDOException $e) {
            $error = 'Error inserting message into table: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }
        echo 'x'; //json_encode($msgarr);
    }
} elseif (isset($_POST['latestMsgID'])) {
    include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';
    //echo 'xyz';

    if ($_POST['latestMsgID'] == '') {
        $sql = 'SELECT MAX(id) FROM messages';
        $s = $pdo->query($sql);
        $val = $s->fetch();
        if ($val[0] == null)
            $msgs[] = array('id' => '0', 'bd' => 'fIrSt');
        else
            $msgs[] = array('id' => $val[0], 'bd' => 'fIrSt');
        echo json_encode($msgs);
        unset ($msgs);
    } else {
        try {
            $tt = '';
            $sql = 'SELECT id,message FROM messages WHERE id >"' . $_POST['latestMsgID'] . '"';
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            $error = 'Error retrieving message: ' . $e->getMessage();
            include 'error.html.php';
            exit();
        }
        $msgs = array();
        foreach ($result as $row) {
            $msgs[] = array('id' => $row['id'], 'bd' => $row['message']);
        }
        echo json_encode($msgs);
        //unset($msgs);
    }
    //exit();
}