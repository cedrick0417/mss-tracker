// function ralHandlePaginationClick(pageNumber) {
//   let data = $("#ral_search_form").serialize() + `&ralPage=${pageNumber}`;
//   ralHandleAjaxRequest(data);

//   $(`.paginationRal .ral-page-link`).removeClass("active"); // Remove active class from all links
//   $(`.paginationRal .ral-page-link[data-page="${pageNumber}"]`).addClass(
//     "active"
//   ); // Add active class to the current page link
// }
//
// RAL
//
function ralHandlePaginationClick(pageNumber, totalPages) {
  if (pageNumber === "first") {
    pageNumber = 1;
  } else if (pageNumber === "last") {
    pageNumber = totalPages;
  }

  // Handle Ajax request
  const data = $("#ral_search_form").serialize() + `&ralPage=${pageNumber}`;
  ralHandleAjaxRequest(data);

  // Update active class for page links
  $(".paginationRal .ral-page-link").removeClass("active");
  $(`.paginationRal .ral-page-link[data-page="${pageNumber}"]`).addClass(
    "active"
  );
}

$(document).ready(function () {
  const ralPaginationContainer = $(".paginationRal");
  const ralSortLinks = $(".sort-link-ral");
  const ralSearchForm = $("#ral_search_form");
  const ralFilter = $("#ralFilter");
  const ralTableBody = $("#ralDataTable tbody");

  ralPaginationContainer.on("click", ".ral-page-link[data-page]", function (e) {
    e.preventDefault();
    const pageValue = parseInt($(this).data("page"));
    ralHandlePaginationClick(pageValue);
  });

  ralSortLinks.on("click", function (e) {
    e.preventDefault();
    ralHandleSortingClick($(this));
  });

  ralSearchForm.on("submit", function (e) {
    e.preventDefault();
    ralHandleSearchSubmit($(this).serialize());
  });

  ralFilter.on("change", function () {
    ralHandleFilterChange(ralSearchForm.serialize());
  });
});

function ralHandleSortingClick(sortLink) {
  const sortColumn = sortLink.attr("data-column");
  const sortOrder = sortLink.hasClass("asc") ? "desc" : "asc";

  sortLink.addClass(sortOrder).siblings().removeClass("asc desc");

  const data = `${$(
    "#ral_search_form"
  ).serialize()}&sortral=${sortColumn}&orderral=${sortOrder}`;
  ralHandleAjaxRequest(data);
}

function ralHandleSearchSubmit(data) {
  const url = "api/ralController.php";
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
      ralRenderTable(response.rows);
      ralUpdatePagination(response.ralTotalPages, response.ralPage);
      htmlContainer.empty();
    },
  });
}
function ralHandleFilterChange(data) {
  ralHandleAjaxRequest(data);
}

function ralHandleAjaxRequest(data) {
  const url = "api/ralController.php";
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
      ralRenderTable(response.rows);
      // updatePagination(response.homeTotalPages, response.homePage);
      htmlContainer.empty();
    },
  });
}

//   // PAGINATION

//   $(".paginationRal").on("click", ".ral-page-link[data-page]", function (e) {
//     e.preventDefault();
//     const pageValue = parseInt($(this).data("page"));
//     ralHandlePaginationClick(pageValue);

//     // Add the active class to the clicked pagination link
//     $(this).addClass("active");
//   });

//   // SORTING
//   $(".sort-link-ral").on("click", function (e) {
//     e.preventDefault();
//     let sortColumn = $(this).attr("data-column");
//     let sortOrder = $(this).hasClass("asc") ? "desc" : "asc";
//     // Remove sorting class from all links
//     $(".sort-link-ral").removeClass("asc desc");
//     // Add sorting class to the current link
//     $(this).addClass(sortOrder);

//     // Perform AJAX request for sorting
//     let data =
//       $("#ral_search_form").serialize() +
//       `&sortral=${sortColumn}&orderral=${sortOrder}`;
//     ralHandleAjaxRequest(data);
//   });
//   // SEARCHING
//   $("#ral_search_form").on("submit", function (e) {
//     e.preventDefault();
//     let data = $(this).serialize();
//     ralHandleAjaxRequest(data);
//   });

//   // FILTERING
//   // Function to handle filter when the filter select changes
//   $("#ralFilter").on("change", function () {
//     let data = $("#ral_search_form").serialize();
//     ralHandleAjaxRequest(data);
//   });
// });

function ralRenderTable(rows) {
  const ralTableBody = $("#ralDataTable tbody");
  ralTableBody.empty();

  $.each(rows, function (index, row) {
    ralTableBody.append(`
    <tr>
    <td>${row.id}</td>
    <td>${row.confirmation_no}</td>
    <td>${row.website_address}</td>
    <td>${row.email_address}</td>
    <td>${row.card_no}</td>
    <td>${row.amount}</td>
    <td>${row.status}</td>
    <td>${row.date_of_refund}</td>
    <td>${row.date_of_purchase}</td>
    <td>${row.purchaser_name}</td>
    <td>${row.reason}</td>
    <td>${row.other_details}</td>
    <td>${row.representative}</td>
    <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
      row
    )}">View Details</button></td>
</tr>
      `);
  });
}

function ralUpdatePagination(totalPages, currentPage) {
  const ralPagination = $(".paginationRal");
  ralPagination.empty();

  // Add previous page link
  ralPagination.append(
    `<a href="#" class="ral-page-link" data-page="1">❮❮</a>`
  );

  // Add page links
  for (let i = 1; i <= totalPages; i++) {
    const activeClass = currentPage === i ? "active" : "";
    ralPagination.append(
      `<a href="#" class="ral-page-link ${activeClass}" onclick="ralHandlePaginationClick(${i})" data-page="${i}">${i}</a>`
    );
  }

  // Add next page link
  ralPagination.append(
    `<a href="#" class="ral-page-link" data-page="${totalPages}">❯❯</a>`
  );
}

// function ralHandleAjaxRequest(data) {
//   let url = "api/ralController.php";
//   let type = "POST";

//   $.ajax({
//     url: url,
//     type: type,
//     data: data,
//     beforeSend: function () {
//       $(".html-container").html("Loading...");
//     },
//     success: function (response) {
//       let tableBody = $("#ralDataTable tbody");
//       tableBody.empty();

//       $.each(response.rows, function (index, row) {
//         tableBody.append(`
//                                 <tr>
//                                     <td>${row.id}</td>
//                                     <td>${row.confirmation_no}</td>
//                                     <td>${row.website_address}</td>
//                                     <td>${row.email_address}</td>
//                                     <td>${row.card_no}</td>
//                                     <td>${row.amount}</td>
//                                     <td>${row.status}</td>
//                                     <td>${row.date_of_refund}</td>
//                                     <td>${row.date_of_purchase}</td>
//                                     <td>${row.purchase_name}</td>
//                                     <td>${row.reason}</td>
//                                     <td>${row.other_details}</td>
//                                     <td>${row.representative}</td>
//                                     <td><button class="modal-trigger view-btn" data-row="${JSON.stringify(
//                                       row
//                                     )}">View Details</button></td>
//                                 </tr>
//                             `);
//       });
//       ralTotalPages = response.ralTotalPages;
//       ralPage = response.ralPage;
//       $(`.paginationRal .-ral-page-link[data-page="${ralPage}"]`).addClass(
//         "active"
//       );

//       ralUpdatePaginationLinks(ralTotalPages, ralPage);

//       // $(".pagination").html(response.pagination);

//       $(".html-container").html("");
//     },
//     error: function (x, t, r) {
//       $(".html-container").html("Error occurred.");
//     },
//   });
// }

// function ralUpdatePaginationLinks(totalPages, currentPage) {
//   const pagination = $(".paginationRal");
//   pagination.empty();
//   // First button
//   pagination.append(`<a href="" class="ral-page-link" data-page="1">❮❮</a>`);

//   // // Previous button
//   // pagination.append(
//   //   `<a href="#" class="page-link" data-page="${
//   //     currentPage > 1 ? currentPage - 1 : 1
//   //   }">❮</a>`
//   // );

//   // Page number links
//   for (let i = 1; i <= totalPages; i++) {
//     pagination.append(
//       `<a href="" class="ral-page-link ${
//         currentPage === i ? "active" : ""
//       }" onclick="ralHandlePaginationClick(${i})" data-page="${i}">${i}</a>`
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
//     `<a href="" class="ral-page-link" data-page="${totalPages}">❯❯</a>`
//   );
// }
