<?php include("_header.php"); ?> 
    <div class="container">

      <form class="form-signin" action="<?=site_url("/user/registering")?>" method="post" onsubmit="return checksubmit();">
        <?php if (isset($errorMessage)){?>
        <div class="alert alert-error">
        <?=$errorMessage?>
        </div>
        <?php }?>
        
        <h2 class="form-signin-heading">Please Sign up</h2>
        <input type="text" name="account" class="input-block-level" placeholder="UserID" >
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        <input type="password" name="passwordre" class="input-block-level" placeholder=" Re-type Password" onchange="check();">
        <div id="msg"></div>
        <button class="btn btn-large btn-primary" type="submit">Sign up</button>
        <a class="btn btn-large" href="<?=site_url("/")?>" type="button">Home</a>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script language="javascript">
    window.onload = function(){
        //判斷密碼是否一致
         function check(){ 
          with(document.all){
          if(password.value!=passwordre.value){
            document.getElementById("msg").innerHTML = "password not the same";
          }
          }
        }
        function checksubmit(){ 
          with(document.all){
          if(password.value!=passwordre.value){
            document.getElementById("msg").innerHTML = "password not the same";
            return false;
          }
          else {
            return true;
          }
          }
        }
    }
    </script>
    <script src="<?=base_url("/js/jquery.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-transition.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-alert.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-modal.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-dropdown.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-scrollspy.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-tab.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-tooltip.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-popover.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-button.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-collapse.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-carousel.js")?>"></script>
    <script src="<?=base_url("/js/bootstrap-typeahead.js")?>"></script>
<?php include("_footer.php"); ?> 
