<?php

// Include the necessary model and controller files
require_once 'app/models/HomeTableModel.php';
require_once 'app/controllers/HomeTableController.php';

// // Create instances of the model and controller
// $model = new HomeTableModel();
// $controller = new HomeTableController();

// // Get the search keyword and filter value from the AJAX request
// $searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';
// $filterValue = isset($_GET['filterValue']) ? $_GET['filterValue'] : '';

// // Get the rows based on the search keyword and filter value
// $rows = $model->getRows(10, 0, 'id', 'asc', $searchKeyword, $filterValue);

// // Return the response as JSON
// header('Content-Type: application/json');
// echo json_encode($rows);


// search.php

// Assuming you have the necessary includes and configurations here
// search.php

// search_home.php



$controller = new HomeTableController();

$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$filterValue = isset($_GET['filter']) ? $_GET['filter'] : '';

$rows = $controller->getRows(10, 0, 'id', 'asc', $searchKeyword, $filterValue);

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($rows);
exit;
