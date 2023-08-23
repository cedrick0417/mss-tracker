<div id="nmm">
  <h1 class="table-title">Non Member Merchant</h1>
  <div class="flex">
  <form id="nmm_search_form" method="GET">
    <input id="searchInput" class="table-input" type="text" name="search" placeholder="Search keyword" value="<?php echo $searchKeyword; ?>">

      <!-- <select name="filter" class="table-select">
        <option value="">All</option>
        <?php foreach ($filterValues as $value) : ?>
        <option value="<?php echo $value; ?>" <?php echo $filterValue === $value ? 'selected' : ''; ?>>
          <?php echo $value; ?>
        </option>
        <?php endforeach; ?>
      </select>
      <button type="submit"class="table-btn">Filter</button> -->
      <button type="submit"class="table-btn">Search</button>

    </form>
    <input type="checkbox" id="toggle" />
      <label for="toggle" class="toggle-switch">
        <span class="toggle-ican">ICAN Transactions</span>
        <span class="toggle-payshield">Payshield Transactions</span>
      </label>
    <!-- Items per Page -->
    <form method="GET" action="">
      <label id="limit">Show:</label>
      <input  class="table-input"type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
      <button type="submit" class="table-btn">Apply</button>
    </form>
    <!-- Pagination -->
    <!-- <div class="pagination">
   
      <a href="?nmmPage=1&per_page=<?php echo $nmmItemsPerPage; ?>&search=<?php echo $searchKeyword; ?>&filter=<?php echo $filterValue; ?>&limit=<?php echo $limit; ?>">❮❮</a>
      <?php if ($nmmPage > 1) : ?>
      <a href="?nmmPage=<?php echo $nmmPage - 1; ?>&per_page=<?php echo $nmmItemsPerPage; ?>&search=<?php echo $searchKeyword; ?>&filter=<?php echo $filterValue; ?>&limit=<?php echo $limit; ?>">❮</a>            
      <?php endif; ?>
      <?php
        $startPage = max($nmmPage - 0, 1); //Change 0 to 1 to change value
    $endPage = min($nmmPage + 2, $nmmTotalPages);

    if ($startPage > 1) {
        echo '<span>...</span>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        echo '<a href="?nmmPage=' . $i . '&per_page=' . $nmmItemsPerPage . '&search=' . $searchKeyword . '&filter=' . $filterValue . '&limit=' . $limit .'">' . $i . '</a>';


    }

    if ($endPage < $nmmTotalPages) {
        echo '<span>...</span>';
    }
    ?>
      <?php if ($nmmPage < $nmmTotalPages) : ?>
      <a href="?nmmPage=<?php echo $nmmPage + 1; ?>&per_page=<?php echo $nmmItemsPerPage; ?>&search=<?php echo $searchKeyword; ?>&filter=<?php echo $filterValue; ?>&limit=<?php echo $limit; ?>">❯</a>
      <?php endif; ?>
      <a href="?nmmPage=<?php echo $nmmTotalPages; ?>&per_page=<?php echo $nmmItemsPerPage; ?>&search=<?php echo $searchKeyword; ?>&filter=<?php echo $filterValue; ?>&limit=<?php echo $limit; ?>">❯❯</a>
    </div> -->

    <div class="paginationNmm">
    <!-- First button -->
    <a href="#" class="nmm-page-link" onclick="nmmHandlePaginationClick('first', <?php echo $nmmTotalPages; ?>)">❮❮</a>

    <?php for ($i = 1; $i <= $nmmTotalPages; $i++) : ?>
      <a href="#" class="nmm-page-link <?php echo $nmmPage == $i ? 'active' : ''; ?>"
        onclick="nmmHandlePaginationClick(<?php echo $i; ?>, <?php echo $nmmTotalPages; ?>)" data-page="<?php echo $i; ?>">
    <?php echo $i; ?>
    </a>
    <?php endfor; ?> 

    <!-- Last button -->
    <a href="#" class="nmm-page-link" onclick="nmmHandlePaginationClick('last', <?php echo $nmmTotalPages; ?>)">❯❯</a>
</div>
  </div>
  <!-- Sorting -->
  <div class="outer-wrapper">
    <div class="inner-wrapper">
      <table id="nmmDataTable" >
        <thead>
          <tr>

          <th><a href="#" class="sort-link-nmm" data-column="id">ID</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="confirmation_code">Confirmation Code</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="merchant_info">Merchant Info</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="date_of_purchase">Date of Purchase</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="amount">Amount</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="contact_count">Contact Count</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="date_requested">Date Requested</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="pend_until_date">Pend until Date</a></th>
          <th><a href="#" class="sort-link-nmm" data-column="option">Option</a></th>


            <!-- <th><a href="?sort=id&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">ID</a></th>
            <th><a href="?sort=confirmation_code&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Confirmation Code</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Merchant Info</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Date Of Purchase</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Amount</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Contact Count</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Date Requested</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Pend until Date</a></th>
            <th><a href="?sort=merchant_info&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Options</a></th> -->
            <!-- <th><a href="?status&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Column Name</a></th> -->
            <!-- Add more columns here -->
          </tr>
        </thead>
        <tbody>
          <!-- Display rows -->
          <?php foreach ($rows as $row) : ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['confirmation_code']; ?></td>
            <td><?php echo $row['merchant_info']; ?></td>
            <td><?php echo $row['date_of_purchase']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['contact_count']; ?></td>
            <td><?php echo $row['date_requested']; ?></td>
            <td><?php echo $row['pend_until_date']; ?></td>
         
            <td><button class="nmm-modal-trigger view-btn" data-row="<?php echo htmlspecialchars(json_encode($row)); ?>">View Details</button></td>

            <!-- <td><?php echo $row['status']; ?></td> -->
            <!-- Add more columns here -->
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php require_once 'app/views/modals/nmm_modal.php';?>

</div>

<script src="public/js/ajax/nmm.js"></script>
