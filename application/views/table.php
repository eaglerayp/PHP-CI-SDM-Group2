<?php include("_header.php"); ?> 
<?php include("_navbar.php"); ?>
<style type="text/css">
    .tr_hover {
        /*background-color: black;*/
    }
    .tr_hover:hover {
        background-color: #F5F5DC;
        cursor: pointer;
    }
</style>
<script type="text/javascript">
    
    $(document).ready(function() {
        nav_click("nav_viewlist");
        //Search Bar 按下enter後會執行的事情
        $("#searchBar").keypress(function(event) {
               //13代表enter
              if (event.which == 13) {
              event.preventDefault();
              queryTerm = $("#searchBar").val()+"";
              console.log(queryTerm);
              //這邊是ajax console.log是測試用
              $.ajax({
                  url: "<?=site_url("user/search")?>",
                  type: 'POST',
                  data: {queryTerm: queryTerm},
              })
              .done(function(data) {
                  //console.log("success");
                  //console.log(data);
                  $(".table").html(data);

              })
              .fail(function() {
                  //console.log("error");
              })

              
        }
        });
        //讓table綁定動態事件click(為了link)
        $(".table").on('click',".tr_hover",function(){
            var id = $(this).attr("em");
            var text = "<?=site_url("user/profile?userID=")?>" + id;
            location.href = text ;
        });
        
    });
</script>
    <div class="container">
        <form class="navbar-search pull-left" id='viewListSearch'>
          <input type="text" class="search-query" placeholder="Search ID or Name" id='searchBar'>
        </form>


    	<table class="table"> 
            <thead>
        		<tr>
        			<td>Name</td>
        			<td>StudentID</td>
        		</tr>
    		</thead>
            <tbody>
        		<?php foreach ($text as $element):?>
        		<tr class='tr_hover' em = '<?php echo $element->userid;?>' >
        			<td><?php echo $element->username;?></td>
        			<td><?php echo $element->studentid;?></td>
        		</tr>
        		<?php endforeach;?>
            </tbody>
    	</table>    
    </div>


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
    <script src="<?=base_url("/js/bootstrap-typeahead.js")?>"></script>
<?php include("_footer.php"); ?> 