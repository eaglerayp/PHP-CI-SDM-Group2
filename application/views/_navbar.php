    <?php /* php parameter $_SESSION["user"]=getuser result (SELECT userid,username) 
      *$_SESSION["user"]  is php object  , attribute "userid" ,"username"*/ 
    ?>

    <!-- NAVBAR
    ================================================== -->
    <style type="text/css">
      .navbar-wrapper {
        position: absolute;
        top: -2px;
        margin: 0 auto;
        width: 100%; 
      }
      #warning{
        width:20px;
        height:20px;
        left:60px;
        display:none;
        position: absolute;
        z-index: 5;
      }
    </style>
    <script type="text/javascript">
      function nav_click(id){
        var text = "#"+id;
        $(".active").removeClass('active');
        $(text).addClass('active');
      }
    </script>
    <script type="text/javascript">//processing Notification 
    $(document).ready(function () {
      if($('#eventneed').val()==1){
             $.ajax({
             url: "<?=site_url("/user/notify")?>",
             cache: false,
             dataType: 'html',
             error: function(xhr) {
             alert('Ajax request 發生錯誤');
             },
             success: function(response) {
                $('#dropdown').append(response);
               // $('#msg').fadeIn();
                var objDiv = document.getElementById("dropdown");
                objDiv.scrollTop = objDiv.scrollHeight;
                // $('#mainframe').scrollTop = document.getElementById("mainframe").scrollHeight;
                if($('#noevent').val()!=0){
                  console.log($('#noevent').val());
                  $('#warning').show();
                }
             }
         });
        }
    });
    </script>
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?=site_url("/")?>">AlumniBook</a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="active" id='nav_home'><a href="<?=site_url("/")?>">Home</a></li>
                <li class="" id='nav_viewlist'><a href="<?=site_url("/viewlist/table")?>">Members</a></li>
				        <li class="" id='nav_issuelist'><a href="<?=site_url("/issue/issuelist")?>">Issues</a></li>
                <li class="" id='nav_edit'><a href="<?=site_url("/user/myProfile")?>">My Profile</a></li> 
                <!-- <li class="" id='nav_edit'><a href="<?=site_url("user/edit")?>">My profile</a></li>  -->
                <!--<li><a href="#about">Articles</a></li>
                <li><a href="#contact">Contact</a></li>
                <!-- Read about Bootstrap dropdowns at http://twbs.github.com/bootstrap/javascript.html#dropdowns -->
                <li class="dropdown">
                  <img id="warning" src="<?=base_url("/img/warning.png")?>" />
                  <a class="dropdown-toggle" data-toggle="dropdown">Event<b class="caret"></b></a>
                  <ul class="dropdown-menu" id ="dropdown">
                  </ul> 
                </li>
              </ul>

                                                  

              <!-- login status -->
              <?php 
               if(!isset($_SESSION)) {
                session_start();
               }
               if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ 
                echo '<input type="hidden" id="eventneed" value="1">';
                ?>  
              <ul class="nav pull-right">  
              <li><a id="UserID" href="<?=site_url("/user/myProfile")?>">HI,<?=$_SESSION["user"]->username?></a></li>   
              <li class="divider-vertical"></li>  
              <li><a href="<?=site_url("user/logout")?>">Log out</a></li> 
              </ul>  
              <?php }else{ ?>   
              <ul class="nav pull-right">  
              <li><a href="<?=site_url("user/singlesignon")?>">Sign in</a></li>  
              <li class="divider-vertical"></li>  
              <li><a href="<?=site_url("user/register")?>">Sign up</a></li>  
              </ul>          
              <?php } ?> 
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->
    <div class="allcontent">
