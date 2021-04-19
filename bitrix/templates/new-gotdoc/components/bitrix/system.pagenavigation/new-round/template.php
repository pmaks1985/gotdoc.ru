<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");

$colorSchemes = array(
    "green" => "bx-green",
    "yellow" => "bx-yellow",
    "red" => "bx-red",
    "blue" => "bx-blue",
);
if (isset($colorSchemes[$arParams["TEMPLATE_THEME"]])) {
    $colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"]];
} else {
    $colorScheme = "";
}
?>


<div class="page-navigation d-flex">
        <? if ($arResult["bDescPageNumbering"] === true): ?>

            <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
                <? if ($arResult["bSavePage"]): ?>
                    <li class="bx-pag-prev list-group-item page-navidation_numbers"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_back") ?></span></a>
                    </li>
                    <li class="1 list-group-item page-navidation_numbers"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" class="page-navidation_numbers__link"><span>1</span></a>
                    </li>
                <? else: ?>
                    <? if (($arResult["NavPageNomer"] + 1) == $arResult["NavPageCount"]): ?>
                        <li class="bx-pag-prev list-group-item page-navidation_numbers"><a
                                    href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_back") ?></span></a>
                        </li>
                    <? else: ?>
                        <li class="bx-pag-prev list-group-item page-navidation_numbers"><a
                                    href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?> class="page-navidation_numbers__link""><span><? echo GetMessage("round_nav_back") ?></span></a>
                        </li>
                    <? endif ?>
                    <li class="2 list-group-item page-navidation_numbers"><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="page-navidation_numbers__link"><span>1</span></a>
                    </li>
                <? endif ?>
            <? else: ?>
                <li class="bx-pag-prev list-group-item page-navidation_numbers"><span><? echo GetMessage("round_nav_back") ?></span></li>
                <li class="bx-active list-group-item page-navidation_numbers"><span>1</span></li>
            <? endif ?>

            <?
            $arResult["nStartPage"]--;
            while ($arResult["nStartPage"] >= $arResult["nEndPage"] + 1):
                ?>
                <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

                <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                <li class="bx-active list-group-item page-navidation_numbers"><span><?= $NavRecordGroupPrint ?></span></li>
            <? else:?>
                <li class="3 list-group-item page-navidation_numbers"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>" class="page-navidation_numbers__link"><span><?= $NavRecordGroupPrint ?></span></a>
                </li>
            <? endif ?>

                <? $arResult["nStartPage"]-- ?>
            <? endwhile ?>

            <? if ($arResult["NavPageNomer"] > 1): ?>
                <? if ($arResult["NavPageCount"] > 1): ?>
                    <li class="4 list-group-item page-navidation_numbers"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1" class="page-navidation_numbers__link"><span><?= $arResult["NavPageCount"] ?></span></a>
                    </li>
                <? endif ?>
                <li class="bx-pag-next list-group-item page-navidation_numbers"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_forward") ?></span></a>
                </li>
            <? else: ?>
                <? if ($arResult["NavPageCount"] > 1): ?>
                    <li class="bx-active list-group-item page-navidation_numbers"><span><?= $arResult["NavPageCount"] ?></span></li>
                <? endif ?>
                <li class="bx-pag-next list-group-item page-navidation_numbers"><span><? echo GetMessage("round_nav_forward") ?></span></li>
            <? endif ?>

        <? else: ?>

            <? if ($arResult["NavPageNomer"] > 1): ?>
                <? if ($arResult["bSavePage"]): ?>
                    <li class="bx-pag-prev list-group-item page-navidation_numbers"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_back") ?></span></a>
                    </li>
                    <li class="5 list-group-item page-navidation_numbers"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1" class="page-navidation_numbers__link"><span>1</span></a>
                    </li>
                <? else: ?>
                    <? if ($arResult["NavPageNomer"] > 2): ?>
                        <li class="bx-pag-prev list-group-item page-navidation_numbers"><a
                                    href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_back") ?></span></a>
                        </li>
                    <? else: ?>
                        <li class="bx-pag-prev list-group-item page-navidation_numbers"><a
                                    href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_back") ?></span></a>
                        </li>
                    <? endif ?>
                    <li class="6 list-group-item page-navidation_numbers"><a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>" class="page-navidation_numbers__link"><span>1</span></a>
                    </li>
                <? endif ?>
            <? else: ?>
                <li class="bx-pag-prev list-group-item page-navidation_numbers"><span><? echo GetMessage("round_nav_back") ?></span></li>
                <li class="bx-active list-group-item page-navidation_numbers"><span>1</span></li>
            <? endif ?>

            <?
            $arResult["nStartPage"]++;
            while ($arResult["nStartPage"] <= $arResult["nEndPage"] - 1):
                ?>
                <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                <li class="bx-active list-group-item page-navidation_numbers"><span><?= $arResult["nStartPage"] ?></span></li>
            <? else:?>
                <li class="7 list-group-item page-navidation_numbers"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>" class="page-navidation_numbers__link"><span><?= $arResult["nStartPage"] ?></span></a>
                </li>
            <? endif ?>
                <? $arResult["nStartPage"]++ ?>
            <? endwhile ?>

            <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
                <? if ($arResult["NavPageCount"] > 1): ?>
                    <li class="8 list-group-item page-navidation_numbers"><a
                                href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>" class="page-navidation_numbers__link"><span><?= $arResult["NavPageCount"] ?></span></a>
                    </li>
                <? endif ?>
                <li class="bx-pag-next list-group-item page-navidation_numbers"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_forward") ?></span></a>
                </li>
            <? else: ?>
                <? if ($arResult["NavPageCount"] > 1): ?>
                    <li class="bx-active list-group-item page-navidation_numbers"><span><?= $arResult["NavPageCount"] ?></span></li>
                <? endif ?>
                <li class="bx-pag-next list-group-item page-navidation_numbers"><span><? echo GetMessage("round_nav_forward") ?></span></li>
            <? endif ?>
        <? endif ?>

        <? if ($arResult["bShowAll"]): ?>
            <? if ($arResult["NavShowAll"]): ?>
                <li class="bx-pag-all list-group-item page-navidation_numbers"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"
                            rel="nofollow" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_pages") ?></span></a></li>
            <? else: ?>
                <li class="bx-pag-all list-group-item page-navidation_numbers"><a
                            href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1"
                            rel="nofollow" class="page-navidation_numbers__link"><span><? echo GetMessage("round_nav_all") ?></span></a></li>
            <? endif ?>
        <? endif ?>
    <div style="clear:both"></div>
</div>

