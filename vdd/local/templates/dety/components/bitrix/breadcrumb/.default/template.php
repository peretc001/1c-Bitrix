<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$strReturn .= '<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList"><div class="container"><div class="links">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{

    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<div class="link" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="'.$arResult[$index]["LINK"].'" itemprop="item"><span itemprop="name">'.$title.'</span><i></i></a>
				<meta itemprop="position" content="'.($index + 1).'" />
			</div>';
	}
	else
	{
		$strReturn .= '
			<span class="last" itemprop="name">'.$title.'</span>';
	}
}

$strReturn .= '</div></div></div>';

return $strReturn;
