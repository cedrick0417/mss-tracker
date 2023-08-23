<div class="refund-modal-container modal">
  <div class="refund-modal">
    <div class="refund-modal-content">
      <div class="refund-modal-header">
        <h3>GET YOUR REFUND NOW</h3>
        <button id="refund-modal-close" class="refund-modal-button"><i class='fa fa-close fa-2xl'></i></button>
      </div>
      <form id="refund-form" method="POST">
        <fieldset>
          <label for="name">Purchaser's Name</label>
          <input type="text" name="name" id="name" required>
        </fieldset>
        <fieldset class= "descriptor-fieldset">
          <div class="wrapper">
            <label for="descriptor">Descriptor</label>
            <div id="descriptor-out"></div>
          </div>
          <span>
          <input type="text" name="descriptor" id="descriptor" required>   
          <button class="des-btn" onclick="searchDescriptor()">Search</button>
          </span>
          <div class="descriptor-select-box">
            <div id="descriptor-result-item">
              <br>
            </div>
          </div>
        </fieldset>
        <fieldset class="reason-fieldset">
          <label for="reason">Reason</label>
          <select name="reason" id="dropdown" class="reason-dropdown">
            <option value selected="selected">--Select--</option>
            <option value="I did not receive the goods or service purchased">I did not receive the goods or service purchased</option>
            <option value="I'm not satisfied with the goods/services provided">I'm not satisfied with the goods/services provided</option>
            <option value="I no longer want to continue receiving the goods/service (please cancel my membership).">I no longer want to continue receiving the goods/service (please cancel my membership).</option>
          </select>
        </fieldset>
        <div class="wrapper">
          <fieldset>
            <label for="first6">First 6 digits Card Number</label>
            <input type="text" id="first6" name="first6" onkeypress="return isNumberKey(event)" maxlength="6" required>
          </fieldset>
          <fieldset>
            <label for="last4">Last 4 digits Card Number</label>
            <input type="text" id="last4" name="last4" onkeypress="return isNumberKey(event)" maxlength="4" required>
          </fieldset>
        </div>
        <div class="wrapper">
          <fieldset>
            <label for="Date">Date</label>
            <input type="date" id="date" name="date"  required>
          </fieldset>
          <fieldset>
            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" placeholder="$0.00" onkeypress="return isNumberKey(event)" required>
          </fieldset>
        </div>
        
        <fieldset>
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email"  required>
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
          <button class="submit-btn">Submit</button>
        </fieldset>
        
      </form>
    </div>
  </div>
</div>

<script>
  
  document.addEventListener("DOMContentLoaded", function () {
    var refundLink = document.getElementById("refund-link");
    var refundModal = document.querySelector(".refund-modal-container");
    var refundModalClose = document.getElementById("refund-modal-close");
  
    refundLink.addEventListener("click", function () {
      refundModal.style.display = "block";
    });
  
    refundModalClose.addEventListener("click", function () {
      ``;
      refundModal.style.display = "none";
    });
  });


const refundAPI =
  "https://ican4consumers.com/tracker2/ican_refund_page/home/send_refund";
const refundForm = document.getElementById("refund-form");
refundForm.action = refundAPI;


function isNumberKey(evt) {
  var charCode = evt.which ? evt.which : event.keyCode;
  if (charCode > 31 && charCode != 46 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}

function searchDescriptor() {
  var str = document.querySelector("#descriptor").value;
  // console.log(value);
  $("#descriptor-result-item").empty;

  var n = str.length;
  if (n <= 4) {
    document.getElementById("descriptor-out").innerHTML =
      "<p>Enter a minimum of 5 characters!</p>";
    $("#descriptor-out").removeClass("success").addClass("error"); 
  } else {
    var descriptor = document.querySelector("#descriptor").value;

    console.log(descriptor);
    $.ajax({
      // url: "/tracker2/csssubui/php/main_api.php",
      url: "https://ican4consumers.com/tracker2/csssubui/php/main_api.php",

      data: {
        type: "search-descriptor",
        descriptor: descriptor,
      },
      type: "POST",
      error: function (z, x, c) {
        console.log(z);
        console.log(x);
        console.log(c);
      },
      success: function (res) {
        console.log(res);
        if (res.code < 0) {
          document.getElementById("descriptor-out").innerHTML =
            "<p>Descriptor not found!</p>";
          $("#descriptor-out").removeClass("success").addClass("error");
          $(".descriptor-select-box").css({
            display: "none",
            height: "0",
            "overflow-y": "hidden",
          });
        } else {
          $(".descriptor-select-box").css({
            display: "block",
            height: "350px",
            "overflow-y": "scroll",
          });
          var data = res.data;
          data.forEach(function (element) {
            console.log(element.DESCRIPTOR_TEXT);
            var x = document.getElementById("descriptor-result-item");
            //						x.empty();
            var a = document.createElement("a");
            var b = document.createElement("br");
            var h = document.createElement("hr");
            var createAText = document.createTextNode(element.DESCRIPTOR_TEXT);
            a.setAttribute("href", "#");
            a.setAttribute("id", element.DESCRIPTOR_TEXT);
            a.onclick = function () {
              document.getElementById("descriptor").value =
                element.DESCRIPTOR_TEXT;
              $("#descriptor-result-item").empty();
              document.getElementById("descriptor-out").innerHTML =
                "<p>Descriptor verified!</p>";
              $("#descriptor-out").removeClass("error").addClass("success"); //mark
              $(".descriptor-select-box").css({
                display: "none",
                height: "0",
                "overflow-y": "hidden",
              });
            };
            a.appendChild(createAText);
            a.classList.add("descriptors");
            x.appendChild(a);
            x.appendChild(b);
            x.appendChild(h);
          });
          $("#submitBtn").prop("disabled", false);
        }
      },
    });
  }
}
</script>

