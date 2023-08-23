function updatePagination(totalPages, currentPage) {
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
}

function handleLimitChange(formData) {
  const url = "api/homeController.php";
  const type = "POST";
  const htmlContainer = $(".html-container");

  $.ajax({
    url: url,
    type: type,
    data: formData,
    beforeSend: function () {
      htmlContainer.html("Loading...");
    },
    success: function (response) {
      renderTable(response.rows);
      htmlContainer.empty();

      const newTotalPages = calculateTotalPages(
        response.totalRows,
        response.limit
      );
      updatePagination(newTotalPages, response.homePage); // Update pagination with new total pages
    },
  });
}
