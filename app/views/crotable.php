<div id="cro">
  <h1 class="table-title" id="cro">Consumer Request Origin</h1>
  <div class="flex">
  <form id="cro_search_form" method="GET">
    <input id="searchInput" class="table-input" type="text" name="search" placeholder="Search keyword" value="<?php echo $searchKeyword; ?>">

      <select id="croFilter" name="filter" class="table-select">
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
      <label id="limit">Items per Page:</label>
      <input class="table-input" type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
      <button type="submit" class="table-btn">Apply</button>
    </form>
    <!-- Pagination -->
    <div class="paginationCro">
    <!-- First button -->
    <a href="#" class="cro-page-link" onclick="croHandlePaginationClick('first', <?php echo $croTotalPages; ?>)">❮❮</a>

    <?php for ($i = 1; $i <= $croTotalPages; $i++) : ?>
      <a href="#" class="cro-page-link <?php echo $croPage == $i ? 'active' : ''; ?>"
        onclick="croHandlePaginationClick(<?php echo $i; ?>, <?php echo $croTotalPages; ?>)" data-page="<?php echo $i; ?>">
    <?php echo $i; ?>
    </a>
    <?php endfor; ?> 

    <!-- Last button -->
    <a href="#" class="cro-page-link" onclick="croHandlePaginationClick('last', <?php echo $croTotalPages; ?>)">❯❯</a>
</div>
  </div>
  <!-- Sorting -->
  <div class="outer-wrapper">
    <div class="inner-wrapper">
    <table id= "croDataTable">
        <thead>
          <tr>

          <th><a href="#" class="sort-link-cro" data-column="id">ID</a></th>
          <th><a href="#" class="sort-link-cro" data-column="confirmation_no">Confirmation No</a></th>
          <th><a href="#" class="sort-link-cro" data-column="descriptor">Descriptor</a></th>
          <th><a href="#" class="sort-link-cro" data-column="agent_name">Agent Name</a></th>
          <th><a href="#" class="sort-link-cro" data-column="purchaser_name">Purchase Name</a></th>
          <th><a href="#" class="sort-link-cro" data-column="date_of_refund">Date of Refund</a></th>
          <th><a href="#" class="sort-link-cro" data-column="company">Company</a></th>
          <th><a href="#" class="sort-link-cro" data-column="status">Status</a></th>
          <th><a href="#" class="sort-link-cro" data-column="origin">Origin</a></th>
          <th><a href="#" class="sort-link-cro" data-column="option">Options</a></th>

            <!-- <th><a href="?sort=id&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">ID</a></th>
            <th><a href="?sort=confirmation_no&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Confirmation No</a></th>
            <th><a href="?sort=descriptor&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Descriptor</a></th>
            <th><a href="?sort=agent_name&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Agent Name</a></th>
            <th><a href="?sort=agent_name&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Purchase Name</a></th>
            <th><a href="?sort=agent_name&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Date Of Refund</a></th>
            <th><a href="?sort=agent_name&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Company</a></th>
            <th><a href="?status&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Status</a></th>
            <th><a href="?status&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Origin</a></th>
            <th><a href="?status&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Options</a></th> -->
            <!-- Add more columns here -->
          </tr>
        </thead>
        <tbody>
          <!-- Display rows -->
          <?php foreach ($rows as $row) : ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['confirmation_no']; ?></td>
            <td><?php echo $row['descriptor']; ?></td>
            <td><?php echo $row['agent_name']; ?></td>
            <td><?php echo $row['purchaser_name']; ?></td>
            <td><?php echo $row['date_of_refund']; ?></td>
            <td><?php echo $row['company']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['origin']; ?></td>
            <td><button class="cro-modal-trigger view-btn" data-row="<?php echo htmlspecialchars(json_encode($row)); ?>">View Details</button></td>

            <!-- Add more columns here -->
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php require_once 'app/views/modals/cro_modal.php';?>

</div>
<script src="public/js/ajax/cro.js"></script>