<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     block.jquery.php
 * Type:     jquery
 * Name:     JQuery
 * Purpose:  
 * -------------------------------------------------------------
 */
function smarty_block_bw_jquery($params, $content, Smarty_Internal_Template $template, &$repeat)
{
	$type = $params['type'];
//-> Usuwamy znaczniki <script></script>
	$search = array('@<script[^>]*?'.'>@si', '@</script>@si');
	$content = preg_replace($search, '', $content);

	System_MetaData::getInstance()->addJsContent($content, $type);
}