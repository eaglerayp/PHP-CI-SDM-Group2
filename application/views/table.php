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
    function linktoprofile(id){
        var text = "<?=site_url("user/profile?userID=")?>" + id ;
        location.replace(text);
    }
    $(document).ready(function() {
        nav_click("nav_viewlist");
    });
</script>
    <div class="container">
    	<table class="table"> 
            <thead>
        		<tr>
        			<td>Name</td>
        			<td>StudentID</td>
        		</tr>
    		</thead>
            <tbody>
        		<?php foreach ($text as $element):?>
        		<tr class='tr_hover' onclick="linktoprofile('<?php echo $element->userid;?>')">
        			<td><?php echo $element->username;?></td>
        			<td><?php echo $element->studentid;?></td>
        		</tr>
        		<?php endforeach;?>
            </tbody>
    	</table>    
    </div>


