 <?php

class RalTableController
{
    private $model;

    public function __construct()
    {
        $this->model = new RalTableModel();
    }

    public function handleRequestRal()
    {
        // Set default values
        $defaultLimit = 5;
        $maxLimit = 100;

        $ralItemsPerPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $ralPage = isset($_GET['ralPage']) ? $_GET['ralPage'] : 1;
        $offset = ($ralPage - 1) * $ralItemsPerPage;

        $limit = isset($_GET['limit']) ? $_GET['limit'] : $defaultLimit;
        $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range

        $ralPage = isset($_GET['ralPage']) ? $_GET['ralPage'] : 1;
        $offset = ($ralPage - 1) * $limit;

        $sortColumn = isset($_GET['sortral']) ? $_GET['sortral'] : 'id';
        $sortOrder = isset($_GET['orderral']) ? $_GET['orderral'] : 'asc';

        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $filterValue = isset($_GET['filter']) ? $_GET['filter'] : '';

        // Get total rows
        $totalRows = $this->model->getTotalRows($searchKeyword, $filterValue);

        // Get rows for the current page
        $rows = $this->model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

        // Calculate total pages for pagination
        $ralTotalPages = ceil($totalRows / $limit);

        // Get available filter values
        $filterValues = $this->model->getFilterValues();

        // Include the view
        require 'app/views/raltable.php';
    }
}
