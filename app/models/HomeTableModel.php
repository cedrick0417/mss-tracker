<?php

class HomeTableModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

    private function trimInput($value)
    {
        return trim($value);
    }

    public function getFilterValues()
    {
        $query = $this->db->query("SELECT DISTINCT status FROM hometable");
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getTotalRows($searchKeyword, $filterValue)
    {

        $searchKeyword = $this->trimInput($searchKeyword);
        $filterValue = $this->trimInput($filterValue);


        $sql = "SELECT COUNT(*) as total FROM hometable";
        // $sql = "SELECT COUNT(*) FROM hometable WHERE client_company LIKE :searchKeyword AND status = :filterValue";

        // // Bind parameters and execute the query
        // $stmt = $this->db->prepare($sql);
        // $stmt->bindValue(':searchKeyword', '%' . $searchKeyword . '%');
        // $stmt->bindValue(':filterValue', $filterValue);
        // $stmt->execute();

        // // Fetch the count
        // $count = $stmt->fetchColumn();

        // return $count;
        // Select $keyword from your_rable where status = 'ACTIVE';


        // Filtering
        if (!empty($searchKeyword) || !empty($filterValue)) {
            $sql .= " WHERE ";

            if (!empty($filterValue)) {
                $sql .= "status = '$filterValue' AND ";
            }
            if (!empty($searchKeyword)) {
                $sql .= "client_company LIKE '%$searchKeyword%' OR website_address LIKE '%$searchKeyword%' AND ";
            }



            $sql = rtrim($sql, " AND ");
        }

        $query = $this->db->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];

        $totalPages = ceil($count / $limit);  // Calculate total pages

        return array(
            'totalRows' => $count,
            'totalPages' => $totalPages
        );
    }

    public function getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue)
    {

        $searchKeyword = $this->trimInput($searchKeyword);
        $filterValue = $this->trimInput($filterValue);
        $sql = "SELECT * FROM hometable";

        // Filtering
        if (!empty($searchKeyword) || !empty($filterValue)) {
            $sql .= " WHERE ";


            if (!empty($filterValue)) {
                $sql .= "status = '$filterValue' AND ";
            }
            if (!empty($searchKeyword)) {
                $sql .= "client_company LIKE '%$searchKeyword%' OR website_address LIKE '%$searchKeyword%' AND ";
            }

            $sql = rtrim($sql, " AND ");
        }


        // Sorting
        if (!empty($sortColumn)) {
            $sql .= " ORDER BY $sortColumn $sortOrder";
        }

        // Pagination
        $sql .= " LIMIT $limit OFFSET $offset";

        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
