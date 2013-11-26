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

        $("#searchBar").keypress(function(event) {
              if (event.which == 13) {
              event.preventDefault();
              queryTerm = $("#searchBar").val()+"";
              console.log(queryTerm);
              $.ajax({
                  url: "<?=site_url("user/search")?>",
                  type: 'POST',
                  data: {queryTerm: queryTerm},
              })
              .done(function(data) {
                  console.log("success");
                  console.log(data);
                  $(".table").html(data);

              })
              .fail(function() {
                  console.log("error");
              })

              
        }
        });
        $("body").on('click',".tr_hover",function(){
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


