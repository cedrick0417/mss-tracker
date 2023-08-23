<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../app/config.php';
require_once '../app/models/NmmTableModel.php';
require_once '../app/controllers/NmmTableController.php';



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Create the controller and model
    $controller = new NmmTableController();
    $model = new NmmTableModel();

    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';
    $filterValue = isset($_POST['filter']) ? $_POST['filter'] : '';

    // Set default values
    $defaultLimit = 5;
    $maxLimit = 100;

    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : $defaultLimit;
    $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

    $nmmPage = isset($_POST['nmmPage']) ? $_POST['nmmPage'] : 1;
    $offset = ($nmmPage - 1) * $limit;

    $sortColumn = isset($_POST['sortnmm']) ? $_POST['sortnmm'] : 'id';
    $sortOrder = isset($_POST['ordernmm']) ? $_POST['ordernmm'] : 'asc';

    // Get total rows using the model
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate total pages for pagination
    $nmmTotalPages = ceil($totalRows / $limit);

    // Get rows for the current page using the model
    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'nmmTotalPages' => $nmmTotalPages
    );
    // Set the response header as JSON
    header('Content-Type: application/json');

    // Return the JSON response
    echo json_encode($response);
    exit();
}
function handleSorting($sortColumn, $sortOrder, $searchKeyword, $filterValue, $limit, $nmmPage)
{
    $model = new NmmTableModel();


    $nmmPage = intval($nmmPage);
    $limit = intval($limit);

    // Get total rows
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate pagination
    $nmmTotalPages = ceil($totalRows / $limit);


    if ($nmmPage < 1) {
        $nmmPage = 1;
    } elseif ($nmmPage > $nmmTotalPages) {
        $nmmPage = $nmmTotalPages;
    }

    // Calculate offset based on the homePage and limit
    $offset = ($nmmPage - 1) * $limit;


    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'nmmTotalPages' => $nmmTotalPages
    );


    header('Content-Type: application/json');


    echo json_encode($response);
    exit();
}



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {


    $response = array(
        'rows' => $rows,
        'nmmTotalPages' => $nmmTotalPages
    );


    header('Content-Type: application/json');


    echo json_encode($response);
    exit();
}
