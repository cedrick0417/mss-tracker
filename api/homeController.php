<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../app/config.php';
require_once '../app/models/HomeTableModel.php';
require_once '../app/controllers/HomeTableController.php';



if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Create the controller and model
    $controller = new HomeTableController();
    $model = new HomeTableModel();

    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';
    $filterValue = isset($_POST['filter']) ? $_POST['filter'] : '';

    // Set default values
    $defaultLimit = 5;
    $maxLimit = 100;

    $limit = isset($_POST['limit']) ? (int)$_POST['limit'] : $defaultLimit;
    $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

    $homePage = isset($_POST['homePage']) ? $_POST['homePage'] : 1;
    $offset = ($homePage - 1) * $limit;

    $sortColumn = isset($_POST['sorthome']) ? $_POST['sorthome'] : 'id';
    $sortOrder = isset($_POST['orderhome']) ? $_POST['orderhome'] : 'asc';

    // Get total rows using the model
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate total pages for pagination
    $homeTotalPages = ceil($totalRows / $limit);

    // Get rows for the current page using the model
    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'homeTotalPages' => $homeTotalPages
    );
    // Set the response header as JSON
    header('Content-Type: application/json');

    // Return the JSON response
    echo json_encode($response);
    exit();

}
function handleSorting($sortColumn, $sortOrder, $searchKeyword, $filterValue, $limit, $homePage)
{
    $model = new HomeTableModel();


    $homePage = intval($homePage);
    $limit = intval($limit);

    // Get total rows
    $totalRows = $model->getTotalRows($searchKeyword, $filterValue);

    // Calculate pagination
    $homeTotalPages = ceil($totalRows / $limit);


    if ($homePage < 1) {
        $homePage = 1;
    } elseif ($homePage > $homeTotalPages) {
        $homePage = $homeTotalPages;
    }

    // Calculate offset based on the homePage and limit
    $offset = ($homePage - 1) * $limit;


    $rows = $model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Prepare the response array
    $response = array(
        'rows' => $rows,
        'homeTotalPages' => $homeTotalPages
    );


    header('Content-Type: application/json');


    echo json_encode($response);
    exit();
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $response = array(
        'rows' => $rows,
        'homeTotalPages' => $homeTotalPages
    );

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
