// Refund modal

// Subscription cancellation modal

// document.addEventListener("DOMContentLoaded", function () {
//   var subCancellationLink = document.getElementById("sub-cancellation-link");
//   var subModal = document.querySelector(".subcancel-modal-container");
//   var subModalClose = document.getElementById("subcancel-modal-close");

//   subCancellationLink.addEventListener("click", function () {
//     subModal.style.display = "block";
//   });

//   subModalClose.addEventListener("click", function () {
//     subModal.style.display = "none";
//   });
// });

// (function ($) {
//   $.fn.Validate = function (callback = null) {
//     var container = this;
//     var hasEmpty = false;

//     $("input[req]", container).each(function () {
//       var input = $(this);

//       if (input.val().trim() === "") {
//         hasEmpty = true;

//         if ($.isFunction(callback)) {
//           callback(input);
//         }
//       }
//     });

//     return hasEmpty;
//   };
// })(jQuery);

// var IC4C = IC4C || {};

// IC4C.RefundCancellation = (function () {
//   var formSub = $("#form_sub_cancel");
//   var timeout = null;
// var searchAjax = null;
//   var descriptorSearch = $("#descriptor_search");
//   var activeMid = "";
//   var responseCont = $("#response_container");

//   // formSub.find("input[name=time_purchase]").datepicker();

//   formSub.on("submit", SubmitApplication);
//   // formSub.find('input[name=descriptor]').on('blur', SearchDescriptor);
//   formSub.find("input[name=descriptor]").on("keyup", SearchDescriptor);
//   $(document).on("click", ".search-ul li", SelectDescriptor);
//   $(document).on("keypress", ".number-field", _IntegerOnly);

//   function SearchDescriptor() {
//     var input = $(this);

//     var url = "https://ican4consumers.com/tracker2/csssubui/php/main_api.php";

//     clearTimeout(timeout);

//     if (searchAjax != null) searchAjax.abort();

//     descriptorSearch.html(`
//               <p><i class="fa fa-spinner fa-pulse fa-2x"></i> Searching ...</p>
//           `);

//     if (input.val().trim() === "") {
//       descriptorSearch.html("");
//       return;
//     }

//     timeout = setTimeout(function () {
//       searchAjax = $.ajax({
//         url: url,
//         data: {
//           descriptor: input.val(),
//           type: "search-descriptor",
//         },
//         type: "POST",
//         beforeSend: function () {},
//         error: function (x, h, r) {
//           console.log(x);
//           console.log(h);
//           console.log(r);
//         },
//         success: function (res) {
//           console.log(res);

//           if (res.code == "1") {
//             var html = `
//                       <b style="color: #1565c0">Search Result: </b>
//                       <ul class="search-ul">`;

//             res.data.forEach(function (val, i) {
//               html +=
//                 `
//                           <li data-id="` +
//                 val.mid +
//                 `" data-type="` +
//                 val.emailreq +
//                 `">` +
//                 val.DESCRIPTOR_TEXT +
//                 `</li>
//                       `;
//             });

//             html += `</ul>`;

//             descriptorSearch.html(html);
//           } else {
//             descriptorSearch.html(`
//                           <p>NO DATA FOUND</p>
//                       `);
//           }
//         },
//         complete: function () {},
//       });
//     }, 200);
//   }

//   function _IntegerOnly(evt) {
//     var charCode = evt.which ? evt.which : evt.keyCode;
//     if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;

//     return true;
//   }

//   function SubmitApplication(e) {
//     e.preventDefault();
//     $(this).find("input").removeClass("error-field");

//     var result = $(this).Validate(function (obj) {
//       obj.addClass("error-field");
//     });

//     if (result) {
//       return;
//     }

//     var form = $(this);
//     var data = $(this).serialize();
//     data += "&mid=" + activeMid;

//     var url = "https://ican4consumers.com/tracker2/csssubui/php/main_api.php";

//     $.ajax({
//       url: url,
//       data: data,
//       type: "POST",
//       beforeSend: function () {
//         form.find("button[type=submit]").prop("disabled", true);
//       },
//       error: function (x, h, r) {
//         console.log(x);
//         console.log(h);
//         console.log(r);
//       },
//       success: function (res) {
//         console.log(res);
//         var html = ``;

//         if (res.code == 1) {
//           html +=
//             `
//                       <div class="callout success" data-closable>
//                          <p style="color: #66bb6a; margin-bottom: 0"><span style="color: #2e7d32 !important;font-weight: 600">CANCELLATION HAS BEEN REQUESTED</span> : ` +
//             res.message +
//             `</p>
//                          <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
//                           <span aria-hidden="true">&times;</span>
//                         </button>
//                       </div>
//                   `;
//           activeMid = "";
//           formSub.find("input, textarea").val("");
//           formSub.find("input[name=type]").val("cancel-sub");
//         } else {
//           html +=
//             `
//                       <div class="callout alert" data-closable>
//                          <p style="color: #ef5350; margin-bottom: 0 "> <span style="color: #d32f2f !important;font-weight: 600 ">ERROR</span> - ` +
//             res.message +
//             `</p>
//                          <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
//                               <span aria-hidden="true">&times;</span>
//                         </button>
//                       </div>
//                   `;
//         }

//         responseCont.html(html);
//       },
//       complete: function () {
//         form.find("button[type=submit]").prop("disabled", false);
//       },
//     });
//   }

//   function SelectDescriptor() {
//     var descriptor = $(this).text();
//     activeMid = $(this).data("id");
//     emailReq = $(this).data("type");

//     formSub.find("input[name=descriptor]").val(descriptor);
//     descriptorSearch.html(``);

//     if (emailReq == 1) {
//       formSub.find("input[name=first6]").attr("req", true);
//       // formSub.find('input[name=last4]').attr("req",true);
//       formSub.find("span[name=ccnum]").html("*");
//       formSub.find("input[name=email]").attr("req", true);
//       formSub.find("span[name=email]").html("*");
//     } else {
//       formSub.find("input[name=first6]").removeAttr("req");
//       // formSub.find('input[name=last4]').removeAttr("req");
//       formSub
//         .find("span[name=ccnum]")
//         .html(
//           '* <h6 style="font-size:x-small;">(last 4 digit is required.)</h6>'
//         );
//       formSub.find("input[name=email]").removeAttr("req");
//       formSub.find("span[name=email]").html("");
//     }
//   }
// })();

//HOME MODAL

$(document).ready(function () {
  $(".modal-trigger").click(function () {
    var row = JSON.parse($(this).attr("data-row"));
    showRowDetailsModal(row);
  });

  $(".home-modal-close").click(function () {
    hideRowDetailsModal();
  });

  $(".home-modal-container").click(function (event) {
    if (!$(event.target).closest(".home-modal").length) {
      hideRowDetailsModal();
    }
  });

  function showRowDetailsModal(row) {
    $("#row-id").val(row["id"]);
    $("#row-client-company").val(row["client_company"]);
    $("#row-website-address").val(row["website_address"]);
    $("#row-descriptor").val(row["descriptor"]);
    $("#row-process-type").val(row["process_type"]);
    $("#row-status").val(row["status"]);
    $("#row-industry-type").val(row["industry_type"]);
    $("#row-date-added").val(row["date_added"]);
    $("#row-last-modified").val(row["last_modified"]);

    $(".home-modal-container").fadeIn();
  }

  function hideRowDetailsModal() {
    $(".home-modal-container").fadeOut();
  }
});

// RAL MODAL
$(document).ready(function () {
  $(".ral-modal-trigger").click(function () {
    var row = JSON.parse($(this).attr("data-row"));
    showRowDetailsModal(row);
  });

  $(".ral-modal-close").click(function () {
    hideRowDetailsModal();
  });

  $(".ral-modal-container").click(function (event) {
    if (!$(event.target).closest(".ral-modal").length) {
      hideRowDetailsModal();
    }
  });

  function showRowDetailsModal(row) {
    //    $('#row-id').val(row['id']);
    $("#ral-row-confirmation-no").val(row["confirmation_no"]);
    $("#ral-row-website-address").val(row["website_address"]);
    $("#ral-row-card-no").val(row["card_no"]);
    $("#ral-row-amount").val(row["amount"]);
    $("#ral-row-status").val(row["status"]);
    $("#ral-row-date-of-refund").val(row["date_of_refund"]);
    $("#ral-row-date-of-purchase").val(row["date_of_purchase"]);
    $("#ral-row-ip-address").val(row["ip_address"]);
    $("#ral-row-email").val(row["email"]);
    $("#ral-row-descriptor").val(row["descriptor"]);
    $("#ral-row-request-id").val(row["request_id"]);
    $("#ral-row-comment").val(row["comment"]);

    $(".ral-modal-container").fadeIn();
  }

  function hideRowDetailsModal() {
    $(".ral-modal-container").fadeOut();
  }
});

// CRO MODAL
$(document).ready(function () {
  $(".cro-modal-trigger").click(function () {
    var row = JSON.parse($(this).attr("data-row"));
    showRowDetailsModal(row);
  });

  $(".cro-modal-close").click(function () {
    hideRowDetailsModal();
  });

  $(".cro-modal-container").click(function (event) {
    if (!$(event.target).closest(".cro-modal").length) {
      hideRowDetailsModal();
    }
  });

  function showRowDetailsModal(row) {
    $("#nmm-row-firstName").val(row["id"]);
    $("#nmm-row-lastName").val(row["client_company"]);
    // $("#row-website-address").val(row["website_address"]);
    // $("#row-descriptor").val(row["descriptor"]);
    // $("#row-process-type").val(row["process_type"]);
    // $("#row-status").val(row["status"]);
    // $("#row-industry-type").val(row["industry_type"]);
    // $("#row-date-added").val(row["date_added"]);
    // $("#row-last-modified").val(row["last_modified"]);

    $(".cro-modal-container").fadeIn();
  }

  function hideRowDetailsModal() {
    $(".cro-modal-container").fadeOut();
  }
});

// NMM MODAL
$(document).ready(function () {
  $(".nmm-modal-trigger").click(function () {
    var row = JSON.parse($(this).attr("data-row"));
    showRowDetailsModal(row);
  });

  $(".nmm-modal-close").click(function () {
    hideRowDetailsModal();
  });

  $(".nmm-modal-container").click(function (event) {
    if (!$(event.target).closest(".nmm-modal").length) {
      hideRowDetailsModal();
    }
  });

  function showRowDetailsModal(row) {
    $("#nmm-row-firstName").val(row["id"]);
    $("#nmm-row-lastName").val(row["client_company"]);
    // $("#row-website-address").val(row["website_address"]);
    // $("#row-descriptor").val(row["descriptor"]);
    // $("#row-process-type").val(row["process_type"]);
    // $("#row-status").val(row["status"]);
    // $("#row-industry-type").val(row["industry_type"]);
    // $("#row-date-added").val(row["date_added"]);
    // $("#row-last-modified").val(row["last_modified"]);

    $(".nmm-modal-container").fadeIn();
  }

  function hideRowDetailsModal() {
    $(".nmm-modal-container").fadeOut();
  }
});
