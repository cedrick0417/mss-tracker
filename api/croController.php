<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../app/config.php';
require_once '../app/models/CroTableModel.php';
require_once '../app/controllers/CroTableController.php';



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Create the controller and model
    $controller = new CroTableController();
    $model = new CroTableModel();

    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';
    $filterValue = isset($_POST['filter']) ? $_POST['filter'] : '';

    // Set default values
    $defaultLimit = 5;
    $maxLimit = 100;

    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : $defaultLimit;
    $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

    $croPage = isset($_POST['croPage']) ? $_POST['croPage'] : 1;
    $offset = ($croPage - 1) * $limit;

    $sortColumn = isset($_POST['sortcro']) ? $_POST['sortcro'] : 'id';
    $sortOrder = isset($_POST['ordercro']) ? $_POST['ordercro'] : 'asc';

    // Get total rows using the model
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate total pages for pagination
    $croTotalPages = ceil($totalRows / $limit);

    // Get rows for the current page using the model
    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'croTotalPages' => $croTotalPages
    );
    // Set the response header as JSON
    header('Content-Type: application/json');

    // Return the JSON response
    echo json_encode($response);
    exit();
}
function handleSorting($sortColumn, $sortOrder, $searchKeyword, $filterValue, $limit, $croPage)
{
    $model = new CroTableModel();


    $croPage = intval($croPage);
    $limit = intval($limit);

    // Get total rows
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate pagination
    $croTotalPages = ceil($totalRows / $limit);


    if ($croPage < 1) {
        $croPage = 1;
    } elseif ($croPage > $croTotalPages) {
        $croPage = $croTotalPages;
    }

    // Calculate offset based on the homePage and limit
    $offset = ($croPage - 1) * $limit;


    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'croTotalPages' => $croTotalPages
    );


    header('Content-Type: application/json');


    echo json_encode($response);
    exit();
}



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    $response = array(
        'rows' => $rows,
        'croTotalPages' => $croTotalPages
    );


    header('Content-Type: application/json');


    echo json_encode($response);
    exit();
}
