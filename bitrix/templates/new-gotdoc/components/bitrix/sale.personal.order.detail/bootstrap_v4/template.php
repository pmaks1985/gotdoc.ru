<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset,
	Bitrix\Main\Config\Configuration,
    Bitrix\Main\Web\HttpClient,
	Bitrix\Main\Application,
    Bitrix\Main\Web\Uri;



if ($arParams['GUEST_MODE'] !== 'Y')
{
	Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
	Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
}
CJSCore::Init(array('clipboard', 'fx'));

$APPLICATION->SetTitle("");

if (!empty($arResult['ERRORS']['FATAL']))
{
	$component = $this->__component;
	foreach($arResult['ERRORS']['FATAL'] as $code => $error)
	{
		if ($code !== $component::E_NOT_AUTHORIZED)
			ShowError($error);
	}

	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		?>
		<div class="row">
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<div class="alert alert-danger"><?=$arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]?></div>
			</div>
			<? $authListGetParams = array(); ?>
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<?$APPLICATION->AuthForm('', false, false, 'N', false);?>
			</div>
		</div>
		<?
	}
}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach ($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	?>
	<div class="row sale-order-detail">
		<div class="col">

			<h1 class="mb-3">
				<?= Loc::getMessage('SPOD_LIST_MY_ORDER', array(
					'#ACCOUNT_NUMBER#' => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
					'#DATE_ORDER_CREATE#' => $arResult["DATE_INSERT_FORMATED"]
				)) ?>
			</h1>

			<? if ($arParams['GUEST_MODE'] !== 'Y')
			{
				?>
				<div class="mb-3">
					<a href="<?= htmlspecialcharsbx($arResult["URL_TO_LIST"]) ?>">&larr; <?= Loc::getMessage('SPOD_RETURN_LIST_ORDERS') ?></a>
				</div>
				<?
			}
			?>

			<div class="row mb-3 mx-0">
				<div class="col sale-order-detail-card">

					<h2 class="sale-order-detail-card-title">
						<?= Loc::getMessage('SPOD_SUB_ORDER_TITLE', array(
							"#ACCOUNT_NUMBER#"=> htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
							"#DATE_ORDER_CREATE#"=> $arResult["DATE_INSERT_FORMATED"]
						))?>
						<?= count($arResult['BASKET']);?>
						<?
						$count = count($arResult['BASKET']) % 10;
						if ($count == '1')
						{
							echo Loc::getMessage('SPOD_TPL_GOOD');
						}
						elseif ($count >= '2' && $count <= '4')
						{
							echo Loc::getMessage('SPOD_TPL_TWO_GOODS');
						}
						else
						{
							echo Loc::getMessage('SPOD_TPL_GOODS');
						}
						?>
						<?=Loc::getMessage('SPOD_TPL_SUMOF')?>
						<?=$arResult["PRICE_FORMATED"]?>
					</h2>

					<div class="row mb-3">
						<div class="col p-0">
							<h3 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_LIST_ORDER_INFO') ?></h3>
							<div class="row m-0">
								<div class="col-sm mb-3">
									<div class="sale-order-detail-prop-name">
										<?
										$userName = $arResult["USER_NAME"];
										if ($userName <> '' || $arResult['FIO'] <> '')
										{
											echo Loc::getMessage('SPOD_LIST_FIO').':';
										}
										else
										{
											echo Loc::getMessage('SPOD_LOGIN').':';
										}
										?>
									</div>
									<div class="sale-order-detail-prop-value">
										<? if($userName <> '')
										{
											echo htmlspecialcharsbx($userName);
										}
										elseif(mb_strlen($arResult['FIO']))
										{
											echo htmlspecialcharsbx($arResult['FIO']);
										}
										else
										{
											echo htmlspecialcharsbx($arResult["USER"]['LOGIN']);
										}
										?>
									</div>
									<div class="pt-3">
										<a href="" onclick="return false;"
										   class="sale-order-detail-more-info-less"><?= Loc::getMessage('SPOD_LIST_LESS') ?></a>
										<a href="" onclick="return false;"
										   class="sale-order-detail-more-info-more"><?= Loc::getMessage('SPOD_LIST_MORE') ?></a>
									</div>
								</div>

								<div class="col-sm-auto mb-3">
									<div class="sale-order-detail-prop-name">
										<?= Loc::getMessage('SPOD_LIST_CURRENT_STATUS_DATE', array(
											'#DATE_STATUS#' => $arResult["DATE_STATUS_FORMATED"]
										)) ?>
									</div>
									<div class="sale-order-detail-prop-value">
										<? if ($arResult['CANCELED'] !== 'Y')
										{
											echo htmlspecialcharsbx($arResult["STATUS"]["NAME"]);
										}
										else
										{
											echo Loc::getMessage('SPOD_ORDER_CANCELED');
										}
										?>
									</div>
								</div>

								<div class="col-sm mb-3">
									<div class="sale-order-detail-prop-name"><?= Loc::getMessage('SPOD_ORDER_PRICE')?>:</div>
									<div class="sale-order-detail-prop-value"><?= $arResult["PRICE_FORMATED"]?></div>
								</div>

								<? if ($arParams['GUEST_MODE'] !== 'Y')
								{
									?>
									<div class="col-sm-auto mb-3 text-center">
										<a href="<?=$arResult["URL_TO_COPY"]?>"
										   class="btn btn-primary btn-block btn-sm my-1"><?= Loc::getMessage('SPOD_ORDER_REPEAT') ?></a>
										<? if ($arResult["CAN_CANCEL"] === "Y")
										{
											?>
											<a href="<?=$arResult["URL_TO_CANCEL"]?>" class="btn btn-link btn-sm my-1"><?= Loc::getMessage('SPOD_ORDER_CANCEL') ?></a>
											<?
										}
										?>
									</div>
									<?
								}
								?>
							</div>

							<div class="row m-0 sale-order-detail-more-info-details" style="display: none;">
								<div class="col">
									<h4 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_USER_INFORMATION') ?></h4>

									<div class="table-responsive">
										<table class="table table-bordered table-striped mb-3 sale-order-detail-more-info-details-table">
										<? if (mb_strlen($arResult["USER"]["LOGIN"]) && !in_array("LOGIN", $arParams['HIDE_USER_INFO']))
										{
											?>
											<tr>
												<th><?= Loc::getMessage('SPOD_LOGIN')?>:</th>
												<td><?= htmlspecialcharsbx($arResult["USER"]["LOGIN"]) ?></td>
											</tr>
											<?
										}
										if (mb_strlen($arResult["USER"]["EMAIL"]) && !in_array("EMAIL", $arParams['HIDE_USER_INFO']))
										{
											?>
											<tr>
												<th><?= Loc::getMessage('SPOD_EMAIL')?>:</th>
												<td>
													<a class="" href="mailto:<?= htmlspecialcharsbx($arResult["USER"]["EMAIL"]) ?>"><?= htmlspecialcharsbx($arResult["USER"]["EMAIL"]) ?></a>
												</td>
											</tr>
											<?
										}
										if (mb_strlen($arResult["USER"]["PERSON_TYPE_NAME"]) && !in_array("PERSON_TYPE_NAME", $arParams['HIDE_USER_INFO']))
										{
											?>
											<tr>
												<th><?= Loc::getMessage('SPOD_PERSON_TYPE_NAME') ?>:</th>
												<td><?= htmlspecialcharsbx($arResult["USER"]["PERSON_TYPE_NAME"]) ?></td>
											</tr>
											<?
										}
										if (isset($arResult["ORDER_PROPS"]))
										{
											foreach ($arResult["ORDER_PROPS"] as $property)
											{
												?>
												<tr>
													<th><?= htmlspecialcharsbx($property['NAME']) ?>:</th>
													<td><? if ($property["TYPE"] == "Y/N")
														{
															echo Loc::getMessage('SPOD_' . ($property["VALUE"] == "Y" ? 'YES' : 'NO'));
														}
														else
														{
															if ($property['MULTIPLE'] == 'Y'
																&& $property['TYPE'] !== 'FILE'
																&& $property['TYPE'] !== 'LOCATION')
															{
																$propertyList = unserialize($property["VALUE"], ['allowed_classes' => false]);
																foreach ($propertyList as $propertyElement)
																{
																	echo $propertyElement . '</br>';
																}
															}
															elseif ($property['TYPE'] == 'FILE')
															{
																echo $property["VALUE"];
															}
															else
															{
																echo htmlspecialcharsbx($property["VALUE"]);
															}
														}
														?>
													</td>
												</tr>
												<?
											}
										}
										?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

					<? if($arResult["USER_DESCRIPTION"] <> '')
					{
						?>
						<div class="row mb-3">
							<div class="col p-0">
								<h4 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_ORDER_DESC') ?></h4>
								<p class="col sale-order-detail-section-comments"><?= nl2br(htmlspecialcharsbx($arResult["USER_DESCRIPTION"])) ?></p>
							</div>
						</div>
						<?
					}
					?>

					<div class="row mb-3">
						<div class="col p-0">
							<h3 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_ORDER_PAYMENT') ?></h3>

							<div class="row pb-3 m-0 align-items-center">
								<div class="col-lg-1 col-md-2 col-xs-2 d-none d-sm-block sale-order-detail-section-payment-image"></div>
								<div class="col">
									<div class="sale-order-detail-payment-options-info-order-number">
										<?= Loc::getMessage('SPOD_SUB_ORDER_TITLE', array(
											"#ACCOUNT_NUMBER#"=> htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
											"#DATE_ORDER_CREATE#"=> $arResult["DATE_INSERT_FORMATED"]
										))?>
										<?
										if ($arResult['CANCELED'] !== 'Y')
										{
											echo htmlspecialcharsbx($arResult["STATUS"]["NAME"]);
										}
										else
										{
											echo Loc::getMessage('SPOD_ORDER_CANCELED');
										}
										?>
									</div>
									<div class="sale-order-detail-payment-options-info-total-price">
										<?=Loc::getMessage('SPOD_ORDER_PRICE_FULL')?>:
										<span><?=$arResult["PRICE_FORMATED"]?></span>
									</div>
									<?
									if (!empty($arResult["SUM_REST"]) && !empty($arResult["SUM_PAID"]))
									{
										?>
										<div class="sale-order-detail-payment-options-info-total-price">
											<?=Loc::getMessage('SPOD_ORDER_SUM_PAID')?>:
											<span><?=$arResult["SUM_PAID_FORMATED"]?></span>
										</div>
										<div class="sale-order-detail-payment-options-info-total-price">
											<?=Loc::getMessage('SPOD_ORDER_SUM_REST')?>:
											<span><?=$arResult["SUM_REST_FORMATED"]?></span>
										</div>
										<?
									}
									?>
								</div>
							</div>

							<? foreach ($arResult['PAYMENT'] as $payment)
							{
								?>
								<div class="row m-0">
									<div class="col sale-order-detail-payment-options-methods-container">
										<div class="row payment-options-methods-row">
											<div class="col sale-order-detail-payment-options-methods">
												<div class="row m-0 align-items-center sale-order-detail-payment-options-methods-information-block">
													<div class="col-auto d-none d-sm-block sale-order-detail-payment-options-methods-image-container">
														<span class="sale-order-detail-payment-options-methods-image-element" style="background-image: url('<?= $payment['PAY_SYSTEM']["SRC_LOGOTIP"] <> ''? htmlspecialcharsbx($payment['PAY_SYSTEM']["SRC_LOGOTIP"]) : '/bitrix/images/sale/nopaysystem.gif'?>');"></span>
													</div>
													<div class="col sale-order-detail-payment-options-methods-info">
														<div class="mb-2 sale-order-detail-payment-options-methods-info-title">
															<div class="sale-order-detail-methods-title">
																<?
																$paymentData[$payment['ACCOUNT_NUMBER']] = array(
																	"payment" => $payment['ACCOUNT_NUMBER'],
																	"order" => $arResult['ACCOUNT_NUMBER'],
																	"allow_inner" => $arParams['ALLOW_INNER'],
																	"only_inner_full" => $arParams['ONLY_INNER_FULL'],
																	"refresh_prices" => $arParams['REFRESH_PRICES'],
																	"path_to_payment" => $arParams['PATH_TO_PAYMENT']
																);
																$paymentSubTitle = Loc::getMessage('SPOD_TPL_BILL')." ".Loc::getMessage('SPOD_NUM_SIGN').$payment['ACCOUNT_NUMBER'];
																if(isset($payment['DATE_BILL']))
																{
																	$paymentSubTitle .= " ".Loc::getMessage('SPOD_FROM')." ".$payment['DATE_BILL_FORMATED'];
																}
																$paymentSubTitle .=",";
																echo htmlspecialcharsbx($paymentSubTitle);
																?>
																<span class="sale-order-list-payment-title-element"><?=$payment['PAY_SYSTEM_NAME']?></span>
																<?
																if ($payment['PAID'] === 'Y')
																{
																	?>
																	<span class="sale-order-detail-payment-options-methods-info-title-status-success">
																		<?=Loc::getMessage('SPOD_PAYMENT_PAID')?>
																	</span>
																	<?
																}
																elseif ($arResult['IS_ALLOW_PAY'] == 'N')
																{
																	?>
																	<span class="sale-order-detail-payment-options-methods-info-title-status-restricted">
																		<?=Loc::getMessage('SPOD_TPL_RESTRICTED_PAID')?>
																	</span>
																	<?
																}
																else
																{
																	?>
																	<span class="sale-order-detail-payment-options-methods-info-title-status-alert">
																		<?=Loc::getMessage('SPOD_PAYMENT_UNPAID')?>
																	</span>
																	<?
																}
																?>
															</div>
														</div>
														<div class="mb-2 sale-order-detail-payment-options-methods-info-total-price">
															<span class="sale-order-detail-sum-name"><?= Loc::getMessage('SPOD_ORDER_PRICE_BILL')?>:</span>
															<span class="sale-order-detail-sum-number"><?=$payment['PRICE_FORMATED']?></span>
														</div>
														<?
														if (!empty($payment['CHECK_DATA']))
														{
															$listCheckLinks = "";
															foreach ($payment['CHECK_DATA'] as $checkInfo)
															{
																$title = Loc::getMessage('SPOD_CHECK_NUM', array('#CHECK_NUMBER#' => $checkInfo['ID']))." - ". htmlspecialcharsbx($checkInfo['TYPE_NAME']);
																if ($checkInfo['LINK'] <> '')
																{
																	$link = $checkInfo['LINK'];
																	$listCheckLinks .= "<div><a href='$link' target='_blank'>$title</a></div>";
																}
															}
															if ($listCheckLinks <> '')
															{
																?>
																<div class="sale-order-detail-payment-options-methods-info-total-check">
																	<div class="sale-order-detail-sum-check-left"><?= Loc::getMessage('SPOD_CHECK_TITLE')?>:</div>
																	<div class="sale-order-detail-sum-check-left"><?=$listCheckLinks?></div>
																</div>
																<?
															}
														}
														if (
															$payment['PAID'] !== 'Y'
															&& $arResult['CANCELED'] !== 'Y'
															&& $arParams['GUEST_MODE'] !== 'Y'
															&& $arResult['LOCK_CHANGE_PAYSYSTEM'] !== 'Y'
														)
														{
															?>
															<a href="#" id="<?=$payment['ACCOUNT_NUMBER']?>" class="sale-order-detail-payment-options-methods-info-change-link"><?=Loc::getMessage('SPOD_CHANGE_PAYMENT_TYPE')?></a>
															<?
														}
														?>
														<?
														if ($arResult['IS_ALLOW_PAY'] === 'N' && $payment['PAID'] !== 'Y')
														{
															?>
															<div class="sale-order-detail-status-restricted-message-block">
																<span class="sale-order-detail-status-restricted-message"><?=Loc::getMessage('SOPD_TPL_RESTRICTED_PAID_MESSAGE')?></span>
															</div>
															<?
														}
														?>
													</div>
													<?
													if ($payment['PAY_SYSTEM']["IS_CASH"] !== "Y" && $payment['PAY_SYSTEM']['ACTION_FILE'] !== 'cash')
													{
														?>
														<div class="col-sm-auto col-12 sale-order-detail-payment-options-methods-button-container">
															<? if ($payment['PAY_SYSTEM']['PSA_NEW_WINDOW'] === 'Y' && $arResult["IS_ALLOW_PAY"] !== "N")
															{
																?>
																<a class="btn btn-primary btn-sm" target="_blank" href="<?=htmlspecialcharsbx($payment['PAY_SYSTEM']['PSA_ACTION_FILE'])?>"><?= Loc::getMessage('SPOD_ORDER_PAY') ?></a>
																<?
															}
															else
															{
																if ($payment["PAID"] === "Y" || $arResult["CANCELED"] === "Y" || $arResult["IS_ALLOW_PAY"] === "N")
																{
																	?>
																	<button class="btn btn-primary btn-sm disabled"><?= Loc::getMessage('SPOD_ORDER_PAY') ?></button>
																	<?
																}
																else
																{
																	?>
																	
																	<button class="btn btn-primary btn-sm active-button"><?= Loc::getMessage('SPOD_ORDER_PAY') ?></button>
																	<? 
																	if($payment['PAY_SYSTEM_ID'] == 3){
																	$link = "/personal/personal/order/?ORDER_ID=".$arResult['ID']."&pdf=1&DOWNLOAD=Y"?>
																	<br/>																	
																	<a class="btn btn-primary" id="btnL">Скачать счет на оплату</a>
																	

																	<?}
																	
																}
															}
															?>
														</div>
														<?
													}
													?>
													<br/>
																	<?if($payment['PAID']  ===  "Y"){?>
																	<a class="btn btn-primary" id="btnR">Скачать акт</a>
																	<?}?>
																	
<script>
	$("#btnR").on('click', function(e) {
		event.preventDefault();
        $.ajax({
			url: '/akt/index.php',
            type: 'POST',
			data: {ZAKAZ_ID: <?=$arResult['ID']?>},
            success: function(result) {
				console.log(result);
				//window.open('/upload/invoices/' + <?=$arResult['ID']?> + '.pdf','_blank'); //Открываем в новом окне файл, созданный TCPDF
				var link = document.createElement('a');
				link.setAttribute('href', '/upload/invoices/' + <?=$arResult['ID']?> + '.pdf');
				link.setAttribute('download', <?=$arResult['ID']?> + '.pdf');
				link.click();
				return false;
            },
            error: function(result) {
				console.log(result);
            }
			});


		});
</script>
<script>
	$("#btnL").on('click', function(e) {
		event.preventDefault();
        $.ajax({
			url: '/akt/index2.php',
            type: 'POST',
			data: {ZAKAZ_ID: <?=$arResult['ID']?>},
            success: function(result) {
				console.log(result);
				//window.open('/upload/scet/' + <?=$arResult['ID']?> + '.pdf','_blank'); //Открываем в новом окне файл, созданный TCPDF
				var link = document.createElement('a');
				link.setAttribute('href', '/upload/scet/' + <?=$arResult['ID']?> + '.pdf');
				link.setAttribute('download', <?=$arResult['ID']?> + '.pdf');
				link.click();
				return false;
            },
            error: function(result) {
				console.log(result);
            }
			});


		});
</script>
													<div class="sale-order-detail-payment-inner-row-template col-12">
														<a href="" onclick="return false" class="sale-order-list-cancel-payment">
															<i class="fa fa-long-arrow-left"></i> <?=Loc::getMessage('SPOD_CANCEL_PAYMENT')?>
														</a>
													</div>
												</div>
												<? if ($payment["PAID"] !== "Y"
													&& $payment['PAY_SYSTEM']["IS_CASH"] !== "Y"
													&& $payment['PAY_SYSTEM']['ACTION_FILE'] !== 'cash'
													&& $payment['PAY_SYSTEM']['PSA_NEW_WINDOW'] !== 'Y'
													&& $arResult['CANCELED'] !== 'Y'
													&& $arResult["IS_ALLOW_PAY"] !== "N")
												{
													?>
													<div class="row sale-order-detail-payment-options-methods-template">
														<span class="sale-paysystem-close active-button">
															<span class="sale-paysystem-close-item sale-order-payment-cancel"></span> <!--sale-paysystem-close-item-->
														</span><!--sale-paysystem-close-->
														<div class="col">
															<?=$payment['BUFFERED_OUTPUT']?>
															<!--<a class="sale-order-payment-cancel">--><?//= Loc::getMessage('SPOD_CANCEL_PAY') ?><!--</a>-->
														</div>
													</div>
													<?
												}
												?>
											</div>
										</div>
									</div>
								</div>
								<?
							}
							?>
						</div>
					</div>

					<? if (count($arResult['SHIPMENT']))
					{
						?>
						<div class="row mb-3">
							<div class="col p-0">
								<h3 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_ORDER_SHIPMENT') ?></h3>

								<? foreach ($arResult['SHIPMENT'] as $shipment)
								{
									?>
									<div class="row mb-3">
										<div class="col sale-order-detail-payment-options-shipment">
											<div class="row">

												<? if($shipment['DELIVERY']["SRC_LOGOTIP"] <> '')
												{
													?>
													<div
														class="col-2 sale-order-detail-payment-options-shipment-image-container">
														<span
															class="sale-order-detail-payment-options-shipment-image-element"
															style="background-image: url('<?= htmlspecialcharsbx($shipment['DELIVERY']["SRC_LOGOTIP"]) ?>')"></span>
													</div>
													<?
												}
												?>

												<div class="col sale-order-detail-payment-options-methods-shipment-list">
													<div class="mb-2 sale-order-detail-payment-options-methods-shipment-list-item-title">
														<?
															//change date
															if ($shipment['PRICE_DELIVERY_FORMATED'] == '')
															{
																$shipment['PRICE_DELIVERY_FORMATED'] = 0;
															}
															$shipmentRow = Loc::getMessage('SPOD_SUB_ORDER_SHIPMENT')." ".Loc::getMessage('SPOD_NUM_SIGN').$shipment["ACCOUNT_NUMBER"];
															if ($shipment["DATE_DEDUCTED"])
															{
																$shipmentRow .= " ".Loc::getMessage('SPOD_FROM')." ".$shipment["DATE_DEDUCTED_FORMATED"];
															}
															$shipmentRow = htmlspecialcharsbx($shipmentRow);
															$shipmentRow .= ", ".Loc::getMessage('SPOD_SUB_PRICE_DELIVERY', array(
																	'#PRICE_DELIVERY#' => $shipment['PRICE_DELIVERY_FORMATED']
																));
															echo $shipmentRow;
														?>
													</div>

													<? if($shipment["DELIVERY_NAME"] <> '')
													{
														?>
														<div
															class="mb-2 sale-order-detail-payment-options-methods-shipment-list-item"><?= Loc::getMessage('SPOD_ORDER_DELIVERY') ?>
															: <?= htmlspecialcharsbx($shipment["DELIVERY_NAME"]) ?></div>
														<?
													}
													?>

													<div class="mb-2 sale-order-detail-payment-options-methods-shipment-list-item">
														<?= Loc::getMessage('SPOD_ORDER_SHIPMENT_STATUS')?>:
														<?= htmlspecialcharsbx($shipment['STATUS_NAME'])?>
													</div>

													<? if($shipment['TRACKING_NUMBER'] <> '')
													{
														?>
														<div
															class="mb-2 sale-order-detail-payment-options-methods-shipment-list-item">
															<span
																class="sale-order-list-shipment-id-name"><?= Loc::getMessage('SPOD_ORDER_TRACKING_NUMBER') ?>:</span>
															<span
																class="sale-order-detail-shipment-id"><?= htmlspecialcharsbx($shipment['TRACKING_NUMBER']) ?></span>
															<span class="sale-order-detail-shipment-id-icon"></span>
														</div>
														<?
													}
													?>

													<? if($shipment['TRACKING_URL'] <> '')
													{
														?>
														<div
															class="mb-2 sale-order-detail-payment-options-shipment-button-container">
															<a href="" onclick="return false"
															   class="sale-order-detail-payment-options-shipment-button-element"
															   href="<?= $shipment['TRACKING_URL'] ?>"><?= Loc::getMessage('SPOD_ORDER_CHECK_TRACKING') ?></a>
														</div>
														<?
													}
													?>

													<div class="mt-3 mb-2 sale-order-detail-payment-options-methods-shipment-list-item-link">
														<a href="" onclick="return false" class="sale-order-detail-show-link"><?= Loc::getMessage('SPOD_LIST_SHOW_ALL')?></a>
														<a href="" onclick="return false" class="sale-order-detail-hide-link"><?= Loc::getMessage('SPOD_LIST_LESS')?></a>
													</div>
												</div>

											</div>

											<div class="row sale-order-detail-payment-options-shipment-composition-map" style="display: none;">
												<div class="col">
													<? $store = $arResult['DELIVERY']['STORE_LIST'][$shipment['STORE_ID']];
													if (isset($store))
													{
														?>
														<div class="row mx-0 mb-3">
															<div class="col sale-order-detail-map-container">
																<h4 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_SHIPMENT_STORE')?></h4>
																<? $APPLICATION->IncludeComponent("bitrix:map.yandex.view", "", Array(
																			"INIT_MAP_TYPE" => "COORDINATES",
																			"MAP_DATA" =>   serialize(
																				array(
																					'yandex_lon' => $store['GPS_S'],
																					'yandex_lat' => $store['GPS_N'],
																					'PLACEMARKS' => array(
																						array(
																							"LON" => $store['GPS_S'],
																							"LAT" => $store['GPS_N'],
																							"TEXT" => htmlspecialcharsbx($store['TITLE'])
																						)
																					)
																				)
																			),
																			"MAP_WIDTH" => "100%",
																			"MAP_HEIGHT" => "300",
																			"CONTROLS" => array("ZOOM", "SMALLZOOM", "SCALELINE"),
																			"OPTIONS" => array(
																				"ENABLE_DRAGGING",
																				"ENABLE_SCROLL_ZOOM",
																				"ENABLE_DBLCLICK_ZOOM"
																			),
																			"MAP_ID" => ""
																		)
																	);
																?>
															</div>
														</div>

														<? if($store['ADDRESS'] <> '')
													{
														?>
														<div class="row">
															<div
																class="col sale-order-detail-payment-options-shipment-map-address">
																<div class="row">
																		<span
																			class="col-md-2 sale-order-detail-payment-options-shipment-map-address-title">
																			<?= Loc::getMessage('SPOD_STORE_ADDRESS') ?>:
																		</span>
																	<span
																		class="col sale-order-detail-payment-options-shipment-map-address-element"> <?= htmlspecialcharsbx($store['ADDRESS']) ?> </span>
																</div>
															</div>
														</div>
														<?
													}
													}
													?>

													<div class="row mx-0 mb-3">
														<div class="col">
															<h3 class="sale-order-detail-more-info-details-title"><?= Loc::getMessage('SPOD_ORDER_SHIPMENT_BASKET')?></h3>
															<div class="table-responsive">
																<table class="table">
																	<tbody>
																		<? foreach ($shipment['ITEMS'] as $item)
																		{
																			$basketItem = $arResult['BASKET'][$item['BASKET_ID']];
																			?>
																			<tr>
																				<td class="sale-order-detail-order-item-img-block">
																					<a href="<?=htmlspecialcharsbx($basketItem['DETAIL_PAGE_URL'])?>">
																						<? if($basketItem['PICTURE']['SRC'] <> '')
																						{
																							$imageSrc = htmlspecialcharsbx($basketItem['PICTURE']['SRC']);
																						}
																						else
																						{
																							$imageSrc = $this->GetFolder().'/images/no_photo.png';
																						}
																						?>
																						<span class="sale-order-detail-order-item-img-container" style="background-image: url(<?=$imageSrc?>);"></span>
																					</a>
																				</td>
																				<td class="sale-order-detail-order-item-properties" style="min-width: 250px;">
																					<a class="sale-order-detail-order-item-title"
																					   href="<?=htmlspecialcharsbx($basketItem['DETAIL_PAGE_URL'])?>">
																						<?=htmlspecialcharsbx($basketItem['NAME'])?>
																					</a>
																					<? if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS']))
																					{
																						foreach ($basketItem['PROPS'] as $itemProps)
																						{
																							?>
																							<div>
																								<?= htmlspecialcharsbx($itemProps['NAME']) ?>:
																								<?= htmlspecialcharsbx($itemProps['VALUE']) ?>
																							</div>
																							<?
																						}
																					}
																					?>
																				</td>
																				<td class="sale-order-detail-order-item-properties">
																					<?= Loc::getMessage('SPOD_QUANTITY')?>:
																					<?=$item['QUANTITY']?>&nbsp;<?=htmlspecialcharsbx($item['MEASURE_NAME'])?>
																				</td>
																			</tr>
																			<?
																		}
																	?>
																	</tbody>
																</table>
															</div>

														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
									<?
								}
								?>

							</div>
						</div>
						<?
					}
					?>

					<div class="row mb-3">
						<div class="col p-0">
							<h3 class="sale-order-detail-section-title"><?= Loc::getMessage('SPOD_ORDER_BASKET')?></h3>

							<div class="row mx-0">
								<div class="col">
									<div class="table-responsive">
										<table class="table">
											<thead>
											<tr>
												<th scope="col"></th>
												<th scope="col"><?= Loc::getMessage('SPOD_NAME')?></th>
												<th scope="col"><?= Loc::getMessage('SPOD_PRICE')?></th>
												<?
												if($arResult["SHOW_DISCOUNT_TAB"] <> '')
												{
													?>
													<th scope="col"><?= Loc::getMessage('SPOD_DISCOUNT') ?></th>
													<?
												}
												?>
												<th scope="col"><?= Loc::getMessage('SPOD_QUANTITY')?></th>
												<th scope="col">Заполните анкету</th>
												<th class="text-right"><?= Loc::getMessage('SPOD_ORDER_PRICE')?></th>
											</tr>
											</thead>
											<tbody>
											<?
											foreach ($arResult['BASKET'] as $basketItem)
											{
												?>
												<tr>
													<td class="sale-order-detail-order-item-img-block">
														<a href="<?=$basketItem['DETAIL_PAGE_URL']?>">
															<?
															if($basketItem['PICTURE']['SRC'] <> '')
															{
																$imageSrc = $basketItem['PICTURE']['SRC'];
															}
															else
															{
																$imageSrc = $this->GetFolder().'/images/no_photo.png';
															}
															?>
															<div class="sale-order-detail-order-item-img-container" style="background-image: url(<?=$imageSrc?>);"></div>
														</a>
													</td>
													<td class="sale-order-detail-order-item-properties" style="min-width: 250px;">
														<a class="sale-order-detail-order-item-title"
														   href="<?=$basketItem['DETAIL_PAGE_URL']?>"><?=htmlspecialcharsbx($basketItem['NAME'])?></a>
														<? if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS']))
														{
															foreach ($basketItem['PROPS'] as $itemProps)
															{
																?>
																<div class="sale-order-detail-order-item-properties-type"><?=htmlspecialcharsbx($itemProps['VALUE'])?></div>
																<?
															}
														}
														?>
													</td>
													<td class="sale-order-detail-order-item-properties">
														<span class="bx-price"><?=$basketItem['BASE_PRICE_FORMATED']?></span>
													</td>
													<?
													if($basketItem["DISCOUNT_PRICE_PERCENT_FORMATED"] <> '')
													{
														?>
														<td class="sale-order-detail-order-item-properties text-right">
															<?= $basketItem['DISCOUNT_PRICE_PERCENT_FORMATED'] ?>
														</td>
														<?
													}
													elseif(mb_strlen($arResult["SHOW_DISCOUNT_TAB"]))
													{
														?>
														<td class="sale-order-detail-order-item-properties text-right">
															<strong class="bx-price"></strong>
														</td>
														<?
													}
													?>
													<td class="sale-order-detail-order-item-properties">
														<?=$basketItem['QUANTITY']?>&nbsp;
														<?
														if($basketItem['MEASURE_NAME'] <> '')
														{
															echo htmlspecialcharsbx($basketItem['MEASURE_NAME']);
														}
														else
														{
															echo Loc::getMessage('SPOD_DEFAULT_MEASURE');
														}
														?>
													</td>
													<td>	
<?$user = $USER->GetID();
//print_r($basketItem['PRODUCT_ID']);
?>


<?


/*Запрос 1.
service.gotdoc.ru/api/?class=Market&action=getPrivateId
Параметры: 
setId – публичный uuid комплекта
customerId – uuid покупателя магазина на битриксе
orderId – номер заказа в магазине битрикса
Ответ:
{
    “uuid”: “приватный_ключ”
}*/





$connection = Bitrix\Main\Application::getConnection();
$query = "SELECT `PRODUCT_ID`, `XML_ID`, `privateUUID`, `FUSER_ID`, `ORDER_ID` FROM `b_sale_basket` WHERE `ORDER_ID` = '".$arResult['ID']."' AND `PRODUCT_ID` = '".$basketItem['PRODUCT_ID']."'";
$result = $connection->query($query);
while($ar=$result->fetch())
{
if($ar['privateUUID']){
	$response12 = $ar['privateUUID'];	
	//echo 'привытный ключ определен '.$response12;
} else {
	//$connection->queryExecute("UPDATE `b_sale_basket` SET  privateUUID='".$response11."' WHERE `ORDER_ID` = '".$arResult['ID']."' AND `PRODUCT_ID` = '".$basketItem['PRODUCT_ID']."' ");
}
}

?>
<?
$arSelect = Array("ID", "IBLOCK_ID", "NAME","PROPERTY_IDENTIFIER");
$arFilter = Array("ID"=>$basketItem['PRODUCT_ID']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
if($ob = $res->GetNextElement()){ 
		$arFields = $ob->GetFields(); 
		$identificator = $arFields['PROPERTY_IDENTIFIER_VALUE'];
		
	}
	//$identificator = "12345";



?>

<script>
	jQuery(document).ready(function(){
	  jQuery("#post_to_url1").click(function(){ 
			var identificator = <?php echo CUtil::PHPToJSObject($identificator);?>;
			$.ajax({
				url: "/bitrix/templates/new-gotdoc/components/bitrix/sale.personal.order.detail/bootstrap_v4/ajax1.php",
				data: {"orderId": <?=$arResult['ID']?>, "product_id":  <?=$basketItem['PRODUCT_ID']?>,  "customerId":  <?=$USER->GetID();?>, "setId":identificator},			
				method: "POST", 
				dataType: "json" ,
				success: function(data){
					data = JSON.parse(data);
					console.log(data); // Возвращаемые данные выводим в консоль						
					if(data.link){
						window.location.href= data.link;
					}
				},
			});
		});
		});	
</script>
<?

/*Запрос 2.*/
/*$httpClient2 = new HttpClient(array($options = null));
$httpClient2->setHeader('Content-Type', 'application/json', true);
$url2 = "https://service.gotdoc.ru/api/?class=Market&action=getSingleUseSetLink";
$data2 = json_encode(array("privateUUID" => $response12));
$response2 = $httpClient2->post($url2, $data2);
$response2 = json_decode($response2, true);
*/?>


<?/*Запрос 3.*/?>

<?
$httpClient3 = new HttpClient(array($options = null));
$httpClient3->setHeader('Content-Type', 'application/json', true);
$url3 = "https://service.gotdoc.ru/api/?class=Market&action=isQuestionnaireComplete";
$data3 = json_encode(array("privateUUID" => $response12));
$response3 = $httpClient3->post($url3, $data3);
$response3 = json_decode($response3, true);
//print_r($response12);
?>


<?/*Запрос 4.*/?>
<script>
	jQuery(document).ready(function(){
	  jQuery("#post_to_url4").one("click", function(){ 
		var response1js = <?php echo CUtil::PHPToJSObject($response12);?>;
			$.ajax({
				url: "/bitrix/templates/new-gotdoc/components/bitrix/sale.personal.order.detail/bootstrap_v4/ajax.php",
				//data: { "privateUUID": response1js,},
				data: {"orderId": <?=$arResult['ID']?>, "product_id":  <?=$basketItem['PRODUCT_ID']?>},			
				method: "POST", 
				dataType: "json" ,
				success: function(data){
					data = JSON.parse(data);
					console.log(data); // Возвращаемые данные выводим в консоль	
					let select = document.createElement('ul');
					for (i=0; i<=data.docs.length-1; i++) {
						obj2 =  data.docs[i];
						let option = document.createElement('li');
						option.innerText = obj2;
						select.appendChild(option);
					}
					document.getElementById('current').appendChild(select);						
				},
			})
		});
		});	
</script>



<?/*Запрос 5*/?>
<script>
	jQuery(document).ready(function(){
	  jQuery("#post_to_url5").click(function(){ 
		var response1js = <?php echo CUtil::PHPToJSObject($response12);?>;
			$.ajax({
				url: "/bitrix/templates/new-gotdoc/components/bitrix/sale.personal.order.detail/bootstrap_v4/ajax2.php",
				data: {"orderId": <?=$arResult['ID']?>, "product_id":  <?=$basketItem['PRODUCT_ID']?>},			
				method: "POST", 
				dataType: 'binary',
				xhrFields: {
					'responseType': 'blob'
				},
				success: function(data, xhr){
					console.log('Успех');
					const file = data;						
					const blob = new Blob([file]);	
					const downloadUrl = URL.createObjectURL(blob);
					const a = document.createElement("a");
					a.href = downloadUrl;
					a.download = "file.zip";					
					document.body.appendChild(a);
					a.click();					
				},
				error: function(err){
					console.log('ОШИБКА AJAX запроса');

					const file = err.responseText;						
					const blob = new Blob([file]);	
					const downloadUrl = URL.createObjectURL(blob);
					const a = document.createElement("a");
					a.href = downloadUrl;
					a.download = "file.zip";					
					document.body.appendChild(a);
					a.click();		
				}
			})
	  });
	});	
</script>


<?
if($response3['result']){?>
<a class="btn btn-secondary" style="margin:5px;" onclick="alert('<div class=\'alertm_text\'>Анкета уже заполнена</div>',''); return false;">Анкета заполнена</a>
<?} else {?>
<a class="btn btn-primary"  style="margin:5px;" id="post_to_url1">Заполнить анкету</a>
<?} ?>
<div style="display:flex;">
<?if($response3['result']){?>
<a class="btn btn-success" style="margin:5px;"  id="post_to_url4">Список документов</a>
<?} else {?>
<a class="btn btn-secondary" style="margin:5px;" onclick="alert('<div class=\'alertm_text\'>Заполните анкету</div>',''); return false;">Список документов</a>
<?} ?>
<?if($response3['result'] && $payment['PAID'] === 'Y'){?>
<a class="btn btn-danger" style="margin:5px;"  id="post_to_url5">Получить документы</a>
<?} else {?>
<a class="btn btn-secondary" style="margin:5px;" onclick="alert('<div class=\'alertm_text\'>Заполните анкету и оплатите</div>',''); return false;">Получить документы</a>
<?} ?>
</div>
<?//} else {?>

<?//} ?>
<div id="current"></div>
<div id="current2"></div>

<script>
function alert(content,afterFunction){
$('<div class="alertm_overlay"></div>').appendTo('body');
$('<div class="alertm_all"><a href="#" onclick="alert_close('+afterFunction+'); return false" class="alertm_close">x</a><div class="alertm_wrapper">'+content+'</div><div class="alertm_but" onclick="alert_close('+afterFunction+'); return false">OK</div></div>').appendTo('body');
$(".alertm_overlay, .alertm_all").fadeIn("slow");
$('.alertm_all').css('margin-top', (-1)*($('.alertm_all').height())+'px');
}
function alert_close(afterFunctionClouse){
$(".alertm_overlay, .alertm_all").remove();
afterFunctionClouse;
}

</script>


<style>
.alertm_overlay {    width:100%;    height:100%;    position:fixed;    left:0px;    top:0px;    z-index:99998;    background:rgba(51, 51, 51, 0.82);   display:none;}
.alertm_all {font-family: Arial;    width:396px;    padding:29px 43px;    border-radius: .25rem;  background:#fff;    position:fixed;    left:50%;    margin-left:-241px;    top:50%;    z-index:99999;    }
.alertm_all a {    -webkit-transition: all .2s ease-in-out;    -o-transition: all .2s ease-in-out;    transition: all .2s ease-in-out;    text-decoration: none;    color: #0275d8;}
.alertm_all a:hover {    color: #222;}
.alertm_h1 {    color: #0275d8;    font-size: 19px;    margin-bottom: 15px;}
.alertm_text {    font-size: 16px;    line-height: 23px;}
.alertm_wrapper { }
.alertm_but {    display: inline-block;    font-weight: 400;    line-height: 1.25;    text-align: center;    white-space: nowrap;    vertical-align: middle;    -webkit-user-select: none;    -moz-user-select: none;    -ms-user-select: none;    user-select: none;    border: 1px solid transparent;    padding: .5rem 2rem;    font-size: 1rem;    border-radius: .25rem;    -webkit-transition: all .2s ease-in-out;    -o-transition: all .2s ease-in-out;    transition: all .2s ease-in-out;    color: #fff;    background-color: #0275d8;    border-color: #0275d8;    display: block;    margin-top: 25px;    cursor: pointer;}
.alertm_but:hover {    color: #fff;    background-color: #025aa5;    border-color: #01549b;}
a.alertm_close {    color: red;    text-decoration: none;    position: absolute;    right: 7px;    top: 0px;    font-size: 25px;}
</style>
</td>
													<td class="sale-order-detail-order-item-properties text-right">
														<strong class="bx-price"><?=$basketItem['FORMATED_SUM']?></strong>
													</td>
												</tr>
												<?
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>
					</div>


					<div class="row sale-order-detail-total-payment">
						<div class="col sale-order-detail-total-payment-container">
							<div class="row">
								<ul class="col-md-8 col sale-order-detail-total-payment-list-left">
									<? if (floatval($arResult["ORDER_WEIGHT"])) { ?>
										<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_TOTAL_WEIGHT')?>:</li>
									<? }

									if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED'])) {
									?>
										<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_COMMON_SUM')?>:</li>
									<? }

									if($arResult["PRICE_DELIVERY_FORMATED"] <> '')
									{
										?>
										<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_DELIVERY') ?>
											:
										</li>
									<? }

									if ((float)$arResult["TAX_VALUE"] > 0) {
									?>
										<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_TAX') ?>:</li>
									<? } ?>
									<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_SUMMARY')?>:</li>
								</ul>
								<ul class="col-md-4 col sale-order-detail-total-payment-list-right">
									<?
									if (floatval($arResult["ORDER_WEIGHT"])) { ?>
										<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult['ORDER_WEIGHT_FORMATED'] ?></li>
									<? }

									if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED'])) { ?>
										<li class="sale-order-detail-total-payment-list-right-item"><?=$arResult['PRODUCT_SUM_FORMATED']?></li>
									<? }

									if($arResult["PRICE_DELIVERY_FORMATED"] <> '')
									{ ?>
										<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult["PRICE_DELIVERY_FORMATED"] ?></li>
									<? }

									if ((float)$arResult["TAX_VALUE"] > 0) { ?>
										<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult["TAX_VALUE_FORMATED"] ?></li>
									<? } ?>
									<li class="sale-order-detail-total-payment-list-right-item"><?=$arResult['PRICE_FORMATED']?></li>
								</ul>
							</div>
						</div>
					</div>
				</div><!--sale-order-detail-general-->
			</div>

			<?
				if ($arParams['GUEST_MODE'] !== 'Y' && $arResult['LOCK_CHANGE_PAYSYSTEM'] !== 'Y')
			{
				?>
				<div class="row mb-3">
					<div class="col">
						<a href="<?= $arResult["URL_TO_LIST"] ?>">&larr; <?= Loc::getMessage('SPOD_RETURN_LIST_ORDERS')?></a>
					</div>
				</div>
				<?
			}
			?>
		</div>
	</div>
	<?
	$javascriptParams = array(
		"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
		"templateFolder" => CUtil::JSEscape($templateFolder),
		"templateName" => $this->__component->GetTemplateName(),
		"paymentList" => $paymentData,
		"returnUrl" => $arResult['RETURN_URL'],
	);
	$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
	?>
	<script>
		BX.Sale.PersonalOrderComponent.PersonalOrderDetail.init(<?=$javascriptParams?>);
	</script>
<?
}
use Bitrix\Sale;
$order = Sale\Order::load(413);
$propertyCollection = $order->getPropertyCollection();
$somePropValue = $propertyCollection->getItemByOrderPropertyId(21);
$receiver = $somePropValue->getValue();
//print_r($receiver);

?>

