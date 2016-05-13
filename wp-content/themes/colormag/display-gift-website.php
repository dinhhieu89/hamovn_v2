<?php require_once('createweb/lib/process-data.php'); ?>
<?php
/**
 * Template Name: Hiển thị Website quà tặng
 *
 * Copyright hamovn 2016
 * @author Nguyen Dinh Hieu
 */
?>
<?php
$type = getWebTypeFromRequest();

switch($type) {
    case 'bo' :
        echo "Bố";
        break;
    case 'me' :
        echo "Mẹ";
        break;
    case 'con' :
        echo "Con";
        break;
    case 'vo' :
        echo "Vợ";
        break;
    case 'chong' :
        echo "Chồng";
        break;
    case 'nguoiyeu' :
        include_once('createweb/template/nguoiyeu2/main.php');
        break;
    case 'banthan' :
        echo "Bạn thân";
        break;
    default:
        header('Location: ' . get_home_url().'/tao-website-tang-nguoi-than/');
}