<?php
include_once("../../app/Controller.php");

$controller = new Controller();

$id = 0;
$idData = 0;
$act = "null";
$name = "null";
$contact = "null";
$position = 0;
$found = "false";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['act'] === "add") {
        $id = $controller->inputMechanic($_POST['first-name'], $_POST['last-name'], $_POST['contact'], $_POST['position']);
        $act = "add";
        $controller->displayMechanicPage();
    } elseif ($_POST['act'] === "find") {
        $data = $controller->searchMechanic($_POST['contactVerif'], $_POST['idVerif']);

        if(isset($data)) {
            $name = $data['NAMA_MECHANIC'];
            $contact =  $data['KONTAK_MECHANIC'];
            $position = $data['ID_SPECIALIST'];
            $idData = $data['ID_MECHANIC'];
            $found = "true";
        }
        $act = "search";
        $controller->displayMechanicPage();
    } elseif ($_POST['act'] === "edit") {
        $controller->modifyMechanic($_POST['first-name'], $_POST['last-name'], $_POST['contact'], $_POST['position'], $_POST['currentID']);
        $act = "edit";
        $controller->displayMechanicPage();
    } elseif ($_POST['act'] === "delete") {
        $controller->removeMechanic($_POST['currentID']);
        $act = "delete";
        $controller->displayMechanicPage();
    }
} else {
    $controller->displayMechanicPage();
}
