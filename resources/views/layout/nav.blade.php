 


<div class="flex-shrink-0 p-3 main-nav sub-nav noto" style="width: 0;">
    <a href="#" class="text-right d-flex justify-content-end pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom" id="hide-nav"> 
      <span class="fs-5 fw-semibold">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"  style="fill:white;width:1.5em;cursor:hand;"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
      </span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"  data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
          Home
        </button>
        <div class="collapse" id="home-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li> 
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          ຜູ້ໃຊ້
        </button>
        <div class="collapse" id="dashboard-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li> 
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Orders
        </button>
        <div class="collapse" id="orders-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New</a></li> 
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Account
        </button>
        <div class="collapse" id="account-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New...</a></li> 
          </ul>
        </div>
      </li>
    </ul>
</div>


 

<script> 
    $(document).ready(function () {
            // Hide the overlay initially
            $(".overlay").css("opacity", "0");
            $(".overlay").css("display", "none");
            var nav_sw = 0;
            // Show the container and overlay when the button is clicked
            $("#show-nav").click(function () { 
                    $(".overlay").css("opacity", "0.7"); // Adjust opacity as needed
                    $(".main-nav").css("width", "280");
            
                    $(".overlay").css("display", "block");
                    $(".sub-nav").css("display", "block"); 
            });

            // Hide the container and overlay when the close button is clicked
            $("#hide-nav").click(function () {
                $(".overlay").css("opacity", "0");
                $(".overlay").css("display", "none"); 
                $(".sub-nav").css("display", "none");
                $(".main-nav").css("width", "0"); 
                // setTimeout(function() {   }, 2000); 
            });
            
            
        });
</script>