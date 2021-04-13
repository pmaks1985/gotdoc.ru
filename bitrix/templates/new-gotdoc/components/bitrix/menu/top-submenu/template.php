<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <a class="catalog_btn d-flex align-items-center dropdown-toggle" href="#"
       id="navbarDropdownMenuLink" aria-haspopup="true" data-toggle="dropdown" aria-expanded="true">
        <img class="p-3" src="/bitrix/templates/new-gotdoc/img/catalog.png" alt="catalog">
        <div>Каталог документов</div>
    </a>

    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

    <?
    $previousLevel = 0;
foreach ($arResult

    as $arItem): ?>
    <? //print_r($arItem); ?>
    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>
    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
    <li class="dropdown-submenu">
    <a href="<?= $arItem["LINK"] ?>"
       class="dropdown-item dropdown-toggle d-flex align-items-center justify-content-between">
        <div class="text-normal"><?= $arItem["TEXT"] ?></div>
        <i class="bi bi-chevron-right"></i>
    </a>
    <ul class="dropdown-menu">
    <? else: ?>
    <li class="second-level dropdown-submenu"><a href="<?= $arItem["LINK"] ?>"
                     class="dropdown-item dropdown-toggle d-flex align-items-center justify-content-between"><?= $arItem["TEXT"] ?><i class="bi bi-chevron-right"></i></a>

    <ul class="first-level_ul pl-3">
    <? endif ?>

    <? else: ?>

        <? if ($arItem["PERMISSION"] > "D"): ?>

            <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                <li class="dropdown-submenu"><a href="<?= $arItem["LINK"] ?>"
                                                class="dropdown-item dropdown-toggle d-flex align-items-center justify-content-between"><?= $arItem["TEXT"] ?></a>
                </li>
            <? else: ?>

                <li class="first-level"><a href="<?= $arItem["LINK"] ?>"
                                 class="dropdown-item"><?= $arItem["TEXT"] ?></a></li>
            <? endif ?>

        <? else: ?>

            <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                <li class="dropdown-submenu"><a href=""
                                                class=""
                                                title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a>
                </li>
            <? else: ?>
                <li><a href="" class="denied"
                       title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
            <? endif ?>

        <? endif ?>

    <? endif ?>

    <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

<? endforeach ?>

    <? if ($previousLevel > 1)://close last item tags?>
        <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
    <? endif ?>

    </ul>
    <div class="menu-clear-left"></div>
<? endif ?>