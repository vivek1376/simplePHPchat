<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 11/5/14
 * Time: 12:26 AM
 */
session_start();
if(!isset($_SESSION['cart']))
{
    $_SESSION['cart']=array();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/magicquotes.inc.php';

$items=array(
    array('id'=>'1','desc'=>'Dictionary',
        'price'=>24.95),
    array('id'=>'2','desc'=>'Parachute',
        'price'=>1000),
    array('id'=>'3','desc'=>'Songs',
        'price'=>19.99),
    array('id'=>'4','desc'=>'Simply Javascript',
        'price'=>39.95));

if(isset($_POST['action']) && $_POST['action']=='Buy')
{
    $_SESSION['cart'][]=$_POST['id'];
    header('Location: .');
    exit();
}

if(isset($_POST['action']) && $_POST['action']=='Empty cart')
{
    //empty the session cart array
    unset($_SESSION['cart']);
    header('Location: .');
    exit();
}

if(isset($_GET['cart']))
{
    $cart=array();
    $total=0;
    foreach($_SESSION['cart'] as $id)
    {
        foreach($items as $product)
        {
            if($product['id']==$id)
            {
                $cart[]=$product;
                $total+=$product['price'];
                break;
            }
        }
    }

    include 'cart.html.php';
    exit();
}



include 'catalog.html.php';