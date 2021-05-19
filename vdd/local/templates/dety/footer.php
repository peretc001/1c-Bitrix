<footer>
    <div class="container">
        <div class="email-form">
            <div class="email-form-block">
                <div class="email-form-block__title">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/email-form/email.svg" alt=" Узнавайте о выгодных  предложениях первыми!">
                    <p>Узнавайте о выгодных предложениях первыми!</p>
                </div>
                <?$APPLICATION->IncludeComponent("bitrix:main.feedback", ".default", Array(
                    "COMPONENT_TEMPLATE" => "",
                        "USE_CAPTCHA" => "N",	// Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
                        "OK_TEXT" => "Спасибо, подписка оформленна!",	// Сообщение, выводимое пользователю после отправки
                        "EMAIL_TO" => "#EMAIL_TO#",	// E-mail, на который будет отправлено письмо
                        "REQUIRED_FIELDS" => array(	// Обязательные поля для заполнения
                            0 => "EMAIL",
                        ),
                        "EVENT_MESSAGE_ID" => array(	// Почтовые шаблоны для отправки письма
                            0 => "84",
                        )
                    ),
                    false
                );?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <p><b>ВсёДляДеток.ру</b></p>
                <ul>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "1",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                    false
                    );?>
                </ul>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <p><b>Покупателям</b></p>
                <ul>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "bottom2",
                            "USE_EXT" => "N"
                        )
                    );?>
                </ul>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <p><b>Обратная связь</b></p>
                <ul>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "bottom3",
                            "USE_EXT" => "N"
                        )
                    );?>
                </ul>
            </div>
            <div class="col-sm-6 col-md-4 offset-md-4 col-lg-3 offset-lg-0">
                <p><b>Сообщество </b></p>
                <p>Мы в социальных сетях</p>
                <div class="social">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR."include/social.php"),
                        false
                    );?>
                </div>
            </div>
        </div>

        <div class="copyright">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/copyright.php"),
                false
            );?>
        </div>
    </div>
</footer>
</main>

<div class="mobile-left-menu">
    <?
    GLOBAL $USER;
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
    if (isset($arUser['NAME'])):?>
    <a href="/personal/" class="button lk">
        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/nav/lk.svg" alt="">
        <?=$arUser['NAME']?$arUser['NAME']:'Гость'?></a>
    <a href="" class="button login hidden" data-mobile="yes" data-toggle="modal" data-target="login">
        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/nav/login.svg" alt="">
        Вход</a>
    <?php else: ?>
    <a href="" class="button login" data-mobile="yes" data-toggle="modal" data-target="login">
        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/nav/login.svg" alt="">
        Вход</a>
    <a href="/personal/" class="button lk hidden">
        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/nav/lk.svg" alt="">
        <span><?=$arUser['LOGIN']?$arUser['LOGIN']:'Гость'?></span></a>
    <?php endif ?>
    <a href="" class="button city" data-mobile="yes" data-toggle="modal" data-target="city">
        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/nav/location.svg" alt="">
        <? global $city; echo $city ?></a>
    <a href="tel:8-800-600-77-27" class="button phone">
        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/nav/phone.svg" alt="">
        8-800-600-77-27</a>
    <div class="menu-item">
        <p class="hideElem active">
            <b>ВсёДляДеток</b>
        </p>
        <ul class="showElem active">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "bottom",
                    "USE_EXT" => "N"
                )
            );?>
        </ul>
    </div>
    <div class="menu-item">
        <p class="hideElem active">
            <b>
                Покупателям
            </b>
        </p>
        <ul class="showElem active">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "bottom2",
                    "USE_EXT" => "N"
                )
            );?>
        </ul>
    </div>
    <div class="menu-item">
        <p class="hideElem active">
            <b>
                Обратная связь
            </b>
        </p>
        <ul class="showElem active">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "bottom3",
                    "USE_EXT" => "N"
                )
            );?>
        </ul>
    </div>
    <div class="social">
        <p>
            <b>
                Сообщество
            </b>
        </p>
        <div class="social-link">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/social.php"),
                false
            );?>
        </div>
    </div>
    <div class="menu-email">
        <p>
            <b>
                Подпишись на обновления
            </b>
        </p>
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.feedback",
            "",
            array(
                "COMPONENT_TEMPLATE" => "",
                "USE_CAPTCHA" => "N",
                "OK_TEXT" => "Спасибо, подписка оформленна!",
                "EMAIL_TO" => "#EMAIL_TO#",
                "REQUIRED_FIELDS" => array(
                    0 => "EMAIL",
                ),
                "EVENT_MESSAGE_ID" => array(
                    0 => "84",
                )
            ),
            false
        );?>
    </div>
</div>

<div class="modal">
    <div class="container">
        <!-- Modal City -->
        <div class="modal-body city" data-modal="city">
            <span class="close" data-close="close"></span>
            <div class="city-wrapper fade active">
                <p class="modal-body__head">Ваш город:</p>
                <p class="modal-body__city"> <?=$city?></p>
                <p class="modal-body__desc">От города зависят условия доставки</p>
                <div class="modal-body__button">
                    <button class="btn btn-accent" data-close="close" data-set-city="<?=$city?>">Да</button>
                    <button class="btn btn-outline-accent open-city-list">Нет, выбрать другой</button>
                </div>
            </div>
            <form action="/" method="post" class="city-list">
                <label for="city">Введите название</label>
                <input id="city" type="text" name="city" class="city" placeholder="Ваш город">
                <div class="city-list--result"></div>
            </form>
        </div>
        <!-- Modal Login -->
        <div class="modal-body login" data-modal="login">
            <h3>Вход или регистрация</h3>
            <form action="/" method="post" class="login-form">
                <label for="phone">Введите свой номер телефона</label>
                <input type="tel" id="phone" name="phone" class="phone-mask" required>
                <button type="submit" class="btn btn-accent js-phone-send" disabled>Получить код проверки</button>
                <p class="js-phone"></p>
                <div class="login-repeat hidden">
                    <button type="submit" class="btn btn-yellow replay-code" disabled>Запросить повторно</button>
                    <p class="replay-sms">
                        Подвторный запрос будет доступен через <span class="timer">60</span> секунд
                    </p>
                </div>
            </form>
            <form action="/" method="post" class="sms-form">
                <p>Введите код проверки</p>
                <div class="signin-sms__wrap">
                    <div class="sms-item"><input class="sms-input" type="tel" maxlength="1" tabindex="1" autocomplete="off"></div>
                    <div class="sms-item"><input class="sms-input" type="tel" maxlength="1" tabindex="2" autocomplete="off"></div>
                    <div class="sms-item"><input class="sms-input" type="tel" maxlength="1" tabindex="3" autocomplete="off"></div>
                    <div class="sms-item"><input class="sms-input" type="tel" maxlength="1" tabindex="4" autocomplete="off"></div>
                </div>
            </form>
            <div class="complete"><p>Готово</p></div>
        </div>
        <?if($oneClickBtn):?>
            <!-- IF PRODUCT-PAGE -->
            <!-- Modal REVIEW -->
            <div class="modal-body review" data-modal="review">
                <span class="close" data-close="close"></span>
                <p><b>Добавить отзыв о товаре</b></p>
                <form action="/" method="post" enctype="multipart/form-data" class="review_form">
                    <div class="form-row df">
                        <div>
                            <label for="user-review">Ваше имя</label>
                            <input type="text" id="user-review" name="user" placeholder=""  maxlength="50">
<!--                            pattern="^[А-Яа-яЁё\s]+$"-->
                        </div>
                        <div class="form-col">
                            <p>Оцените товар</p>
                            <div class="rating-area">
                                <input type="radio" id="star-5" name="rating" value="5" checked>
                                <label for="star-5" title="Оценка «5»"></label>
                                <input type="radio" id="star-4" name="rating" value="4">
                                <label for="star-4" title="Оценка «4»"></label>
                                <input type="radio" id="star-3" name="rating" value="3">
                                <label for="star-3" title="Оценка «3»"></label>
                                <input type="radio" id="star-2" name="rating" value="2">
                                <label for="star-2" title="Оценка «2»"></label>
                                <input type="radio" id="star-1" name="rating" value="1">
                                <label for="star-1" title="Оценка «1»"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="advantage">Понравилось</label>
                        <textarea name="advantage" id="advantage" maxlength="300"></textarea>
                    </div>
                    <div class="form-row">
                        <label for="disadvantage">Не понравилось</label>
                        <textarea name="disadvantage" id="disadvantage" maxlength="300"></textarea>
                    </div>
                    <div class="form-row">
                        <label for="review_comment">Комментарий</label>
                        <textarea name="review_comment" id="review_comment" maxlength="300"></textarea>
                    </div>
                    <div class="input__wrapper">
                        <input type="file" name="files[]" id="input__file" class="input input__file" multiple accept=".jpg, .jpeg, .png">
                        <label for="input__file" class="input__file-button">
                            <span class="input__file-icon-wrapper">Прикрепить файл</span>
                            <span class="input__file-button-text">Файл не выбран</span>
                        </label>
                    </div>
                    <div class="submit">
                        <button type="submit" class="btn btn-accent">Отправить</button>
                        <p>Нажимая кнопку вы даете согласие на обработку ваших персональных данных в соответствии с Условиями</p>
                    </div>
                </form>
            </div>
            <!-- Modal QUESTION -->
            <div class="modal-body question" data-modal="question">
                <span class="close" data-close="close"></span>
                <p><b>Задать вопрос о товаре</b></p>
                <form action="/" method="post">
                    <div class="form-row df">
                        <div>
                            <label for="user-question">Ваше имя</label>
                            <input type="text" id="user-question" name="user" placeholder="" required>
                        </div>
                        <div class="form-col">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="msg-question">Ваш вопрос</label>
                        <textarea name="msg" id="msg-question"></textarea>
                    </div>
                    <div class="submit">
                        <button type="submit" class="btn btn-accent">Отправить</button>
                        <p>Нажимая кнопку вы даете согласие на обработку ваших персональных данных в соответствии с Условиями</p>
                    </div>
                </form>
            </div>
            <!-- Modal OneClick -->
            <div class="modal-body oneclick" data-modal="oneclick">
                <span class="close" data-close="close"></span>
                <p><b>Заказ в один клик</b></p>
                <span class="product"></span>
                <form action="/" method="post">
                    <div class="form-row">
                        <label for="user-oneclick">Ваш имя</label>
                        <input type="text" name="user-oneclick" id="user-oneclick" class="name" placeholder="" pattern="^[А-Яа-яЁё\s]+$" required>
                    </div>
                    <div class="form-row">
                        <label for="userphone">Телефон</label>
                        <input type="tel" id="userphone" name="phone-oneclick" class="phone-mask" required>
                    </div>
                    <div class="submit">
                        <button type="submit" class="btn btn-accent">Отправить</button>
                    </div>
                </form>
            </div>
            <!-- Modal Size Table -->
            <div class="modal-body size" data-modal="size">
                <span class="close" data-close="close"></span>
                <div class="size-table">
                    <p class="caption">Таблица размеров</p>
                    <p class="desc">Одежда для девочек и мальчиков</p>
                    <div class="size-table--head">
                        <div class="size-table--left">
                            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/products/card/size-table.png" alt="">
                        </div>
                        <ul class="size-table--right">
                            <li>Обхват груди: <span>по выступающим точкам груди</span></li>
                            <li>Обхват талии: <span>по самой узкой части талии</span></li>
                            <li>Обхват бедер: <span>по выступающим точкам бедер</span></li>
                        </ul>
                    </div>
                    <div class="size-table--wrap clothes">
                        <table>
                            <thead>
                            <tr>
                                <td>Размер</td>
                                <td>Возраст</td>
                                <td>Рост, см</td>
                                <td>Грудь, см</td>
                                <td>Талия, см</td>
                                <td>Бёдра, см</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>98</td>
                                <td>2-3 года</td>
                                <td>92-98</td>
                                <td>55</td>
                                <td>52</td>
                                <td>57</td>
                            </tr>
                            <tr>
                                <td>104</td>
                                <td>4 года</td>
                                <td>98-104</td>
                                <td>55</td>
                                <td>53</td>
                                <td>58</td>
                            </tr>
                            <tr>
                                <td>110</td>
                                <td>4,5 года</td>
                                <td>104-110</td>
                                <td>57</td>
                                <td>54</td>
                                <td>59</td>
                            </tr>
                            <tr>
                                <td>116</td>
                                <td>5 лет</td>
                                <td>110-116</td>
                                <td>59</td>
                                <td>55</td>
                                <td>61</td>
                            </tr>
                            <tr>
                                <td>122</td>
                                <td>6 лет</td>
                                <td>116-122</td>
                                <td>62</td>
                                <td>57</td>
                                <td>64</td>
                            </tr>
                            <tr>
                                <td>128</td>
                                <td>7 лет</td>
                                <td>122-128</td>
                                <td>65</td>
                                <td>59</td>
                                <td>67</td>
                            </tr>
                            <tr>
                                <td>134</td>
                                <td>8 лет</td>
                                <td>128-134</td>
                                <td>68</td>
                                <td>61</td>
                                <td>70</td>
                            </tr>
                            <tr>
                                <td>140</td>
                                <td>9 лет</td>
                                <td>134-140</td>
                                <td>71</td>
                                <td>63</td>
                                <td>73</td>
                            </tr>
                            <tr>
                                <td>146</td>
                                <td>10 лет</td>
                                <td>140-146</td>
                                <td>74</td>
                                <td>65</td>
                                <td>76</td>
                            </tr>
                            <tr>
                                <td>152</td>
                                <td>11 лет</td>
                                <td>146-152</td>
                                <td>79</td>
                                <td>68</td>
                                <td>81</td>
                            </tr>
                            <tr>
                                <td>158-164</td>
                                <td>12 лет</td>
                                <td>158-164</td>
                                <td>82-84</td>
                                <td>70-72</td>
                                <td>83-86</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- <p class="caption">Таблица размеров</p>
                    <p class="desc">Обувь для девочек и мальчиков</p>
                    <div class="size-table--wrap shoes">
                      <table>
                        <thead>
                          <tr>
                            <td>Размер</td>
                            <td>Возраст</td>
                            <td>Длина стопы, см</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>17</td>
                            <td>0-1</td>
                            <td>10,5</td>
                          </tr>
                          <tr>
                            <td>18</td>
                            <td>0-1</td>
                            <td>11</td>
                          </tr>
                          <tr>
                            <td>19</td>
                            <td>0-1</td>
                            <td>11,5</td>
                          </tr>
                          <tr>
                            <td>20</td>
                            <td>1-2</td>
                            <td>12,5</td>
                          </tr>
                          <tr>
                            <td>21</td>
                            <td>1-2</td>
                            <td>13</td>
                          </tr>
                          <tr>
                            <td>22</td>
                            <td>1-2</td>
                            <td>13,5</td>
                          </tr>
                          <tr>
                            <td>23</td>
                            <td>2-3</td>
                            <td>14,5</td>
                          </tr>
                          <tr>
                            <td>24</td>
                            <td>2-3</td>
                            <td>15</td>
                          </tr>
                          <tr>
                            <td>25</td>
                            <td>3-4</td>
                            <td>15,5</td>
                          </tr>
                          <tr>
                            <td>25,5</td>
                            <td>3-4</td>
                            <td>16</td>
                          </tr>
                          <tr>
                            <td>26</td>
                            <td>3-4</td>
                            <td>16,5</td>
                          </tr>
                        </tbody>
                      </table>
                    </div> -->

                    <!-- <p class="caption">Таблица размеров</p>
                    <p class="desc">Перчатки и варежки</p>
                    <div class="size-table--wrap gloves">
                      <table>
                        <thead>
                          <tr>
                            <td>Размер</td>
                            <td>Возраст</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>11</td>
                            <td>0-12 мес.</td>
                          </tr>
                          <tr>
                            <td>12</td>
                            <td>12-24 мес.</td>
                          </tr>
                          <tr>
                            <td>14</td>
                            <td>2-4 года</td>
                          </tr>
                          <tr>
                            <td>15</td>
                            <td>4-6 лет</td>
                          </tr>
                          <tr>
                            <td>16</td>
                            <td>7-10 лет</td>
                          </tr>
                          <tr>
                            <td>18</td>
                            <td>10-12 лет</td>
                          </tr>
                        </tbody>
                      </table>
                    </div> -->
                </div>
            </div>
        <?endif?>
        <?if($company):?>
        <div class="modal-body company" data-modal="company">
            <span class="close" data-close="close"></span>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/company-card.php"),
                false
            );?>
        </div>
        <?endif?>
        <!-- Modal Promocod -->
        <div class="modal-body code" data-modal="code">
            <span class="close" data-close="close"></span>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/modal/promocode.php"),
                false
            );?>
        </div>
        <!-- Modal Bonus -->
        <div class="modal-body code" data-modal="bonus">
            <span class="close" data-close="close"></span>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/modal/bonus.php"),
                false
            );?>
        </div>
    </div>
</div>
</body>
</html>
