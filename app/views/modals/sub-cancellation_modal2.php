<div class="subcancel-modal-container modal">
  <div class="subcancel-modal">
    <div class="subcancel-modal-content">
      <div class="callout main-co">
        <div class="subcancel-modal-header">
          <h3>Cancel your Subscription</h3>
          <button id="subcancel-modal-close" class="subcancel-modal-button"><i class='fa fa-close fa-2xl'></i></button>
        </div>
        <div class="form-body">
          <div id="response_container">
          </div>
          <form action="#" method="post" id="form_sub_cancel">
          <fieldset>
              <b>Purchaser Name <span>*</span></b>
              <input type="text" name="purchase_name" placeholder="Enter purchase name" req>
            </fieldset>
            <div class="wrapper">
              <fieldset>
                <label>Descriptor <span>*</span></label>
                <input type="text" name="descriptor" autocomplete="off" placeholder="Descriptor name" req>
              </fieldset>
              <fieldset>
                <!-- <label>Date of Purchase  <span>*</span></label> -->
                <label for="time_purchase">Date of Purchase <span>*</span> </label>
                <input type="input" name="time_purchase" readonly style="cursor:pointer;" req  placeholder="dd/mm/yyyy">
              </fieldset>
            </div>
            <div id="descriptor_search">
            </div>
            <b hidden>Reason For Cancellation</b>
            <textarea name="reason" id="" rows="3" hidden></textarea>
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
                <label>Email Address <span name="email">*</span></label>
                <input type="email" name="email" placeholder="Enter you email">
              </fieldset>
              <fieldset>
                <label>Amount <span>*</span></label>
                <input type="number" name="amount" placeholder="0.00" min="0.01" step="0.01" req>
              </fieldset>
            </div>
         <div class=count-origin>
         
         <h3>Consumer Request Origin</h3> 
         <div>
          <div>
            
            <input type="radio" name="web" id="web">
            <label for="web">Web</label>
          </div>
          <div>

            <input type="radio" name="chat" id="chat">
            <label for="chat">Chat</label>
          </div>
          <div>
            <input type="radio" name="call" id="call">
          <label for="call">Call</label>

          </div>
          </div>  
          </div>
            <div class="row align-left">
              <div class="large-8 columns">
                <fieldset>
                  <label>Other Details: <i style="color: #757575">(e.g Membership#, Group id#, id# ...)</i>  <span></span></label>
                  <input type="text" name="other_details" placeholder="Enter additional details">
                </fieldset>
                <b>Comment</b>
                <textarea type="text" rows="2" name="comment" placeholder="Comments"></textarea>
              </div>
              <div class="columns">
              </div>
            </div>
            <input type="hidden" name="type" value="cancel-sub">
            <div class="row align-right">
              <div class="large-3 columns">
                <button type="submit" class="submit-btn">Submit </button>
              </div>
            </div>
          </form>
        </div>
      </div>
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

(function($){

$.fn.Validate = function( callback = null){
    var container = this;
    var hasEmpty = false;

    $('input[req]', container).each(function(){
        var input = $(this);

        if(input.val().trim() === ''){
            hasEmpty = true;

            if($.isFunction(callback)){
                callback(input);
            }
        }
    });

    return hasEmpty;
}
})(jQuery);

var IC4C = IC4C || {};

IC4C.RefundCancellation = (function(){
var formSub = $('#form_sub_cancel');
var timeout = null;
var searchAjax = null;
var descriptorSearch = $('#descriptor_search');
var activeMid = "";
var responseCont = $('#response_container');

formSub.find('input[name=time_purchase]').datepicker();
formSub.on('submit', SubmitApplication);
formSub.find('input[name=descriptor]').on("keyup", SearchDescriptor);
$(document).on('click', '.search-ul li', SelectDescriptor);


function SearchDescriptor(){
    var input = $(this);


    var url = "https://ican4consumers.com/tracker2/csssubui/php/main_api.php";

    clearTimeout(timeout);

    if(searchAjax != null)
        searchAjax.abort();

    descriptorSearch.html(`
            <p><i class="fa fa-spinner fa-pulse fa-2x"></i> Searching ...</p>  
        `);

    if(input.val().trim() === ""){
        descriptorSearch.html('');
        return;
    }


    timeout = setTimeout(function () {

        searchAjax = $.ajax({
            url: url,
            data: {
                descriptor: input.val(),
                type: "search-descriptor"
            },
            type: "POST",
            beforeSend: function(){

            },
            error: function(x, h, r){
                console.log(x);
                console.log(h);
                console.log(r);
            },
            success: function(res){
                console.log(res);

                if(res.code == "1"){
                    var html = `
                    <b style="color: #1565c0">Search Result: </b>
                    <ul class="search-ul">`;

                    res.data.forEach(function (val, i) {
                        html += `
                        <li data-id="`+val.mid+`" data-type="`+val.emailreq+`">`+val.DESCRIPTOR_TEXT+`</li>
                    `;
                    });

                    html += `</ul>`;

                    descriptorSearch.html(html);
                }else{
                    descriptorSearch.html(`
                        <p>NO DATA FOUND</p>
                    `);
                }
            },
            complete: function(){

            }
        });
    }, 200);

}

function SubmitApplication(e){
    e.preventDefault();
    $(this).find('input').removeClass('error-field');

    var result = $(this).Validate(function(obj){
        obj.addClass('error-field');
    });

    if(result){
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
        beforeSend: function(){
            form.find('button[type=submit]').prop("disabled", true);
        },
        error: function(x, h, r){
            console.log(x);
            console.log(h);
            console.log(r);
        },
        success: function(res){
            console.log(res);
            var html = ``;

            if(res.code == 1){
                html += `
                    <div class="callout success" data-closable>
                       <p style="color: #66bb6a; margin-bottom: 0"><span style="color: #2e7d32 !important;font-weight: 600">CANCELLATION HAS BEEN REQUESTED</span> : `+res.message+`</p>
                       <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                `;
                activeMid = '';
                formSub.find('input, textarea').val('');
                formSub.find('input[name=type]').val('cancel-sub');
            }else{
                html += `
                    <div class="callout alert" data-closable>
                       <p style="color: #ef5350; margin-bottom: 0 "> <span style="color: #d32f2f !important;font-weight: 600 ">ERROR</span> - `+res.message+`</p>
                       <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                `;
            }

            responseCont.html(html);
        },
        complete: function(){
            form.find('button[type=submit]').prop("disabled", false);
        }
    });
}

function SelectDescriptor(){
    var descriptor = $(this).text();
    activeMid = $(this).data("id");
    emailReq = $(this).data("type");

    formSub.find('input[name=descriptor]').val(descriptor);
    descriptorSearch.html(``);

    if(emailReq == 1){
        formSub.find('input[name=first6]').attr("req",true);
        // formSub.find('input[name=last4]').attr("req",true);
        formSub.find('span[name=ccnum]').html('*');
        formSub.find('input[name=email]').attr("req",true);
        formSub.find('span[name=email]').html("*");
    }else{
        formSub.find('input[name=first6]').removeAttr("req");
        // formSub.find('input[name=last4]').removeAttr("req");
        formSub.find('span[name=ccnum]').html('* <h6 style="font-size:x-small;">(last 4 digit is required.)</h6>');
        formSub.find('input[name=email]').removeAttr("req");
        formSub.find('span[name=email]').html("");
    }
}
})();
</script>