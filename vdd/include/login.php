<?php
GLOBAL $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>
<?php if (isset($arUser['LOGIN'])):?>
    <a class="nav-top__right__lk fade active" href="/personal/"><?= $arUser['NAME'] ?></a>
<?php else: ?>
    <a class="nav-top__right__login" data-toggle="modal" data-target="login" href="#">Войти</a>
    <a class="nav-top__right__lk" href="/personal/"><?=$arUser['NAME']?$arUser['NAME']:'Гость'?></a>
<?php endif ?>
