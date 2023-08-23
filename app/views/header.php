<header>
   <nav>
      <div class="logo">
         <a href="index.php">
         <img src="public/img/IC4C-logo.png" alt="logo"> 
         </a>
      </div>
      <ul class="nav-list">
         <button class="link-btn" id="sub-cancellation-link">
            <li class="" id="sub-cancellation-link">
               Subscription Cancellation
            </li>
         </button>
         <button class="link-btn" id="sub-cancellation-link">
            <li class="" id="refund-link">
               Get Your Refund
            </li>
         </button>
      </ul>
      <div class="profile">
         <div class="profile-name">
            <p>Welcome</p>
            <h3>
            </h3>
         </div>
         <div class="profile-image-wrapper">
            <!-- <a href="#" class="display-picture"><img src="https://i.pravatar.cc/85" alt=""></a> -->
         </div>
         <div class=" display-picture">▼</div>
         <div/>
            <div class="card hidden">
               <!--ADD TOGGLE HIDDEN CLASS ATTRIBUTE HERE-->
               <ul>
                  <!--MENU-->
                  <li><a href="#">Profile</li>
                  </a>
                  <li><a href="#">Account</li>
                  </a>
                  <li><a href="#">Settings</li>
                  </a>
                  <li><a href="#">
                     <?php echo '<a href="logout.php">Logout</a>'; ?>
                  </li>
                  </a>
               </ul>
            </div>
   </nav>
   <!-- <div class="search-container">   
      <select id="menu-select" class="menu table-select">
      <option value="#section1">All</option>
      <option value="#home">Home</option>
      <option value="#ral">Refund Activity Logs</option>
      <option value="#cro">Consumer Request Origin</option>
      <option value="#nmm">Non Member Merchant</option>
      </select>
      <div class="line"></div>
      <div class="searchbar">
      <div class="icon">
      <i class="fa fa-search fa-xl" aria-hidden="true"></i>
      </div>
      <input type="text" placeholder="Search for keywords">
      <button class="table-btn">Search</button>
      </div>
      <div class="line"></div> -->
   <!-- Dependent dropdown -->
   <!-- <div class="filter-container">
      <select name="" id="filters" class="table-select">
      <option value="">ALL</option>
      </select>
      <button class="table-btn">Filter</button>
      </div>
      <div class="line"></div>
      <form method="GET" action="">
         <label id="limit">Show:</label>
         <input class="table-input" type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
         <button type="submit" class="table-btn">Apply</button>
       </form> -->
   <!-- </div> -->
   <!-- <div class="row-entries">
      <form method="GET" action="">
          <label id="limit">SHOW</label>
          <input type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
          <button type="submit">Apply</button>
      </form>
      </div> -->
   <!-- </div> -->
   <script>
      let card = document.querySelector(".card"); //declearing profile card element
      let displayPicture = document.querySelector(".display-picture"); //declearing profile picture
      
      displayPicture.addEventListener("click", function() { //on click on profile picture toggle hidden class from css
      card.classList.toggle("hidden")})
      </script>
   <?php require_once 'app/views/modals/refund_modal.php';?>
   <?php require_once 'app/views/modals/sub-cancellation_modal2.php';?>
</header>
<!-- <div class="flex">
   <form id = "home_search_form" method="GET" action="">
         <input type="text" name="search" placeholder="Search keyword" value="<?php echo $searchKeyword; ?>">
         <select name="filter">
             <option value="">All</option>
             <?php foreach ($filterValues as $value) : ?>
                 <option value="<?php echo $value; ?>" <?php echo $filterValue === $value ? 'selected' : ''; ?>>
                     <?php echo $value; ?>
                 </option>
             <?php endforeach; ?>
         </select>
         <button type="submit">Filter</button>
     </form> -->
<!-- Items per Page -->
<!-- <form method="GET" action="">
   <label id="limit">Show:</label>
   <input type="number" name="limit" min="1" max="<?php echo $maxLimit; ?>" value="<?php echo $limit; ?>">
   <button type="submit">Apply</button>
   </form> -->
<!-- </div> -->