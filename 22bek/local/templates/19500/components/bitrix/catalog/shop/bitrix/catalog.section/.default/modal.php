
<div class="modal-dialog">
							<div class="modal-content">
								
								<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<div class="main-image col-lg-12 no-padding">
										<?php
											$file_modal = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 363, 'height' => 363), BX_RESIZE_IMAGE_PROPORTIONAL, true);
										?>
										
										<div class="product-largeimg-link">
											<img src="<? echo $file_modal['src']; ?>" class="img-responsive product-largeimg" alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>">
										</div>
									</div>
									<?if (is_array($arItem['GALLERY'])){?>
										<div class="modal-product-thumb">
										<?foreach($arItem['GALLERY'] as $key => $ar){?>
											<a class="thumbLink <?if ($key==0) echo 'selected'?>">
												<img data-large="<?=$ar['BIG']['src']; ?>" alt class="img-responsive" src="<?=$ar['SMALL']['src']; ?>">
											</a>
										<?}?>	
										</div>
									<?}?>
								</div>


								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 modal-details no-padding">
									<div class="modal-details-inner">
										<h1 class="product-title"><? echo $arItem['NAME']; ?></h1>

										<?if($arItem['PROPERTIES']['ARTNUMBER']['VALUE']){?><h3 class="product-code">Артикул: <? echo $arItem['PROPERTIES']['ARTNUMBER']['VALUE'] ?></h3><?}?>
										
										<?if($arItem["PROPERTIES"]['PRICE']['VALUE']||$arItem["PROPERTIES"]['OLD_PRICE']['VALUE']){?>
										<div class="product-price">
											<?if($arItem["PROPERTIES"]['PRICE']['VALUE']){?>
												<span class="price-sales">
													<?= $arItem["PROPERTIES"]['PRICE']['VALUE']; ?><?if($arItem["PROPERTIES"]['PRICECURRENCY']['VALUE']=='руб.') echo '<i class="fa fa-rub" aria-hidden="true"></i>'; else echo $arItem["PROPERTIES"]['PRICECURRENCY']['VALUE']?>
												</span><?}?>
											<?if($arItem["PROPERTIES"]['OLD_PRICE']['VALUE']){?>	
												<span class="price-standard"><?= $arItem['PROPERTIES']['OLD_PRICE']['VALUE']; ?>
												<?if($arItem["PROPERTIES"]['PRICECURRENCY']['VALUE']=='руб.') echo '<i class="fa fa-rub" aria-hidden="true"></i>'; else echo $arItem["PROPERTIES"]['PRICECURRENCY']['VALUE']?>
												</span>
											<?}?>
											<?if($arItem['PROPERTIES']['UNITS']['VALUE']){?>
												<small>&nbsp;за&nbsp;<?=$arItem['PROPERTIES']['UNITS']['VALUE'];?></small>
											<?}?>
										</div>
										<?}?>
										
										<?if($arItem['PREVIEW_TEXT']){?>
										<div class="details-description">
											<p><? echo $arItem['PREVIEW_TEXT']; ?></p>
										</div>
										<?}?>
										
										<?if(is_array($arItem["PROPERTIES"]['COLOR']['VALUE'])){?>
										<div class="color-details">
											<span class="selected-color text-uppercase"><strong>Цвет</strong></span>
											<ul class="swatches Color">
												<?foreach($arItem['PROPERTIES']['COLOR']['VALUE_XML_ID'] as $color => $Item){?>
												
												<li class="<?if($color==0){?>selected<?}?>">
													<a style="background-color:<?=$Item?>"> </a>
												</li>
												<?}?>
											</ul>
										</div>
										<?}?>
										
										<?if(($arItem['PROPERTIES']['SELECT_COUNT']['VALUE'] == 'Y')||($arItem["PROPERTIES"]['SELECT_SIZE']['VALUE'] == 'Y')){?>
										<div class="productFilter productFilterLook2">
											<div class="row">
												<?if($arItem['PROPERTIES']['SELECT_COUNT']['VALUE'] == 'Y'){?>
												<div class="col-lg-6 col-sm-6 col-xs-6">
													<div class="filterBox">
														<select name="quantity" class="form-control">
															<option value="0">Количество</option>
															<option value="1" selected>1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															
														</select>
													</div>
												</div>
												<?}?>
												
												<?if($arItem['PROPERTIES']['SELECT_SIZE']['VALUE'] == 'Y'){?>
												<div class="col-lg-6 col-sm-6 col-xs-6">
													
													<?if(is_array($arItem['PROPERTIES']['SIZE']['VALUE'])){?>
													<div class="filterBox">
														<select name="size" class="form-control">
															<option value="" selected>Размер</option>
															<?foreach($arItem['PROPERTIES']['SIZE']['VALUE'] as $Stem){?>
																<option value="<?=$Stem?>"><?=$Stem?></option>
															<?}?>
														</select>
														
													</div>
													<?}?>
												</div>
												<?}?>
											</div>
										</div>
										<?}?>
										
										<div class="cart-actions">
											<div class="addto row">
												<div class="col-lg-6">
													<button class="btn btn-lg btn-color" data-toggle="modal" data-target="#ModalOrderOneClick" type="button">
														Купить в один клик
													</button>
												</div>
												<div class="col-lg-6"><button onclick="addBascetSection(<?= $arItem['ID'] ?>)" class="btn btn-default">Добавить в корзину</button>
												</div>
											</div>
										</div>

										<div class="product-share clearfix">
											<p class="text-uppercase"><strong>Поделится</strong></p>
											<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" ></script>
											<script src="//yastatic.net/share2/share.js" async="async"></script>
											<div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir"></div>
										</div>
									</div>
									
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
				
			