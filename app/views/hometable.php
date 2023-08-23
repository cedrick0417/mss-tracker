<div id="home">
  <h1 class="table-title">Home</h1>
  <div class="flex">
  <form id="home_search_form" method="GET">
    <input id="searchInput" class="table-input" type="text" name="search" placeholder="Search keyword" value="<?php echo $searchKeyword; ?>">

      <select id="homeFilter" name="filter" class="table-select">
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
<!-- <form id="limitForm">
  <label id="limit">Show:</label>
  <input class="table-input" type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
  <button type="submit" class="table-btn">Apply</button>
</form> -->
<!-- <label for="limit">Show:</label>
<select id="limitSelect" class="table-select" name="limit">
  <option value="5">5</option>
  <option value="10">10</option>
  <option value="15">15</option>
</select>
<button type="submit" class="table-btn">Apply</button> -->

<form id="limitForm">
  <label id="limit">Show:</label>
  <select class="table-select" name="limit" onchange="handleLimitChange(this.value)">
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <!-- Add more options as needed -->
  </select>
  <button type="submit" class="table-btn">Apply</button>
</form>
<!-- LATEST PAGINATION -->


<div id="paginationContainer" class="pagination">
    <!-- First button -->
    <a href="#" class="page-link" onclick="handlePaginationClick('first', <?php echo $homeTotalPages; ?>)">❮❮</a>

    <?php for ($i = 1; $i <= $homeTotalPages; $i++) : ?>
      <a href="#" class="page-link <?php echo $homePage == $i ? 'active' : ''; ?>"
        onclick="handlePaginationClick(<?php echo $i; ?>, <?php echo $homeTotalPages; ?>)" data-page="<?php echo $i; ?>">
    <?php echo $i; ?>
    </a>
    <?php endfor; ?>

    <!-- Last button -->
    <a href="#" class="page-link" onclick="handlePaginationClick('last', <?php echo $homeTotalPages; ?>)">❯❯</a>
</div>

  </div>
  <!-- Sorting -->
  <div class="outer-wrapper">
    <div class="inner-wrapper">
      <table id= "dataTable">
        <thead>
          <tr>
            <!-- <th><button onclick="sortTable('id', '<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>')">ID</button></th> -->
            <th><a href="#" class="sort-link" data-column="id">ID</a></th>
        <th><a href="#" class="sort-link" data-column="client_company">Client Company</a></th>
        <th><a href="#" class="sort-link" data-column="website_address">Website Address</a></th>
        <th><a href="#" class="sort-link" data-column="descriptor">Descriptor</a></th>
        <th><a href="#" class="sort-link" data-column="process_type">Process Types</a></th>
        <th><a href="#" class="sort-link" data-column="status">Status</a></th>
        <th><a href="#" class="sort-link" data-column="industry_type">Industry Type</a></th>
        <th><a href="#" class="sort-link" data-column="date_added">Date Added</a></th>
        <th><a href="#" class="sort-link" data-column="last_modified">Last Modified</a></th>
        <th><a href="#" class="sort-link" data-column="last_modified">Option</a></th>


            <!-- <th><a href="?sorthome=website_address&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Website Address</a></th>
            <th><a href="?sorthome=descriptor&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Descriptor</a></th>
            <th><a href="?sorthome=process_type&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Process Types</a></th>
            <th><a href="?status&order=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Status</a></th>
            <th><a href="?sorthome=industry_type&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Industry Type</a></th>
            <th><a href="?sorthome=date_added&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Date Added</a></th>
            <th><a href="?sorthome=last_modified&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Last Modified</a></th>
            <th><a href="?sorthome=industry_type&orderhome=<?php echo $sortOrder == 'asc' ? 'desc' : 'asc'; ?>">Option</a></th> -->
            <!-- Add more columns here -->
          </tr>
        </thead>
        <tbody>
          <!-- Display rows -->
          <?php foreach ($rows as $row) : ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['client_company']; ?></td>
            <td><?php echo $row['website_address']; ?></td>
            <td><?php echo $row['descriptor']; ?></td>
            <td><?php echo $row['process_type']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['industry_type']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
            <td><?php echo $row['last_modified']; ?></td>
            <td><button class="modal-trigger view-btn" data-row="<?php echo htmlspecialchars(json_encode($row)); ?>">View Details</button></td>
            <!-- Add more columns here -->
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php require_once 'app/views/modals/home_modal.php';?>
</div>




<script src="public/js/ajax/hometable.js"></script>
