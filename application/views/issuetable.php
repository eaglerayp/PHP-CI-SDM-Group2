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
    function linktoissue(id){
        var text = "<?=site_url("issue/view")?>" + "/" + id ;
        location.replace(text);
    }
    $(document).ready(function() {
        nav_click("nav_issuelist");
    });
</script>
    <div class="container">
    	<table class="table"> 
            <thead>
        		<tr>
        			<td>Author</td>
        			<td>Title</td>
					<td>Views</td>
        		</tr>
    		</thead>
            <tbody>
        		<?php foreach ($issues as $element):?>
        		<tr class='tr_hover' onclick="linktoissue('<?=htmlspecialchars($element->issueid)?>')">
                    <td>  
                        <?=htmlspecialchars($element->username)?>  
                    </td>  
                    <td>  
                        <?=htmlspecialchars($element->title)?>  
                    </td>
					<td>
						<?=htmlspecialchars($element->views)?>
					</td>
					<td>
						<?php if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ ?> 
							<?php if($_SESSION["user"]->username == $element->username){ ?> 
								<ul class="nav">
								  <li><a href="<?=site_url("issue/edit/".$element->issueid)?>">edit</a></li>
								  <li><a href="<?=site_url("issue/delete/".$element->issueid)?>">delete</a></li>  
								</ul>
							<?php } ?>
						<?php } ?>
					</td>
        		</tr>
        		<?php endforeach;?>
            </tbody>
    	</table>    
		<div><a href="<?=site_url("issue/post")?>">Add a Issue</a></div>
    </div>


