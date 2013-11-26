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
        location.href = text ;
    }
    // 網路上別人實作的javascript post to url(非AJAX)
    function post_to_url(path, paramNames, params) {
        var form = document.createElement("form");
        form.setAttribute("method", "POST");
        form.setAttribute("action", path);
        form.setAttribute("enctype", "multipart/form-data");
        form.setAttribute("target", "receivechunkiframe");
     
        
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", paramNames);
            hiddenField.setAttribute("value", params);
     
            form.appendChild(hiddenField);
        
     
        document.body.appendChild(form);
        form.submit();
    }
    $(document).ready(function() {
        nav_click("nav_issuelist");
        //Search Bar 按下enter後會執行的事情
        $("#searchBar").keypress(function(event) {
               //13代表enter
              if (event.which == 13) {
              event.preventDefault();
              var queryTerm = $("#searchBar").val()+"";
              post_to_url("<?=site_url("issue/search")?>","queryTerm",queryTerm); 
            }
        });

    });
</script>
    <div class="container">
        <form class="navbar-search pull-left" id='viewListSearch'>
          <input type="text" class="search-query" placeholder="Search Title " id='searchBar'>
        </form>


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


