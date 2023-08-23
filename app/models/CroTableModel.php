<?php

class CroTableModel
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
        $query = $this->db->query("SELECT DISTINCT status FROM crotable");
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getTotalRows($searchKeyword, $filterValue)
    {
        $searchKeyword = $this->trimInput($searchKeyword);
        $filterValue = $this->trimInput($filterValue);

        $sql = "SELECT COUNT(*) as total FROM crotable";

        // Filtering
        if (!empty($searchKeyword) || !empty($filterValue)) {
            $sql .= " WHERE ";

            if (!empty($filterValue)) {
                $sql .= "status = '$filterValue' AND ";
            }
            if (!empty($searchKeyword)) {
                $sql .= "confirmation_no LIKE '%$searchKeyword%' OR agent_name LIKE '%$searchKeyword%' OR company LIKE '%$searchKeyword%' OR purchaser_name LIKE '%$searchKeyword%' AND ";
            }

            $sql = rtrim($sql, " AND ");
        }

        $query = $this->db->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getRows($limit, $offset, $sortColumn, $sortOrder, $searchKeyword, $filterValue)
    {
        $searchKeyword = $this->trimInput($searchKeyword);
        $filterValue = $this->trimInput($filterValue);
        $sql = "SELECT * FROM crotable";

        // Filtering
        if (!empty($searchKeyword) || !empty($filterValue)) {
            $sql .= " WHERE ";


            if (!empty($filterValue)) {
                $sql .= "status = '$filterValue' AND ";
            }
            if (!empty($searchKeyword)) {
                $sql .= "confirmation_no LIKE '%$searchKeyword%' OR agent_name LIKE '%$searchKeyword%' OR company LIKE '%$searchKeyword%' OR purchaser_name LIKE '%$searchKeyword%' AND ";
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
