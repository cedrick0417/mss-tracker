//
// NMM
//

function nmmHandlePaginationClick(pageNumber, totalPages) {
  if (pageNumber === "first") {
    pageNumber = 1;
  } else if (pageNumber === "last") {
    pageNumber = totalPages;
  }

  // Handle Ajax request
  const data = $("#nmm_search_form").serialize() + `&nmmPage=${pageNumber}`;
  nmmHandleAjaxRequest(data);

  // Update active class for page links
  $(".paginationnmm .nmm-page-link").removeClass("active");
  $(`.paginationnmm .nmm-page-link[data-page="${pageNumber}"]`).addClass(
    "active"
  );
}

$(document).ready(function () {
  const nmmPaginationContainer = $(".paginationNmm");
  const nmmSortLinks = $(".sort-link-nmm");
  const nmmSearchForm = $("#nmm_search_form");
  const nmmFilter = $("#nmmFilter");
  const nmmTableBody = $("#nmmDataTable tbody");

  nmmPaginationContainer.on("click", ".nmm-page-link[data-page]", function (e) {
    e.preventDefault();
    const pageValue = parseInt($(this).data("page"));
    nmmHandlePaginationClick(pageValue);
  });

  nmmSortLinks.on("click", function (e) {
    e.preventDefault();
    nmmHandleSortingClick($(this));
  });

  nmmSearchForm.on("submit", function (e) {
    e.preventDefault();
    nmmHandleSearchSubmit($(this).serialize());
  });

  nmmFilter.on("change", function () {
    nmmHandleFilterChange(nmmSearchForm.serialize());
  });
});

function nmmHandleSortingClick(sortLink) {
  const sortColumn = sortLink.attr("data-column");
  const sortOrder = sortLink.hasClass("asc") ? "desc" : "asc";

  sortLink.addClass(sortOrder).siblings().removeClass("asc desc");

  const data = `${$(
    "#nmm_search_form"
  ).serialize()}&sortnmm=${sortColumn}&ordernmm=${sortOrder}`;
  nmmHandleAjaxRequest(data);
}

function nmmHandleSearchSubmit(data) {
  const url = "api/nmmController.php";
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
      nmmRenderTable(response.rows);
      nmmUpdatePagination(response.nmmTotalPages, response.nmmPage);
      htmlContainer.empty();
    },
  });
}

function nmmHandleFilterChange(data) {
  nmmHandleAjaxRequest(data);
}

function nmmHandleAjaxRequest(data) {
  const url = "api/nmmController.php";
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
      nmmRenderTable(response.rows);
      // updatePagination(response.homeTotalPages, response.homePage);
      htmlContainer.empty();
    },
  });
}

function nmmRenderTable(rows) {
  const nmmTableBody = $("#nmmDataTable tbody");
  nmmTableBody.empty();

  $.each(rows, function (index, row) {
    nmmTableBody.append(`
    <tr>
    <td>${row.id}</td>
    <td>${row.confirmation_code}</td>
    <td>${row.merchant_info}</td>
    <td>${row.date_of_purchase}</td>
    <td>${row.amount}</td>
    <td>${row.contact_count}</td>
    <td>${row.date_requested}</td>
    <td>${row.pend_until_date}</td>
    <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
      row
    )}">View Details</button></td>
</tr>
      `);
  });
}

function nmmUpdatePagination(totalPages, currentPage) {
  const nmmPagination = $(".paginationNmm");
  nmmPagination.empty();

  // Add previous page link
  nmmPagination.append(
    `<a href="#" class="nmm-page-link" data-page="1">❮❮</a>`
  );

  // Add page links
  for (let i = 1; i <= totalPages; i++) {
    const activeClass = currentPage === i ? "active" : "";
    nmmPagination.append(
      `<a href="#" class="nmm-page-link ${activeClass}" onclick="nmmHandlePaginationClick(${i})" data-page="${i}">${i}</a>`
    );
  }

  // Add next page link
  nmmPagination.append(
    `<a href="#" class="nmm-page-link" data-page="${totalPages}">❯❯</a>`
  );
}

// $(document).ready(function () {
//   // PAGINATION

//   $(".paginationNmm").on("click", ".nmm-page-link[data-page]", function (e) {
//     e.preventDefault();
//     const pageValue = parseInt($(this).data("page"));
//     nmmHandlePaginationClick(pageValue);

//     // Add the active class to the clicked pagination link
//     $(this).addClass("active");
//   });

//   // SORTING
//   $(".sort-link-nmm").on("click", function (e) {
//     e.preventDefault();
//     let sortColumn = $(this).attr("data-column");
//     let sortOrder = $(this).hasClass("asc") ? "desc" : "asc";
//     // Remove sorting class from all links
//     $(".sort-link-nmm").removeClass("asc desc");
//     // Add sorting class to the current link
//     $(this).addClass(sortOrder);

//     // Perform AJAX request for sorting
//     let data =
//       $("#nmm_search_form").serialize() +
//       `&sortnmm=${sortColumn}&ordernmm=${sortOrder}`;
//     nmmHandleAjaxRequest(data);
//   });
//   // SEARCHING
//   $("#nmm_search_form").on("submit", function (e) {
//     e.preventDefault();
//     let data = $(this).serialize();
//     nmmHandleAjaxRequest(data);
//   });

//   // FILTERING
//   // Function to handle filter when the filter select changes
//   $("#filter").on("change", function () {
//     let data = $("#nmm_search_form").serialize();
//     nmmHandleAjaxRequest(data);
//   });
// });

// function nmmHandleAjaxRequest(data) {
//   let url = "api/nmmController.php";
//   let type = "POST";

//   $.ajax({
//     url: url,
//     type: type,
//     data: data,
//     beforeSend: function () {
//       $(".html-container").html("Loading...");
//     },
//     success: function (response) {
//       let tableBody = $("#nmmDataTable tbody");
//       tableBody.empty();

//       $.each(response.rows, function (index, row) {
//         tableBody.append(`
//                               <tr>
//                                   <td>${row.id}</td>
//                                   <td>${row.confirmation_code}</td>
//                                   <td>${row.merchant_info}</td>
//                                   <td>${row.date_of_purchase}</td>
//                                   <td>${row.amount}</td>
//                                   <td>${row.contact_count}</td>
//                                   <td>${row.date_requested}</td>
//                                   <td>${row.pend_until_date}</td>
//                                   <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
//                                     row
//                                   )}">View Details</button></td>
//                               </tr>
//                           `);
//       });

//       nmmTotalPages = response.nmmTotalPages;
//       nmmPage = response.nmmPage;
//       $(`.pagination .-nmm-page-link[data-page="${nmmPage}"]`).addClass(
//         "active"
//       );

//       nmmUpdatePaginationLinks(nmmTotalPages, nmmPage);
//       // $(".pagination").html(response.pagination);

//       $(".html-container").html("");
//     },
//     error: function (x, t, r) {
//       $(".html-container").html("Error occurred.");
//     },
//   });
// }

// function nmmUpdatePaginationLinks(totalPages, currentPage) {
//   const pagination = $(".paginationNmm");
//   pagination.empty();
//   // First button
//   pagination.append(`<a href="" class="nmm-page-link" data-page="1">❮❮</a>`);

//   // // Previous button
//   // pagination.append(
//   //   `<a href="#" class="page-link" data-page="${
//   //     currentPage > 1 ? currentPage - 1 : 1
//   //   }">❮</a>`
//   // );

//   // Page number links
//   for (let i = 1; i <= totalPages; i++) {
//     pagination.append(
//       `<a href="" class="nmm-page-link ${
//         currentPage === i ? "active" : ""
//       }" onclick="nmmHandlePaginationClick(${i})" data-page="${i}">${i}</a>`
//     );
//   }

//   // // Next button
//   // pagination.append(
//   //   `<a href="#" class="page-link" data-page="${
//   //     currentPage < totalPages ? currentPage + 1 : totalPages
//   //   }">❯</a>`
//   // );

//   // Last button
//   pagination.append(
//     `<a href="" class="nmm-page-link" data-page="${totalPages}">❯❯</a>`
//   );
// }
