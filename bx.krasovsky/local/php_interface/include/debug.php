<?
function debug($var, $all = false, $die = false)
{
	global $USER;
	if(($USER->GetID() == 1) || ($all == true))
	{
		$bt =  debug_backtrace();
		$bt = $bt[0];
		$dRoot = $_SERVER["DOCUMENT_ROOT"];
		$dRoot = str_replace("/","\\",$dRoot);
		$bt["file"] = str_replace($dRoot,"",$bt["file"]);
		$dRoot = str_replace("\\","/",$dRoot);
		$bt["file"] = str_replace($dRoot,"",$bt["file"]);
		?>
		<div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
		<pre style='padding:10px;'><?print_r($var)?></pre>
        <br>
		<?
	}
	if($die)
	{
		die;
	}
}
?>