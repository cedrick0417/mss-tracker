// //
// // HOME
// //

function handlePaginationClick(pageNumber, totalPages, currentLimit) {
  if (pageNumber === "first") {
    pageNumber = 1;
  } else if (pageNumber === "last") {
    pageNumber = totalPages;
  } else {
    pageNumber = parseInt(pageNumber); // Parse the pageNumber to an integer
  }

  // Handle Ajax request
  const data =
    $("#home_search_form").serialize() +
    `&homePage=${pageNumber}&limit=${currentLimit}`;
  handleAjaxRequest(data);

  // Update active class for page links
  $(".pagination .page-link").removeClass("active");
  $(`.pagination .page-link[data-page="${pageNumber}"]`).addClass("active");
}

function calculateTotalPages(totalRows, newLimit) {
  return Math.ceil(totalRows / newLimit);
}

function handleLimitChange(newLimit) {
  const currentPage = 1; // Reset to the first page

  // Handle Ajax request
  const data =
    $("#home_search_form").serialize() +
    `&homePage=${currentPage}&limit=${newLimit}`;
  handleAjaxRequest(data);
}

console.log("ha");
$(document).ready(function () {
  const paginationContainer = $(".pagination");
  const sortLinks = $(".sort-link");
  const searchForm = $("#home_search_form");
  const homeFilter = $("#homeFilter");
  const tableBody = $("#dataTable tbody");

  const limitSelect = $("#limitSelect");

  limitSelect.on("change", function () {
    const newLimit = parseInt($(this).val());
    handleLimitChange(newLimit);
  });

  $("form#limitForm").on("submit", function (e) {
    e.preventDefault(); // Prevent form submission

    const newLimit = parseInt($("input[name='limit']").val());

    // Handle limit change and update pagination
    handleLimitChange(newLimit);
  });

  paginationContainer.on("click", ".page-link[data-page]", function (e) {
    e.preventDefault();
    const pageValue = parseInt($(this).data("page"));
    const currentLimit = parseInt($("select[name='limit']").val()); // Use select tag value
    handlePaginationClick(pageValue, response.homeTotalPages, currentLimit);
  });

  sortLinks.on("click", function (e) {
    e.preventDefault();
    handleSortingClick($(this));
  });

  searchForm.on("submit", function (e) {
    e.preventDefault();
    handleSearchSubmit($(this).serialize());
  });

  homeFilter.on("change", function () {
    handleFilterChange(searchForm.serialize());
  });
});

function handleSortingClick(sortLink) {
  const sortColumn = sortLink.attr("data-column");
  let sortOrder = "asc"; // Default to ascending order

  // Check if the column is already sorted in ascending order
  if (sortLink.hasClass("asc")) {
    sortOrder = "desc"; // Change to descending order
  }

  // Update the sorting classes for all column headers
  $(".sort-link").removeClass("asc desc");
  sortLink.addClass(sortOrder);

  const data = `${$(
    "#home_search_form"
  ).serialize()}&sorthome=${sortColumn}&orderhome=${sortOrder}`;
  handleAjaxRequest(data);
}

function handleSearchSubmit(data) {
  const url = "api/homeController.php";
  const type = "POST";
  const htmlContainer = $(".html-container");

  $.ajax({
    url: url,
    type: type,
    data: data,
    beforeSend: function () {
      htmlContainer.html("Loading...");
    },
    success: function (response) {
      renderTable(response.rows);
      updatePagination(response.homeTotalPages, response.homePage);
      htmlContainer.empty();
    },
  });
}

function handleFilterChange(data) {
  handleAjaxRequest(data);
}

function handleAjaxRequest(data) {
  const url = "api/homeController.php";
  const type = "POST";
  const htmlContainer = $(".html-container");

  $.ajax({
    url: url,
    type: type,
    data: data,
    beforeSend: function () {
      htmlContainer.html("Loading...");
    },
    success: function (response) {
      renderTable(response.rows);
      updatePagination(
        response.homeTotalPages,
        response.homePage,
        response.limit
      ); // Update pagination with new limit
      htmlContainer.empty();
    },
  });
}
function renderTable(rows) {
  const tableBody = $("#dataTable tbody");
  tableBody.empty();

  $.each(rows, function (index, row) {
    tableBody.append(`
        <tr>
          <td>${row.id}</td>
          <td>${row.client_company}</td>
          <td>${row.website_address}</td>
          <td>${row.descriptor}</td>
          <td>${row.process_type}</td>
          <td>${row.status}</td>
          <td>${row.industry_type}</td>
          <td>${row.date_added}</td>
          <td>${row.last_modified}</td>
          <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
            row
          )}">View Details</button></td>
        </tr>
      `);
  });
}

function updatePagination(totalPages, currentPage, limit) {
  const pagination = $(".pagination");
  pagination.empty();

  // Add previous page link
  pagination.append(
    `<a href="#" class="page-link" onclick="handlePaginationClick('first', ${totalPages})">❮❮</a>`
  );

  // Add page links
  for (let i = 1; i <= totalPages; i++) {
    const activeClass = currentPage === i ? "active" : "";
    pagination.append(
      `<a href="#" class="page-link ${activeClass}" onclick="handlePaginationClick(${i}, ${totalPages})" data-page="${i}">${i}</a>`
    );
  }

  // Add next page link
  pagination.append(
    `<a href="#" class="page-link" onclick="handlePaginationClick('last', ${totalPages})">❯❯</a>`
  );

  // Update the selected option in the limit select tag
  $("select[name='limit']").val(limit);
}
