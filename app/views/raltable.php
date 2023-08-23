<div id="ral">
   <h1 class= "table-title">Refund Activity Logs</h1>
   <div class="flex">
   <form id="ral_search_form" method="GET">
    <input id="searchInput" class="table-input" type="text" name="search" placeholder="Search keyword" value="<?php echo $searchKeyword; ?>">

      <select id="ralFilter" name="filter" class="table-select">
        <option value="">All</option>
        <?php foreach ($filterValues as $value) : ?>
        <option value="<?php echo $value; ?>" <?php echo $filterValue === $value ? 'selected' : ''; ?>>
          <?php echo $value; ?>
        </option>
        <?php endforeach; ?>
      </select>
      <button type="submit"class="table-btn">Filter</button>
    </form>
      <!-- Items per Page -->
      <form method="GET" action="">
         <label id="limit">Show:</label>
         <input class="table-input" type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
         <button type="submit" class="table-btn">Apply</button>
      </form>
      <!-- Pagination -->
      <div class="paginationRal">
    <!-- First button -->
    <a href="#" class="ral-page-link" onclick="ralHandlePaginationClick('first', <?php echo $ralTotalPages; ?>)">❮❮</a>

    <?php for ($i = 1; $i <= $ralTotalPages; $i++) : ?>
      <a href="#" class="ral-page-link <?php echo $ralPage == $i ? 'active' : ''; ?>"
        onclick="ralHandlePaginationClick(<?php echo $i; ?>, <?php echo $ralTotalPages; ?>)" data-page="<?php echo $i; ?>">
    <?php echo $i; ?>
    </a>
    <?php endfor; ?> 

    <!-- Last button -->
    <a href="#" class="ral-page-link" onclick="ralHandlePaginationClick('last', <?php echo $ralTotalPages; ?>)">❯❯</a>
</div>

   </div>
   <!-- Sorting -->
   <div class="outer-wrapper">
      <div class="inner-wrapper">
      <table id= "ralDataTable">
            <thead>
               <tr>
                  <!-- <th><a href="?sortral=id&orderral=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">ID</a></th> -->
                  <th><a href="#" class="sort-link-ral" data-column="id">ID</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="confirmation_no">Confirmation No</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="website_address">Website Address</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="email_address">Email Address</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="card_no">Card No</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="amount">Amount</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="status">Status</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="date_of_refund">Date of Refund</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="date_of_purchase">Date of Purchase</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="purchase_name">Purchase Name</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="reason">Reason</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="other_details">Other Details</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="representative">Representative</a></th>
                  <th><a href="#" class="sort-link-ral" data-column="view_option">View Option</a></th>

                  <!-- <th><a href="?sort=confirmation_no&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Confirmation No</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Website Address</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Email Address</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Card No</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Amount</a></th>
                  <th><a href="?status&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Status</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Date of Refund</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Date of Purchase</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Purchase Name</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Reason</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Other Details</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Representative</a></th>
                  <th><a href="?sort=website_address&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">View Option</a></th> -->
                  <!-- Add more columns here -->
               </tr>
            </thead>
            <tbody>
               <!-- Display rows -->
               <?php foreach ($rows as $row) : ?>
               <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['confirmation_no']; ?></td>
                  <td><?php echo $row['website_address']; ?></td>
                  <td><?php echo $row['email_address']; ?></td>
                  <td><?php echo $row['card_no']; ?></td>
                  <td><?php echo $row['amount']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td><?php echo $row['date_of_refund']; ?></td>
                  <td><?php echo $row['date_of_purchase']; ?></td>
                  <td><?php echo $row['purchaser_name']; ?></td>
                  <td><?php echo $row['reason']; ?></td>
                  <td><?php echo $row['other_details']; ?></td>
                  <td><?php echo $row['representative']; ?></td>
                  <!-- <td><?php echo $row['view_option']; ?></td> -->
                  <!-- <td class="view-option" data-row='<?php echo json_encode($row); ?>'>View</td> -->
                  <!-- <td><button class="modal-trigger" data-row="<?php echo htmlspecialchars(json_encode($row)); ?>">View Details</button></td> -->

                  <td><button class="ral-modal-trigger view-btn" data-row="<?php echo htmlspecialchars(json_encode($row)); ?>">View Details</button></td>
                  <!-- Add more columns here -->
               </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
   <?php require_once 'app/views/modals/ral_modal.php';?>
</div>
<script src="public/js/ajax/ral.js"></script>