<?php

// homeController.php

// Include necessary files and configurations
require_once 'app/models/HomeTableModel.php';
require_once 'app/controllers/HomeTableController.php';

// Assuming you have the HomeTableController class defined

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new HomeTableController();

    // Get the search keyword and filter value from the AJAX request
    $searchKeyword = isset($_POST["search"]) ? $_POST["search"] : '';
    $filterValue = isset($_POST["filter"]) ? $_POST["filter"] : '';

    // Get the filtered rows using the controller's search function
    $filteredRows = $controller->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

    // Convert the rows to JSON format and send the response
    echo json_encode($filteredRows);
    exit;
}
