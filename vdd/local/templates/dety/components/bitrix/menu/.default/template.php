<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="nav-catalog__menu">
<?
foreach($arResult as $arItem):
if ($arItem["LINK"]):
?>
    <li>
        <a href="<?=$arItem["LINK"]?>"
           <?if($arItem["PARAMS"]["class"]):?>
           class="<?=$arItem["PARAMS"]["class"]?>"
           <?endif?>
            <?if($arItem["PARAMS"]["data-menu"]):?>
            data-menu="<?=$arItem["PARAMS"]["data-menu"]?>"
            <?endif?>
        ><?
            if($arItem["PARAMS"]["data-menu"] == 'catalog'):
        ?><div class="icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        <?endif?><?=$arItem["TEXT"]?></a>
    </li>
<?endif?>
<?endforeach?>
<?foreach($arResult['MENU'] as $row):?>
    <li class="catalog">
        <a href="<?=$row['SECTION_PAGE_URL']?>" data-id="<?=$row['ID']?>" class="children">
            <img src="<?=CFile::GetPath($row['UF_ICON']);?>" alt="<?=$row['NAME']?>">
            <?=$row['NAME']?>
        </a>
    </li>
<?endforeach;?>
</ul>


<div class="nav-catalog__submenu" data-submenu="catalog">

    <div class="nav-catalog__general">
        <ul>
        <?foreach($arResult['MENU'] as $row):?>
            <li>
                <a href="<?=$row['SECTION_PAGE_URL']?>" data-id="<?=$row['ID']?>" class="<?if ($row['ID'] == 1):?>hext-link<?else:?>children<?endif?>">
                    <img src="<?=CFile::GetPath($row['UF_ICON']);?>" alt="<?=$row['NAME']?>">
                    <?=$row['NAME']?>
                </a>
            </li>
        <?endforeach;?>
        </ul>
    </div>

    <?foreach($arResult['MENU'] as $row):?>
    <div class="nav-catalog__parent" data-parent="<?=$row['ID']?>">
        <div class="nav-catalog__parent__head"><p></p></div>
        <? $i=1;
        foreach($arResult['SUBMENU'][$row['ID']] as $sub):?>
            <ul data-sub="<?=$i?>">
                <li><a href="<?=$sub['SECTION_PAGE_URL']?>"><?=$sub['NAME']?></a>
                <?$j=1;
                foreach($arResult['SUBSUBMENU'][$sub['ID']] as $sub2):?>
                    <li
                        <?if($j == 6): echo ' class="cut"'; endif?>
                        <?if($j > 6 ): echo ' class="hidden"'; endif?>
                    >
                        <?if($j == 6):?><a class="more" href="<?=$sub['SECTION_PAGE_URL']?>">показать все</a><?endif?>
                        <a href="<?=$sub2['SECTION_PAGE_URL']?>"><?=$sub2['NAME']?></a>
                    </li>
                <?
                $j++;
                endforeach;?>
            </ul>
        <?$i++;
        endforeach;?>
    </div>
    <?endforeach;?>
</div>
<?endif?>