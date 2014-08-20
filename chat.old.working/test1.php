<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 28/5/14
 * Time: 3:16 AM
 */

include $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/db.inc.php';
$sql='SELECT MAX(id) FROM messages';
$s=$pdo->query($sql);
$val=$s->fetch();
echo $val[0];
?>