<?php include("_header.php"); ?> 
<style type="text/css">
    .tr_hover {
        /*background-color: black;*/
    }
    .tr_hover:hover {
        background-color: #F5F5DC;
        cursor: pointer;
    }
</style>
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
        		<tr class='tr_hover'>
        			<td><a href= "<?=site_url("user/profile?=")?>"> <?php echo $element->username;?></a></td>
        			<td><?php echo $element->studentid;?></td>
        		</tr>
        		<?php endforeach;?>
            </tbody>
    	</table>    
    </div>
