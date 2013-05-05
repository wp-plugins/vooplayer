<html>
<head>
<title>Vooplayer Shortcode</title>
<script type="text/javascript" src="../wp-includes/js/tinymce/tiny_mce_popup.js?v=3211"></script>
<?php
wp_enqueue_script('jquery');
global $wp_scripts;
wp_print_scripts();
?>
<script language="javascript">
function insertImage()
{
	/*jQuery("input:radio[name=pershortcode]").each(function(){
		if (jQuery(this).attr("checked")==true)
		{
			contents = jQuery(this).val();
			/ * contentsarr = contents.split("~"); * /
			 
			tinyMCEPopup.execCommand('mceInsertContent', false, contents);
			tinyMCEPopup.close();
		}
	});*/

	contents = jQuery("select[name=pershortcode]").val();
	tinyMCEPopup.execCommand('mceInsertContent', false, contents);
	tinyMCEPopup.close();
}

jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery("#loading").hide();
	jQuery("#imagecontainer").show();
});
</script>
</head>
<body>
<div id="loading" style="display:block"><img src="images/loading.gif"></div>
<div style="height:330px;overflow:scroll;margin-top:5px;width:730px;display:none" id="imagecontainer">
<fieldset>
<legend>Select Video</legend>
<?php
if (!class_exists("Curl"))
	require "curl.class.php";
$POST['apiid'] = "voo_wp";
$POST['valid'] = get_option('voo_valid_id');
$curl = new Curl();
$page = $curl->post ($this->service_url.'/videoplayer/webservice_videos.php', $POST); 
$videolist = json_decode($page);
$i=0;
echo "<table width='100%'><tr><td></td>";
echo '<td><select name="pershortcode" id="pershortcode" style="width:100%;"><option value="">Select Video</option>'; 
foreach($videolist as $key=>$video)
{
	/*if ($i%2 == 0 && $i > 0)
	{
		if ($i > 0)
			echo "</tr>";
		echo "<tr><td></td>";
	}
	$i++;
	echo '<td><input type="radio" name="pershortcode" value="[vooplayer vooid=\''.$video->vid."' width='".$video->width."' height='".$video->height.'\']">&nbsp;'.$video->vtitle."</td>";*/
	echo '<option value="[vooplayer vooid=\''.$video->vid."' width='".$video->width."' height='".$video->height.'\']">'.$video->vtitle."</option>";
}
echo "</select></td>";
echo "</tr></table>";
?>
</fieldset>
</div>
<div>
<div style="float:right"><input type="submit" value="Add to Page" onclick="insertImage()" class="button button-highlighted" style="cursor:pointer;"/></div>
<div style=""><input type="submit" value="Cancel" onclick="tinyMCEPopup.close();" class="button"/></div>
</div>
</body>
</html>