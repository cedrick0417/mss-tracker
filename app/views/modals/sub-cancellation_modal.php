<div class="subcancel-modal-container">
  <div class="subcancel-modal">
    <div class="subcancel-modal-content">
      <div class="subcancel-modal-header">
        <h3>Cancel your Subscription</h3>
        <button id="subcancel-modal-close" class="subcancel-modal-button"><i class='fa fa-close fa-2xl'></i></button>
      </div>
      <div id="response_container"></div>
      <form id="subcancel-form" method="POST">
        <div class="wrapper">
          <fieldset>
            <!-- <div class="wrapper">
              <div id="descriptor-out"></div> 
              </div>
              <span> -->
            <label for="descriptor">Descriptor</label>
            <input 
            type="text" name="descriptor" id="descriptor" required placeholder = "Descriptor Name">   
            <div id="descriptor_search">
                  <div id="descriptor-result-item">
                      <!-- <a href="#">VARIANTSOLUTION</a>
                      <br>
                      <hr> -->
                  </div>
</div>
            <!-- </span>
              <div class="descriptor-select-box">
                  <div id="descriptor-result-item">
                      <a href="#">VARIANTSOLUTION</a>
                      <br>
                      <hr>
                  </div>
              
              </div>  -->
          </fieldset>
          <fieldset>
            <label for="Date">Date</label>
            <input type="date" id="date" name="date"  required >
          </fieldset>
        </div>
        <div class="wrapper">
        </div>
        <!-- <fieldset class="reason-fieldset">
          <label for="reason">Reason</label>
          <select name="reason" id="dropdown" class="reason-dropdown">
              <option value selected="selected">--Select--</option>
              <option value="I did not receive the goods or service purchased">I did not receive the goods or service purchased</option>
              <option value="I'm not satisfied with the goods/services provided">I'm not satisfied with the goods/services provided</option>
              <option value="I no longer want to continue receiving the goods/service (please cancel my membership).">I no longer want to continue receiving the goods/service (please cancel my membership).</option>
          </select>
          </fieldset> -->
        <div class="wrapper">
          <label class="">Credit Card Number</label>
          <fieldset>
            <label for="first6"></label>
            <input type="text" id="first6" name="first6" onkeypress="return isNumberKey(event)" maxlength="6" required placeholder= "First 6 Digits">
          </fieldset>
          <fieldset>
            <label for="last4"> </label>
            <input type="text" id="last4" name="last4" onkeypress="return isNumberKey(event)" maxlength="4" required placeholder ="Last 4 Digits">
          </fieldset>
        </div>
        <div class="wrapper">
          <fieldset>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"  required placeholder = "Enter your email">
          </fieldset>
          <fieldset>
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" placeholder="$0.00" onkeypress="return isNumberKey(event)" required>
          </fieldset>
        </div>
        <fieldset>
          <label for="name">Purchaser's Name</label>
          <input type="text" name="name" id="name" required placeholder= "Enter Purchase Name">
        </fieldset>
        <div class="wrapper-column">
          <fieldset class="other-details">
            <label for="other-details" class="other-details">Other Details: (e.g Membership#, Group id#, id# ...)</label>
            <input type="text" name="other-detais" id="other-details" required placeholder= "Enter Additional Details">
          </fieldset>
        </div>
        <div class="wrapper-column">
          <p><label for="comment">Comment</label></p>
          <textarea id="comment" name="comment" rows="2" cols="50" placeholder= "Comments"></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit</button>                    
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var subCancellationLink = document.getElementById("sub-cancellation-link");
  var subModal = document.querySelector(".subcancel-modal-container");
  var subModalClose = document.getElementById("subcancel-modal-close");

  subCancellationLink.addEventListener("click", function () {
    subModal.style.display = "block";
  });

  subModalClose.addEventListener("click", function () {
    subModal.style.display = "none";
  });
});

// const subcancelAPI =
//   "https://ican4consumers.com/tracker2/csssubui/php/main_api.php";
// const subcancelForm = document.getElementById("subcancel-form");
// subcancelForm.action = subcancelAPI;


(function ($) {
  $.fn.Validate = function (callback = null) {
    var container = this;
    var hasEmpty = false;

    $("input[req]", container).each(function () {
      var input = $(this);

      if (input.val().trim() === "") {
        hasEmpty = true;

        if ($.isFunction(callback)) {
          callback(input);
        }
      }
    });

    return hasEmpty;
  };
})(jQuery);

var IC4C = IC4C || {};

IC4C.RefundCancellation = (function () {
  var formSub = $("#subcancel-form");
  var timeout = null;
var searchAjax = null;
  var descriptorSearch = $("#descriptor_search");
  var activeMid = "";
  var responseCont = $("#response_container");

//   formSub.find("input[name=time_purchase]").datepicker();

  formSub.on("submit", SubmitApplication);
  // formSub.find('input[name=descriptor]').on('blur', SearchDescriptor);
  formSub.find("input[name=descriptor]").on("keyup", SearchDescriptor);
  $(document).on("click", ".search-ul li", SelectDescriptor);

  function SearchDescriptor() {
    var input = $(this);

    var url = "https://ican4consumers.com/tracker2/csssubui/php/main_api.php";

    clearTimeout(timeout);

    if (searchAjax != null) searchAjax.abort();

    descriptorSearch.html(`
              <p><i class="fa fa-spinner fa-pulse fa-2x"></i> Searching ...</p>
          `);

    if (input.val().trim() === "") {
      descriptorSearch.html("");
      return;
    }

    timeout = setTimeout(function () {
      searchAjax = $.ajax({
        url: url,
        data: {
          descriptor: input.val(),
          type: "search-descriptor",
        },
        type: "POST",
        beforeSend: function () {},
        error: function (x, h, r) {
          console.log(x);
          console.log(h);
          console.log(r);
        },
        success: function (res) {
          console.log(res);

          if (res.code == "1") {
            var html = `
                      <b style="color: #1565c0">Search Result: </b>
                      <ul class="search-ul">`;

            res.data.forEach(function (val, i) {
              html +=
                `
                          <li data-id="` +
                val.mid +
                `" data-type="` +
                val.emailreq +
                `">` +
                val.DESCRIPTOR_TEXT +
                `</li>
                      `;
            });

            html += `</ul>`;

            descriptorSearch.html(html);
          } else {
            descriptorSearch.html(`
                          <p>NO DATA FOUND</p>
                      `);
          }
        },
        complete: function () {},
      });
    }, 200);
  }


  function SubmitApplication(e) {
    e.preventDefault();
    $(this).find("input").removeClass("error-field");

    var result = $(this).Validate(function (obj) {
      obj.addClass("error-field");
    });

    if (result) {
      return;
    }

    var form = $(this);
    var data = $(this).serialize();
    data += "&mid=" + activeMid;

    var url = "https://ican4consumers.com/tracker2/csssubui/php/main_api.php";

    $.ajax({
      url: url,
      data: data,
      type: "POST",
      beforeSend: function () {
        form.find("button[type=submit]").prop("disabled", true);
      },
      error: function (x, h, r) {
        console.log(x);
        console.log(h);
        console.log(r);
      },
      success: function (res) {
        console.log(res);
        var html = ``;

        if (res.code == 1) {
          html +=
            `
                      <div class="callout success" data-closable>
                         <p style="color: #66bb6a; margin-bottom: 0"><span style="color: #2e7d32 !important;font-weight: 600">CANCELLATION HAS BEEN REQUESTED</span> : ` +
            res.message +
            `</p>
                         <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  `;
          activeMid = "";
          formSub.find("input, textarea").val("");
          formSub.find("input[name=type]").val("cancel-sub");
        } else {
          html +=
            `
                      <div class="callout alert" data-closable>
                         <p style="color: #ef5350; margin-bottom: 0 "> <span style="color: #d32f2f !important;font-weight: 600 ">ERROR</span> - ` +
            res.message +
            `</p>
                         <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                              <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  `;
        }

        responseCont.html(html);
      },
      complete: function () {
        form.find("button[type=submit]").prop("disabled", false);
      },
    });
  }

  function SelectDescriptor() {
    var descriptor = $(this).text();
    activeMid = $(this).data("id");
    emailReq = $(this).data("type");

    formSub.find("input[name=descriptor]").val(descriptor);
    descriptorSearch.html(``);

    if (emailReq == 1) {
      formSub.find("input[name=first6]").attr("req", true);
      // formSub.find('input[name=last4]').attr("req",true);
      formSub.find("span[name=ccnum]").html("*");
      formSub.find("input[name=email]").attr("req", true);
      formSub.find("span[name=email]").html("*");
    } else {
      formSub.find("input[name=first6]").removeAttr("req");
      // formSub.find('input[name=last4]').removeAttr("req");
      formSub
        .find("span[name=ccnum]")
        .html(
          '* <h6 style="font-size:x-small;">(last 4 digit is required.)</h6>'
        );
      formSub.find("input[name=email]").removeAttr("req");
      formSub.find("span[name=email]").html("");
    }
  }
})();



</script>