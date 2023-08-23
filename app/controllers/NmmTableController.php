<?php

class NmmTableController
{
    private $model;

    public function __construct()
    {
        $this->model = new NmmTableModel();
    }

    public function handleRequestNmm()
    {
        // Set default values
        $defaultLimit = 5;
        $maxLimit = 100;

        $nmmItemsPerPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $nmmPage = isset($_GET['nmmPage']) ? $_GET['nmmPage'] : 1;
        $offset = ($nmmPage - 1) * $nmmItemsPerPage;

        $limit = isset($_GET['limit']) ? $_GET['limit'] : $defaultLimit;
        $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

        $nmmPage = isset($_GET['nmmPage']) ? $_GET['nmmPage'] : 1;
        $offset = ($nmmPage - 1) * $limit;

        $sortColumn = isset($_GET['sortnmm']) ? $_GET['sortnmm'] : 'id';
        $sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $filterValue = isset($_GET['filter']) ? $_GET['filter'] : '';

        // Get total rows
        $totalRows = $this->model->getTotalRows($searchKeyword, $filterValue);

        // Get rows for the current page
        $rows = $this->model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

        // Calculate total pages for pagination
        $nmmTotalPages = ceil($totalRows / $limit);

        // Get available filter values
        /* $filterValues = $this->model->getFilterValues();*/

        // Include the view
        require 'app/views/nmmtable.php';
    }
}
