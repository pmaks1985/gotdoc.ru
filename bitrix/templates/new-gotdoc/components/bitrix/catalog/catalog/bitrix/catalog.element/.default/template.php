<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
//echo '<pre>';
//print_r($arResult["DISPLAY_PROPERTIES"]);
//echo '</pre>';
?>

<div class="col-lg-5 pl-0 pr-4">
    <div class="goods">
        <img class="goods-img" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>"
             title="<?= $arResult["NAME"] ?>">
    </div>
</div>
<div class="col-lg-7 px-0">
    <h1 class="title w-75"><?= $arResult["NAME"] ?></h1>
    <div class="price">
        <div>
            <? foreach ($arResult["PRICES"] as $code => $arPrice): ?>
                <span class="goods_price-new"><?= substr($arPrice["PRINT_VALUE"], 0, -7); ?> руб.</span>
            <? endforeach; ?>
            <span class="price-old">
                <? if ($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]): ?>
                    <?= $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"] ?> руб.
                <? endif; ?>
            </span>
        </div>
        <div>
            <a href="#" class="btn text-decoration-none goods_buy-button">Заказать</a>
        </div>
    </div>
    <div class="goods-content">
        <p class="goods-content_text">
            <?= $arResult["PROPERTIES"]["WHAT_CORRESPONDS"]["~VALUE"]["TEXT"] ?>
        </p>
    </div>


        <?php
        echo '<pre>';
        print_r($arResult["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]["SRC"]);
        echo '</pre>';
        ?>

        <div class="goods-banner"><img src="" alt="goods-banner"></div>


</div>
<div class="goods-description">
    <div class="d-flex">
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description1" role="button"
           aria-expanded="false" aria-controls="description1">Описание</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description2" role="button"
           aria-expanded="false" aria-controls="description2">Перечень документов</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description3" role="button"
           aria-expanded="false" aria-controls="description3">Как заказать</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description4" role="button"
           aria-expanded="false" aria-controls="description4">Вопросы-ответы</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description5" role="button"
           aria-expanded="false" aria-controls="description5">Отзывы</a>
    </div>
    <div class="" id="description" data-default="1">
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse show" id="description1" data-parent="#description">
                <ul class="goods-description_list">
                    <li>Документы (точное количество зависит от организации) + инструкция по работе с
                        комплектом
                    </li>
                    <li>Внесена вся информация об организации</li>
                    <li>Учитывает специфику объекта</li>
                    <li>Формат .docx</li>
                    <li>В течение 1 дня после оплаты</li>
                    <li>Отправка на e-mail</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse" id="description2" data-parent="#description">
                <div class="goods-description_list">
                    <b>Внимание! Ниже указан типовой перечень документов.</b>
                    <p>Окончательный перечень будет зависеть от характеристик конкретного объекта.</p>
                    <b>Ответьте на несколько вопросов и узнайте перечень документов для ВАШЕГО объекта</b>
                    <ol>
                        <b>Инструкции, программы, памятки:</b>
                        <li>Инструкция о мерах пожарной безопасности в дошкольной образовательной
                            организации.
                        </li>
                        <li>Программа вводного противопожарного инструктажа в дошкольной образовательной
                            jрганизации.
                        </li>
                        <li>Программа первичного противопожарного инструктажа в дошкольной образовательной
                            организации.
                        </li>
                        <li>Инструкция о действиях персонала по эвакуации людей при пожаре в дошкольной
                            образовательной организации.
                        </li>
                        <li>Инструкция о порядке действий дежурного персонала при поступлении сигнала о
                            пожаре и неисправности системы противопожарной защиты.
                        </li>
                        <li>Инструкция о мерах пожарной безопасности на территории, в здании и помещениях
                            организации общественного питания (столовой).
                        </li>
                        <li>Программа вводного противопожарного инструктажа организации общественного
                            питания (столовой).
                        </li>
                        <li>Программа первичного противопожарного инструктажа организации общественного
                            питания (столовой).
                        </li>
                        <li>Инструкция о действиях персонала по эвакуации людей при пожаре в организации
                            общественного питания (столовой).
                        </li>
                        <li>Инструкция по порядку использования лифтов, имеющих режим работы
                            «Транспортировка пожарных подразделений».
                        </li>
                        <li>Памятка (правила) пользования лифтом, в режиме «Транспортировка пожарных
                            подразделений».
                        </li>
                    </ol>
                    <b>Приказы:</b>
                    <ol>
                        <li>Приказ о назначении лица ответственного за пожарную безопасность.</li>
                        <li>Приказ об утверждении порядка обучения мерам пожарной безопасности.</li>
                        <li>Приказ об обеспечении пожарной безопасности.</li>
                        <li>Приказ о проведении тренировки по эвакуации и тушению условного пожара.</li>
                        <li>Приказ об итогах подготовки и проведения тренировки.</li>
                    </ol>
                    <b>Журналы:</b>
                    <ol>
                        <li>Журнал учета инструктажей по пожарной безопасности.</li>
                        <li>Журнал учета выдачи нарядов-допусков на выполнение огневых работ.</li>
                        <li>Журнал учета наличия, периодических осмотров и сроков перезарядки огнетушителей.
                        </li>
                        <li>Журнал учета проверок юридического лица, индивидуального предпринимателя,
                            проводимых органами государственного контроля (надзора), органами муниципального
                            контроля.
                        </li>
                        <li>Журнал проверки работоспособности задвижек с электроприводом и пожарных насосов.
                        </li>
                        <li>Журнал регистрации работ по ТО и ТР системы.</li>
                        <li>Журнал регистрации тренировок по эвакуации.</li>
                    </ol>
                    <b>Графики и планы:</b>
                    <ol>
                        <li>График проведения повторного противопожарного инструктажа.</li>
                        <li>График проведения тренировок.</li>
                        <li>График проведения работ по очистке воздуховодов и вентиляционного оборудования
                            от горючих отходов.
                        </li>
                        <li>График проведения ТО и ремонта.</li>
                    </ol>
                    <b>Акты и протоколы:</b>
                    <ol>
                        <li>Акт проверки работоспособности (проведения работ по техническому обслуживанию)
                            средств обеспечения пожарной безопасности зданий и сооружений.
                        </li>
                        <li>Акт проверки исправности клапанов мусоропровода и помещений мусоросборных камер.
                        </li>
                        <li>Акт испытаний внутреннего пожарного водопровода на работоспособность.</li>
                        <li>Акт огнезащитной обработки.</li>
                        <li>Акт приемки работ по очистке вентиляционных систем.</li>
                        <li>Акт периодической проверки дымовых и вентиляционных каналов от газоиспользующего
                            оборудования и бытовых печей.
                        </li>
                        <li>Протокол испытаний по контролю качества огнезащитной обработки конструкций из
                            древесины.
                        </li>
                        <li>Протокол испытаний внутреннего противопожарного водопровода на водоотдачу.</li>
                        <li>Протокол испытаний лестниц и ограждений.</li>
                        <li>Акт испытаний противодымной вентиляции.</li>
                        <li>Акт о перекатке пожарных рукавов.</li>
                        <li>Акт о проведении тренировки</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse" id="description3" data-parent="#description">
                <div class="d-flex goods-description_list">
                    <div class="goods-description_list__frame">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="410" height="280" src="https://www.youtube.com/embed/Gg0oZWq4Qfg"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                        <p class="goods-description_list__text goods-content_text">Видеоинструкция как
                            заказать готовый комплект
                            документов</p>
                    </div>
                    <div>
                        <b>Чтобы заказать готовый комплект документов необходимо:</b>
                        <ol class="pl-3">
                            <li>Нажать кнопку заказать</li>
                            <li>Заполнить опросный лист (от 30 до 50 вопросов об объекте)</li>
                            <li>Оплатить</li>
                            <li>Скачать готовый комплект в личном кабинете</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse" id="description4" data-parent="#description">
                <div class="question">
                    <b class="question-title">Как сделать, чтобы узнать то или другое?</b>
                    <div class="question-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                        laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                        Proin
                        sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient
                        montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate,
                        felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                    </div>
                </div>
                <div class="question">
                    <b class="question-title">Как сделать, чтобы узнать то или другое?</b>
                    <div class="question-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                        laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                        Proin
                        sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient
                        montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate,
                        felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                    </div>
                </div>
                <div class="question">
                    <b class="question-title">Как сделать, чтобы узнать то или другое?</b>
                    <div class="question-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                        laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                        Proin
                        sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis parturient
                        montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate,
                        felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 px-0">
            <div class="collapse multi-collapse" id="description5" data-parent="#description">
                <div class="question d-flex">
                    <div class="review-img rounded-circle">
                        <div class="review-img_url" style="background-image: url(/new-gotdoc/img/books.png);"></div>
                    </div>
                    <div>
                        <b class="question-title">ООО "Весло37"</b>
                        <div class="question-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                            laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                            Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                            vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                        </div>
                    </div>
                </div>
                <div class="question d-flex">
                    <div class="review-img rounded-circle">
                        <div class="review-img_url" style="background-image: url(/new-gotdoc/img/docs.png);"></div>
                    </div>
                    <div>
                        <b class="question-title">ИП Чернова Н.В.</b>
                        <div class="question-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                            laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                            Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                            vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                        </div>
                    </div>
                </div>
                <div class="question d-flex">
                    <div class="review-img rounded-circle">
                        <div class="review-img_url" style="background-image: url(/new-gotdoc/img/fabras.png);"></div>
                    </div>
                    <div>
                        <b class="question-title">ООО "Фабрас"</b>
                        <div class="question-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                            laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                            Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                            vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                            laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                            Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                            vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                        </div>
                    </div>
                </div>
                <div class="question d-flex">
                    <div class="review-img rounded-circle">
                        <div class="review-img_url" style="background-image: url(/new-gotdoc/img/books.png);"></div>
                    </div>
                    <div>
                        <b class="question-title">ООО "Центр ПБ"</b>
                        <div class="question-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum
                            laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                            Proin sodales pulvinar sic tempor. Sociis natoque penatibus et magnis dis
                            parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                            vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="catalog-element">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <? if (is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])): ?>
                <td width="0%" valign="top">
                    <? if (is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])): ?>
                        <img border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>"
                             width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>"
                             height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>"
                             title="<?= $arResult["NAME"] ?>" id="image_<?= $arResult["PREVIEW_PICTURE"]["ID"] ?>"
                             style="display:block;cursor:pointer;cursor: hand;"
                             OnClick="document.getElementById('image_<?= $arResult["PREVIEW_PICTURE"]["ID"] ?>').style.display='none';document.getElementById('image_<?= $arResult["DETAIL_PICTURE"]["ID"] ?>').style.display='block'"/>
                        <img border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                             width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                             height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>"
                             title="<?= $arResult["NAME"] ?>" id="image_<?= $arResult["DETAIL_PICTURE"]["ID"] ?>"
                             style="display:none;cursor:pointer; cursor: hand;"
                             OnClick="document.getElementById('image_<?= $arResult["DETAIL_PICTURE"]["ID"] ?>').style.display='none';document.getElementById('image_<?= $arResult["PREVIEW_PICTURE"]["ID"] ?>').style.display='block'"/>
                    <? elseif (is_array($arResult["DETAIL_PICTURE"])): ?>
                        <img border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                             width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                             height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>"
                             title="<?= $arResult["NAME"] ?>"/>
                    <? elseif (is_array($arResult["PREVIEW_PICTURE"])): ?>
                        <img border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>"
                             width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>"
                             height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>"
                             title="<?= $arResult["NAME"] ?>"/>
                    <? endif ?>
                    <? if (count($arResult["MORE_PHOTO"]) > 0): ?>
                        <br/><a href="#more_photo"><?= GetMessage("CATALOG_MORE_PHOTO") ?></a>
                    <? endif; ?>
                </td>
            <? endif; ?>
            <td width="100%" valign="top">
                <? foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                    <?= $arProperty["NAME"] ?>:<b>&nbsp;<?
                        if (is_array($arProperty["DISPLAY_VALUE"])):
                            echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                        elseif ($pid == "MANUAL"):
                            ?><a href="<?= $arProperty["VALUE"] ?>"><?= GetMessage("CATALOG_DOWNLOAD") ?></a><?
                        else:
                            echo $arProperty["DISPLAY_VALUE"]; ?>
                        <? endif ?></b><br/>
                <? endforeach ?>
            </td>
        </tr>
    </table>
    <? if (is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])): ?>
        <? foreach ($arResult["OFFERS"] as $arOffer): ?>
            <? foreach ($arParams["OFFERS_FIELD_CODE"] as $field_code): ?>
                <small><? echo GetMessage("IBLOCK_FIELD_" . $field_code) ?>:&nbsp;<?
                    echo $arOffer[$field_code]; ?></small><br/>
            <? endforeach; ?>
            <? foreach ($arOffer["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                <small><?= $arProperty["NAME"] ?>:&nbsp;<?
                    if (is_array($arProperty["DISPLAY_VALUE"]))
                        echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                    else
                        echo $arProperty["DISPLAY_VALUE"]; ?></small><br/>
            <? endforeach ?>
            <? foreach ($arOffer["PRICES"] as $code => $arPrice): ?>
                <? if ($arPrice["CAN_ACCESS"]): ?>
                    <p><?= $arResult["CAT_PRICES"][$code]["TITLE"]; ?>:&nbsp;&nbsp;
                        <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                            <s><?= $arPrice["PRINT_VALUE"] ?></s> <span
                                    class="catalog-price 1"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?></span>
                        <? else: ?>
                            <span class="catalog-price 2"><?= $arPrice["PRINT_VALUE"] ?></span>
                        <? endif ?>
                    </p>
                <? endif; ?>
            <? endforeach; ?>
            <p>
            <? if ($arParams["DISPLAY_COMPARE"]): ?>
                <noindex>
                    <a href="<? echo $arOffer["COMPARE_URL"] ?>"
                       rel="nofollow"><? echo GetMessage("CT_BCE_CATALOG_COMPARE") ?></a>&nbsp;
                </noindex>
            <? endif ?>
            <? if ($arOffer["CAN_BUY"]): ?>
                <? if ($arParams["USE_PRODUCT_QUANTITY"]): ?>
                    <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
                        <table border="0" cellspacing="0" cellpadding="2">
                            <tr valign="top">
                                <td><? echo GetMessage("CT_BCE_QUANTITY") ?>:</td>
                                <td>
                                    <input type="text" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
                                           value="1" size="5">
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                        <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                               value="<? echo $arOffer["ID"] ?>">
                        <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                               value="<? echo GetMessage("CATALOG_BUY") ?>">
                        <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>"
                               value="<? echo GetMessage("CT_BCE_CATALOG_ADD") ?>">
                    </form>
                <? else: ?>
                    <noindex>
                        <a href="<? echo $arOffer["BUY_URL"] ?>" rel="nofollow"><? echo GetMessage("CATALOG_BUY") ?></a>
                        &nbsp;<a href="<? echo $arOffer["ADD_URL"] ?>"
                                 rel="nofollow"><? echo GetMessage("CT_BCE_CATALOG_ADD") ?></a>
                    </noindex>
                <? endif; ?>
            <? elseif (count($arResult["CAT_PRICES"]) > 0): ?>
                <?= GetMessage("CATALOG_NOT_AVAILABLE") ?>
            <? endif ?>
            </p>
        <? endforeach; ?>
    <? else: ?>
        <? foreach ($arResult["PRICES"] as $code => $arPrice): ?>
            <? if ($arPrice["CAN_ACCESS"]): ?>
                <p><?= $arResult["CAT_PRICES"][$code]["TITLE"]; ?>&nbsp;
                    <? if ($arParams["PRICE_VAT_SHOW_VALUE"] && ($arPrice["VATRATE_VALUE"] > 0)): ?>
                        <? if ($arParams["PRICE_VAT_INCLUDE"]): ?>
                            (<? echo GetMessage("CATALOG_PRICE_VAT") ?>)
                        <? else: ?>
                            (<? echo GetMessage("CATALOG_PRICE_NOVAT") ?>)
                        <? endif ?>
                    <? endif; ?>:&nbsp;
                    <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                        <s><?= $arPrice["PRINT_VALUE"] ?></s> <span
                                class="catalog-price 3"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?></span>
                        <? if ($arParams["PRICE_VAT_SHOW_VALUE"]): ?><br/>
                            <?= GetMessage("CATALOG_VAT") ?>:&nbsp;&nbsp;<span
                                    class="catalog-vat catalog-price 4"><?= $arPrice["DISCOUNT_VATRATE_VALUE"] > 0 ? $arPrice["PRINT_DISCOUNT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT") ?></span>
                        <? endif; ?>
                    <? else: ?>
                        <span class="catalog-price 5"><?= $arPrice["PRINT_VALUE"] ?></span>
                        <? if ($arParams["PRICE_VAT_SHOW_VALUE"]): ?><br/>
                            <?= GetMessage("CATALOG_VAT") ?>:&nbsp;&nbsp;<span
                                    class="catalog-vat catalog-price 6"><?= $arPrice["VATRATE_VALUE"] > 0 ? $arPrice["PRINT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT") ?></span>
                        <? endif; ?>
                    <? endif ?>
                </p>
            <? endif; ?>
        <? endforeach; ?>
        <? if (is_array($arResult["PRICE_MATRIX"])): ?>
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
                <thead>
                <tr>
                    <? if (count($arResult["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)): ?>
                        <td><?= GetMessage("CATALOG_QUANTITY") ?></td>
                    <? endif; ?>
                    <? foreach ($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType): ?>
                        <td><?= $arType["NAME_LANG"] ?></td>
                    <? endforeach ?>
                </tr>
                </thead>
                <? foreach ($arResult["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity): ?>
                    <tr>
                        <? if (count($arResult["PRICE_MATRIX"]["ROWS"]) > 1 || count($arResult["PRICE_MATRIX"]["ROWS"]) == 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)): ?>
                            <th nowrap>
                                <? if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                    echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
                                elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
                                    echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
                                elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                    echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
                                ?>
                            </th>
                        <? endif; ?>
                        <? foreach ($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType): ?>
                            <td>
                                <? if ($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"])
                                    echo '<s>' . FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]) . '</s> <span class="catalog-price 7">' . FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]) . "</span>";
                                else
                                    echo '<span class="catalog-price 8">' . FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]) . "</span>";
                                ?>
                            </td>
                        <? endforeach ?>
                    </tr>
                <? endforeach ?>
            </table>
            <? if ($arParams["PRICE_VAT_SHOW_VALUE"]): ?>
                <? if ($arParams["PRICE_VAT_INCLUDE"]): ?>
                    <small><?= GetMessage('CATALOG_VAT_INCLUDED') ?></small>
                <? else: ?>
                    <small><?= GetMessage('CATALOG_VAT_NOT_INCLUDED') ?></small>
                <? endif ?>
            <? endif; ?><br/>
        <? endif ?>
        <? if ($arResult["CAN_BUY"]): ?>
            <? if ($arParams["USE_PRODUCT_QUANTITY"] || count($arResult["PRODUCT_PROPERTIES"])): ?>
                <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
                    <table border="0" cellspacing="0" cellpadding="2">
                        <? if ($arParams["USE_PRODUCT_QUANTITY"]): ?>
                            <tr valign="top">
                                <td><? echo GetMessage("CT_BCE_QUANTITY") ?>:</td>
                                <td>
                                    <input type="text" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
                                           value="1" size="5">
                                </td>
                            </tr>
                        <? endif; ?>
                        <? foreach ($arResult["PRODUCT_PROPERTIES"] as $pid => $product_property): ?>
                            <tr valign="top">
                                <td><? echo $arResult["PROPERTIES"][$pid]["NAME"] ?>:</td>
                                <td>
                                    <? if (
                                        $arResult["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
                                        && $arResult["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
                                    ): ?>
                                        <? foreach ($product_property["VALUES"] as $k => $v): ?>
                                            <label><input type="radio"
                                                          name="<? echo $arParams["PRODUCT_PROPS_VARIABLE"] ?>[<? echo $pid ?>]"
                                                          value="<? echo $k ?>" <? if ($k == $product_property["SELECTED"]) echo '"checked"' ?>><? echo $v ?>
                                            </label><br>
                                        <? endforeach; ?>
                                    <? else: ?>
                                        <select name="<? echo $arParams["PRODUCT_PROPS_VARIABLE"] ?>[<? echo $pid ?>]">
                                            <? foreach ($product_property["VALUES"] as $k => $v): ?>
                                                <option value="<? echo $k ?>" <? if ($k == $product_property["SELECTED"]) echo '"selected"' ?>><? echo $v ?></option>
                                            <? endforeach; ?>
                                        </select>
                                    <? endif; ?>
                                </td>
                            </tr>
                        <? endforeach; ?>
                    </table>
                    <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                    <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                           value="<? echo $arResult["ID"] ?>">
                    <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                           value="<? echo GetMessage("CATALOG_BUY") ?>">
                    <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>"
                           value="<? echo GetMessage("CATALOG_ADD_TO_BASKET") ?>">
                </form>
            <? else: ?>
                <noindex>
                    <a href="<? echo $arResult["BUY_URL"] ?>" rel="nofollow"><? echo GetMessage("CATALOG_BUY") ?></a>
                    &nbsp;<a href="<? echo $arResult["ADD_URL"] ?>"
                             rel="nofollow"><? echo GetMessage("CATALOG_ADD_TO_BASKET") ?></a>
                </noindex>
            <? endif; ?>
        <? elseif ((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])): ?>
            <?= GetMessage("CATALOG_NOT_AVAILABLE") ?>
        <? endif ?>
    <? endif ?>
    <br/>
    <? if ($arResult["DETAIL_TEXT"]): ?>
        <br/><?= $arResult["DETAIL_TEXT"] ?><br/>
    <? elseif ($arResult["PREVIEW_TEXT"]): ?>
        <br/><?= $arResult["PREVIEW_TEXT"] ?><br/>
    <? endif; ?>
    <? if (count($arResult["LINKED_ELEMENTS"]) > 0): ?>
        <br/><b><?= $arResult["LINKED_ELEMENTS"][0]["IBLOCK_NAME"] ?>:</b>
        <ul>
            <? foreach ($arResult["LINKED_ELEMENTS"] as $arElement): ?>
                <li><a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><?= $arElement["NAME"] ?></a></li>
            <? endforeach; ?>
        </ul>
    <? endif ?>
    <?
    // additional photos
    $LINE_ELEMENT_COUNT = 2; // number of elements in a row
    if (count($arResult["MORE_PHOTO"]) > 0):?>
        <a name="more_photo"></a>
        <? foreach ($arResult["MORE_PHOTO"] as $PHOTO): ?>
            <img border="0" src="<?= $PHOTO["SRC"] ?>" width="<?= $PHOTO["WIDTH"] ?>" height="<?= $PHOTO["HEIGHT"] ?>"
                 alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?>"/><br/>
        <? endforeach ?>
    <? endif ?>
    <? if (is_array($arResult["SECTION"])): ?>
        <br/><a href="<?= $arResult["SECTION"]["SECTION_PAGE_URL"] ?>"><?= GetMessage("CATALOG_BACK") ?></a>
    <? endif ?>
</div>
