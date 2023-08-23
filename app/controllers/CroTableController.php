<?php

class CroTableController
{
    private $model;

    public function __construct()
    {
        $this->model = new CroTableModel();
    }

    public function handleRequestCro()
    {
        // Set default values
        $defaultLimit = 5;
        $maxLimit = 100;

        $croItemsPerPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $croPage = isset($_GET['croPage']) ? $_GET['croPage'] : 1;
        $offset = ($croPage - 1) * $croItemsPerPage;

        $limit = isset($_GET['limit']) ? $_GET['limit'] : $defaultLimit;
        $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

        $croPage = isset($_GET['croPage']) ? $_GET['croPage'] : 1;
        $offset = ($croPage - 1) * $limit;

        $sortColumn = isset($_GET['sortcro']) ? $_GET['sortcro'] : 'id';
        $sortOrder = isset($_GET['ordercro']) ? $_GET['ordercro'] : 'asc';

        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $filterValue = isset($_GET['filter']) ? $_GET['filter'] : '';

        // Get total rows
        $totalRows = $this->model->getTotalRows($searchKeyword, $filterValue);

        // Get rows for the current page
        $rows = $this->model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

        // Calculate total pages for pagination
        $croTotalPages = ceil($totalRows / $limit);

        // Get available filter values
        $filterValues = $this->model->getFilterValues();

        // Include the view
        require 'app/views/crotable.php';
    }
}
