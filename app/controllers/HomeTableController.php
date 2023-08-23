<?php

class HomeTableController
{
    private $model;

    public function __construct()
    {
        $this->model = new HomeTableModel();
    }

    public function handleRequestHome()
    {


        // Set default values
        $defaultLimit = 5;
        $maxLimit = 100;

        $homeItemsPerPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        // $homePage = isset($_GET['homePage']) ? $_GET['homePage'] : 1;
        // $offset = ($homePage - 1) * $homeItemsPerPage;

        $limit = isset($_GET['limit']) ? $_GET['limit'] : $defaultLimit;
        $limit = max(min($limit, $maxLimit), 1); // Ensure limit is within range


        $homePage = isset($_GET['homePage']) ? $_GET['homePage'] : 1;
        $offset = ($homePage - 1) * $limit;

        $sortColumn = isset($_GET['sorthome']) ? $_GET['sorthome'] : 'id';
        $sortOrder = isset($_GET['orderhome']) ? $_GET['orderhome'] : 'asc';

        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $filterValue = isset($_GET['filter']) ? $_GET['filter'] : '';

        // Get available filter values
        $filterValues = $this->model->getFilterValues();

        // Get total rows using the model
        $totalRows = $this->model->getTotalRows($searchKeyword, $filterValue);

        // Get rows for the current page
        $rows = $this->model->getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue);

        // Calculate total pages for pagination
        $homeTotalPages = ceil($totalRows / $limit);

        // Include the view
        require 'app/views/hometable.php';

    }
}
