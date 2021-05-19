<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
if(isset($_REQUEST[ 'id' ])) $ID = (int)$_REQUEST[ 'id' ];
$arr = getElementsList($ID, 50 , 2);

 ?>
								<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
								
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
									<div class="main-image col-lg-12 no-padding">
										
										<div class="product-largeimg-link">
											<?if($arr['GALLERY'][0]['BIG']['src']){?>
											<img src="<?= $arr['GALLERY'][0]['BIG']['src'] ?>" class="img-responsive product-largeimg" alt>
											<?}else{?>
												<i class="fa fa-camera"></i>
											<?}?>
										</div>
									</div>
									
									<?if (is_array($arr['GALLERY'])){?>
										<div class="modal-product-thumb">
										<?foreach($arr['GALLERY'] as $key => $item){?>
											<?if($key==0){?>
												<?if($item['BIG']['src']){?>
												<a class="thumbLink selected">
													<img data-large="<?=$item['BIG']['src']?>" alt class="img-responsive" src="<?=$item['SMALL']['src']?>">
												</a>
												<?}?>
											<?} else{?>
												<a class="thumbLink">
												<img data-large="<?=$item['BIG']['src']?>" alt class="img-responsive" src="<?=$item['SMALL']['src']?>">
											</a>
											<?}?>
										<?}?>	
										</div>
									<?}?>
									
								</div>


								<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 modal-details no-padding">
									<div class="modal-details-inner">
										<h1 class="product-title"><? echo $arr['FIELDS']['NAME']; ?></h1>

										<?if($arr['PROPERTIES']['ARTNUMBER']['VALUE']){?><h3 class="product-code">Артикул: <? echo $arr['PROPERTIES']['ARTNUMBER']['VALUE'] ?></h3><?}?>
										
										<?if($arr["PROPERTIES"]['PRICE']['VALUE']||$arr["PROPERTIES"]['OLD_PRICE']['VALUE']){?>
										<div class="product-price">
											<?if($arr["PROPERTIES"]['PRICE']['VALUE']){?>
												<span class="price-sales">
													<?= $arr["PROPERTIES"]['PRICE']['VALUE']; ?><?if($arr["PROPERTIES"]['PRICECURRENCY']['VALUE']=='руб.') echo '<i class="fa fa-rub" aria-hidden="true"></i>'; else echo $arr["PROPERTIES"]['PRICECURRENCY']['VALUE']?>
												</span><?}?>
											<?if($arr["PROPERTIES"]['OLD_PRICE']['VALUE']){?>	
												<span class="price-standard"><?= $arr['PROPERTIES']['OLD_PRICE']['VALUE']; ?>
												<?if($arr["PROPERTIES"]['PRICECURRENCY']['VALUE']=='руб.') echo '<i class="fa fa-rub" aria-hidden="true"></i>'; else echo $arr["PROPERTIES"]['PRICECURRENCY']['VALUE']?>
												</span>
											<?}?>
											<?if($arr['PROPERTIES']['UNITS']['VALUE']){?>
												<small>&nbsp;за&nbsp;<?=$arr['PROPERTIES']['UNITS']['VALUE'];?></small>
											<?}?>
										</div>
										<?}?>
										
										<?if($arr['FIELDS']['PREVIEW_TEXT']){?>
										<div class="details-description">
											<p><? echo $arr['FIELDS']['PREVIEW_TEXT']; ?></p>
										</div>
										<?}?>
										
										<?if(is_array($arr["PROPERTIES"]['COLOR']['VALUE'])){?>
										<div class="color-details">
											<span class="selected-color text-uppercase"><strong>Цвет</strong></span>
											<ul class="swatches Color">
												<?foreach($arr['PROPERTIES']['COLOR']['VALUE_XML_ID'] as $color => $Item){?>
												
												<li class="<?if($color==0){?>selected<?}?>">
													<a style="background-color:<?=$Item?>"> </a>
												</li>
												<?}?>
											</ul>
										</div>
										<?}?>
										
										<?if(($arr['PROPERTIES']['SELECT_COUNT']['VALUE'] == 'Y')||(($arr["PROPERTIES"]['SELECT_SIZE']['VALUE'] == 'Y')&&is_array($arr['PROPERTIES']['SIZE']['VALUE']))){?>
										<div class="productFilter productFilterLook2">
											<div class="row">
												<?if($arr['PROPERTIES']['SELECT_COUNT']['VALUE'] == 'Y'){?>
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
												
												<?if($arr['PROPERTIES']['SELECT_SIZE']['VALUE'] == 'Y'){?>
												<div class="col-lg-6 col-sm-6 col-xs-6">
													
													<?if(is_array($arr['PROPERTIES']['SIZE']['VALUE'])){?>
													<div class="filterBox">
														<select name="size" class="form-control">
															<option value="" selected>Размер</option>
															<?foreach($arr['PROPERTIES']['SIZE']['VALUE'] as $Stem){?>
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
													<a href="<?=$arr['FIELDS']['DETAIL_PAGE_URL'];?>" class="btn btn-lg btn-color">
														Подробнее
													</a>
												</div>
												<div class="col-lg-6"><button onclick="addBascetSection(<?= $arr['FIELDS']['ID'] ?>)" class="btn btn-default">Добавить в корзину</button>
												</div>
											</div>
											<div class="row">
												<div class="success text-center"></div>
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
<script src="<?= SITE_TEMPLATE_PATH ?>/js/home.js"></script>						
<?unset($arr);?>			