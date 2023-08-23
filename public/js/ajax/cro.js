//
// CRO
//

function croHandlePaginationClick(pageNumber, totalPages) {
  if (pageNumber === "first") {
    pageNumber = 1;
  } else if (pageNumber === "last") {
    pageNumber = totalPages;
  }

  // Handle Ajax request
  const data = $("#cro_search_form").serialize() + `&croPage=${pageNumber}`;
  croHandleAjaxRequest(data);

  // Update active class for page links
  $(".paginationCro .cro-page-link").removeClass("active");
  $(`.paginationCro .cro-page-link[data-page="${pageNumber}"]`).addClass(
    "active"
  );
}

$(document).ready(function () {
  const croPaginationContainer = $(".paginationCro");
  const croSortLinks = $(".sort-link-cro");
  const croSearchForm = $("#cro_search_form");
  const croFilter = $("#croFilter");
  const croTableBody = $("#croDataTable tbody");

  croPaginationContainer.on("click", ".cro-page-link[data-page]", function (e) {
    e.preventDefault();
    const pageValue = parseInt($(this).data("page"));
    croHandlePaginationClick(pageValue);
  });

  croSortLinks.on("click", function (e) {
    e.preventDefault();
    croHandleSortingClick($(this));
  });

  croSearchForm.on("submit", function (e) {
    e.preventDefault();
    croHandleSearchSubmit($(this).serialize());
  });

  croFilter.on("change", function () {
    croHandleFilterChange(croSearchForm.serialize());
  });
});

function croHandleSortingClick(sortLink) {
  const sortColumn = sortLink.attr("data-column");
  const sortOrder = sortLink.hasClass("asc") ? "desc" : "asc";

  sortLink.addClass(sortOrder).siblings().removeClass("asc desc");

  const data = `${$(
    "#cro_search_form"
  ).serialize()}&sortcro=${sortColumn}&ordercro=${sortOrder}`;
  croHandleAjaxRequest(data);
}
function croHandleSearchSubmit(data) {
  const url = "api/croController.php";
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
      croRenderTable(response.rows);
      croUpdatePagination(response.croTotalPages, response.croPage);
      htmlContainer.empty();
    },
  });
}

function croHandleFilterChange(data) {
  croHandleAjaxRequest(data);
}

function croHandleAjaxRequest(data) {
  const url = "api/croController.php";
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
      croRenderTable(response.rows);
      // updatePagination(response.homeTotalPages, response.homePage);
      htmlContainer.empty();
    },
  });
}
function croRenderTable(rows) {
  const croTableBody = $("#croDataTable tbody");
  croTableBody.empty();

  $.each(rows, function (index, row) {
    croTableBody.append(`
    <tr>
                                    <td>${row.id}</td>
                                    <td>${row.confirmation_no}</td>
                                    <td>${row.descriptor}</td>
                                    <td>${row.agent_name}</td>
                                    <td>${row.purchaser_name}</td>
                                    <td>${row.date_of_refund}</td>
                                    <td>${row.company}</td>
                                    <td>${row.status}</td>
                                    <td>${row.origin}</td>
                                    <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
                                      row
                                    )}">View Details</button></td>
                                </tr>
      `);
  });
}

function croUpdatePagination(totalPages, currentPage) {
  const croPagination = $(".paginationCro");
  croPagination.empty();

  // Add previous page link
  croPagination.append(
    `<a href="#" class="cro-page-link" data-page="1">❮❮</a>`
  );

  // Add page links
  for (let i = 1; i <= totalPages; i++) {
    const activeClass = currentPage === i ? "active" : "";
    croPagination.append(
      `<a href="#" class="cro-page-link ${activeClass}" onclick="croHandlePaginationClick(${i})" data-page="${i}">${i}</a>`
    );
  }

  // Add next page link
  croPagination.append(
    `<a href="#" class="cro-page-link" data-page="${totalPages}">❯❯</a>`
  );
}

// $(document).ready(function () {
//   // PAGINATION

//   $(".paginationCro").on("click", ".cro-page-link[data-page]", function (e) {
//     e.preventDefault();
//     const pageValue = parseInt($(this).data("page"));
//     croHandlePaginationClick(pageValue);

//     // Add the active class to the clicked pagination link
//     $(this).addClass("active");
//   });

//   // SORTING
//   $(".sort-link-cro").on("click", function (e) {
//     e.preventDefault();
//     let sortColumn = $(this).attr("data-column");
//     let sortOrder = $(this).hasClass("asc") ? "desc" : "asc";
//     // Remove sorting class from all links
//     $(".sort-link-cro").removeClass("asc desc");
//     // Add sorting class to the current link
//     $(this).addClass(sortOrder);
//     // Perform AJAX request for sorting
//     let data =
//       $("#cro_search_form").serialize() +
//       `&sortcro=${sortColumn}&ordercro=${sortOrder}`;
//     croHandleAjaxRequest(data);
//   });
//   // SEARCHING
//   $("#cro_search_form").on("submit", function (e) {
//     e.preventDefault();
//     let data = $(this).serialize();
//     croHandleAjaxRequest(data);
//   });

//   // FILTERING
//   // Function to handle filter when the filter select changes
//   $("#croFilter").on("change", function () {
//     let data = $("#cro_search_form").serialize();
//     croHandleAjaxRequest(data);
//   });
// });

// function croHandlePaginationClick(pageNumber) {
//   let data = $("#cro_search_form").serialize() + `&croPage=${pageNumber}`;
//   croHandleAjaxRequest(data);

//   $(`.paginationCro .cro-page-link`).removeClass("active"); // Remove active class from all links
//   $(`.paginationCro .cro-page-link[data-page="${pageNumber}"]`).addClass(
//     "active"
//   ); // Add active class to the current page link
// }

// function croHandleAjaxRequest(data) {
//   let url = "api/croController.php";
//   let type = "POST";

//   $.ajax({
//     url: url,
//     type: type,
//     data: data,
//     beforeSend: function () {
//       $(".html-container").html("Loading...");
//     },
//     success: function (response) {
//       let tableBody = $("#croDataTable tbody");
//       tableBody.empty();

//       $.each(response.rows, function (index, row) {
//         tableBody.append(`
//                                 <tr>
//                                     <td>${row.id}</td>
//                                     <td>${row.confirmation_no}</td>
//                                     <td>${row.descriptor}</td>
//                                     <td>${row.agent_name}</td>
//                                     <td>${row.purchaser_name}</td>
//                                     <td>${row.date_of_refund}</td>
//                                     <td>${row.company}</td>
//                                     <td>${row.status}</td>
//                                     <td>${row.origin}</td>
//                                     <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
//                                       row
//                                     )}">View Details</button></td>
//                                 </tr>
//                             `);
//       });
//       croTotalPages = response.croTotalPages;
//       croPage = response.croPage;

//       croUpdatePaginationLinks(croTotalPages, croPage);

//       // $(".pagination").html(response.pagination);

//       $(".html-container").html("");
//     },
//     error: function (x, t, r) {
//       $(".html-container").html("Error occurred.");
//     },
//   });
// }

// function croUpdatePaginationLinks(totalPages, currentPage) {
//   const pagination = $(".paginationCro");
//   pagination.empty();
//   // First button
//   pagination.append(`<a href="#" class="cro-page-link" data-page="1">❮❮</a>`);

//   // // Previous button
//   // pagination.append(
//   //   `<a href="#" class="page-link" data-page="${
//   //     currentPage > 1 ? currentPage - 1 : 1
//   //   }">❮</a>`
//   // );

//   // Page number links
//   for (let i = 1; i <= totalPages; i++) {
//     pagination.append(
//       `<a href="#" class="cro-page-link ${
//         currentPage === i ? "active" : ""
//       }" onclick="croHandlePaginationClick(${i})" data-page="${i}">${i}</a>`
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
//     `<a href="#" class="cro-page-link" data-page="${totalPages}">❯❯</a>`
//   );
// }
