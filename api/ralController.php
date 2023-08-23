<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../app/config.php';
require_once '../app/models/RalTableModel.php';
require_once '../app/controllers/RalTableController.php';



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Create the controller and model
    $controller = new RalTableController();
    $model = new RalTableModel();

    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';
    $filterValue = isset($_POST['filter']) ? $_POST['filter'] : '';

    // Set default values
    $defaultLimit = 5;
    $maxLimit = 100;

    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : $defaultLimit;
    $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

    $ralPage = isset($_POST['ralPage']) ? $_POST['ralPage'] : 1;
    $offset = ($ralPage - 1) * $limit;

    $sortColumn = isset($_POST['sortral']) ? $_POST['sortral'] : 'id';
    $sortOrder = isset($_POST['orderral']) ? $_POST['orderral'] : 'asc';

    // Get total rows using the model
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate total pages for pagination
    $ralTotalPages = ceil($totalRows / $limit);

    // Get rows for the current page using the model
    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'ralTotalPages' => $ralTotalPages
    );
    // Set the response header as JSON
    header('Content-Type: application/json');

    // Return the JSON response
    echo json_encode($response);
    exit();
}
function handleSorting($sortColumn, $sortOrder, $searchKeyword, $filterValue, $limit, $ralPage)
{
    $model = new RalTableModel();


    $ralPage = intval($ralPage);
    $limit = intval($limit);

    // Get total rows
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate pagination
    $ralTotalPages = ceil($totalRows / $limit);


    if ($ralPage < 1) {
        $ralPage = 1;
    } elseif ($ralPage > $ralTotalPages) {
        $ralPage = $ralTotalPages;
    }

    // Calculate offset based on the homePage and limit
    $offset = ($ralPage - 1) * $limit;


    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'ralTotalPages' => $ralTotalPages
    );


    header('Content-Type: application/json');


    echo json_encode($response);
    exit();
}



// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


//     $response = array(
//         'rows' => $rows,
//         'ralTotalPages' => $ralTotalPages
//     );


//     header('Content-Type: application/json');


//     echo json_encode($response);
//     exit();
// }
