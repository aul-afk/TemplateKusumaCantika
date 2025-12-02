<?php
$scriptName = dirname($_SERVER['SCRIPT_NAME']); // /TemplateKusumaCantika-main/qc-final/public
$uri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']);
$uri = explode("/", trim($uri, "/"));

$controllerName = $uri[1] ?? "home"; // setelah index.php
$method = $uri[2] ?? "index";
$id = $uri[3] ?? null;

switch ($controllerName) {
    case "costume":
        require_once "../app/controllers/CostumeController.php";
        $controller = new CostumeController();

        if ($method === "index") $controller->index($id);
        else if ($method === "store") $controller->store();
        else if ($method === "update" && $id) $controller->update($id);
        else if ($method === "delete" && $id) $controller->delete($id);
        else $controller->index();
        break;

    default:
        echo "<h1>QC FINAL RUNNING!</h1>";
}
