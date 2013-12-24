<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?> 
<script type="text/javascript">
    $(document).ready(function() {
        nav_click("nav_home");
    });
</script>
<style type="text/css">
 .homeinner {
/*    position: relative;
    width: 98%;
    left: 1%;*/
    /*margin: 0 auto;*/
 }
 .row {
    margin-left: 0%;
    border-bottom: 5px;
 }
 .thumbnail {
    margin-top: 15px;
    margin-left: 3%;
    width: 28%;
    float:left;
 }
 .caption {
    margin-left: 1%;
    margin-right: 1%;
 }
 .thumbnail img{
    height: 200px;
    width: 300px;
 }

</style>
    <div class="container home"> 
        <div class="homeinner">  
            
            <!-- <h1>AlumniBook</h1>  
            <h3>Hi, welcome to the NTUIM family!</h3> -->
            <!-- <img src="<?=base_url("/img/homepage.jpeg")?>" /> -->
            <img src="<?=base_url("/img/top.jpg")?>" />
    
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?=base_url("/img/tags.jpg")?>" alt="...">
                  <div class="caption">
                    <h3>Issues With Tags</h3>
                    <p>以標籤取代傳統的分類，幫助快速了解議題的重點，並能以關注標籤的方式追隨相關議題。當關注標籤新增文章與回應時，更會以E-mail的方式通知。</p>
                    <!-- <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> -->
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?=base_url("/img/search.jpg")?>" alt="...">
                  <div class="caption">
                    <h3>Search Tool</h3>
                    <p>於Issues, Members頁面提供方便的搜尋工具，提供部分比對、多關鍵字比對功能，讓你快速搜尋喜歡的文章、想要聯絡的系友！</p>
                    <!-- <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> -->
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?=base_url("/img/mail.jpg")?>" alt="...">
                  <div class="caption">
                    <h3>Single Sign On</h3>
                    <p>提供Single Sign On的功能，讓你可以不用在不同網站重複註冊、登入身分。所有身分一次搞定！</p>
                    <!-- <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> -->
                  </div>
                </div>
              </div>
            </div>

    </div><!-- /.container -->



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
    <script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
    <script src="../assets/js/holder/holder.js"></script>
<?php include("_footer.php"); ?> 