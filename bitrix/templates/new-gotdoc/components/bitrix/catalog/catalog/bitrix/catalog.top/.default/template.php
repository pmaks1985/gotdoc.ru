<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="those-involted_title interest">Вам также может быть интересно</div>
<div class="row">
    <? foreach ($arResult["ROWS"] as $arItems): ?>
        <? foreach ($arItems as $arElement): ?>
            <? if (is_array($arElement)): ?>
                <?
                $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-lg-3">
                    <div class="card-interest d-flex flex-column align-items-center">
                        <img src="<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>" class="card-interest_img"
                             alt="<?= $arElement["NAME"] ?>" title="<?= $arElement["NAME"] ?>">
                        <div class="text-center card-interest_text"><?= $arElement["NAME"] ?></div>
                        <div class="card-interest_price">
                            <? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
                                <? if ($arElement["PROPERTIES"]["FILE_FOR_FREE"]["VALUE"]) :  //если бесплатно?>
                                    <span class="price-new">Бесплатно</span>
                                <? else: //цена без торговых предложений?>
                                    <span class="price-new"><?= $arPrice["PRINT_VALUE"] ?></span>
                                <? endif; ?>
                                <? if ($arElement['PROPERTIES']['OLD_PRICE']['VALUE']): ?>
                                    <span class="price-old"><? echo $arElement['PROPERTIES']['OLD_PRICE']['VALUE']; ?> руб.</span>
                                <? endif; ?>
                            <? endforeach; ?>
                            <? if ($arElement['OFFERS']): //цена с торговыми предложениями?>
                                <? foreach ($arElement['OFFERS'] as $offPrice): ?>
                                    <span class="price-new"><?= $offPrice["PRICES"]["BASE"]["PRINT_VALUE"] ?></span>
                                    <?
                                    break;
                                endforeach;
                                ?>
                                <? if ($arElement['PROPERTIES']['OLD_PRICE']['VALUE']): ?>
                                    <span class="price-old"><? echo $arElement['PROPERTIES']['OLD_PRICE']['VALUE']; ?> руб.</span>
                                <? endif; ?>
                            <? endif; ?>
                        </div>
                        <div class="card-interest_button">
                            <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                               class="btn-outline-danger text-decoration-none buy-button_link card-interest_button__link">Подробнее</a>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        <? endforeach ?>
    <? endforeach ?>
</div>

