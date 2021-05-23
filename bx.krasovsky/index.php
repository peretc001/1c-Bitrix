<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

//Only for front-page
CJSCore::Init(['jquery', 'fx']);
\Bitrix\Main\UI\Extension::load("ui.vue");

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/js/slick/slick.css');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/slick/slick.min.js');
Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/form.js');
?>
    <section class="slider">
        <div class="slider-wrapper">
            <a href="" class="slide-item">
                <div class="container">
                    <div class="item-content">
                        <span class="badge">анимация</span>
                        <h1>Подготовка спрайтов для анимации в Unity</h1>
                        <p class="description">Спрайты должны немного отличаться друг от друга, чтобы было заметно движение.</p>
                    </div>
                    <div class="item-thumbnail">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/slider/slide_1.jpg" loading="lazy" alt="Подготовка спрайтов для анимации в Unity">
                    </div>
                </div>
            </a>

            <a href="" class="slide-item">
                <div class="container">
                    <div class="item-content">
                        <span class="badge">анимация</span>
                        <h2>Подготовка спрайтов для анимации в Unity</h2>
                        <p class="description">Спрайты должны немного отличаться друг от друга, чтобы было заметно движение.</p>
                    </div>
                    <div class="item-thumbnail">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/slider/slide_2.jpg" loading="lazy" alt="Подготовка спрайтов для анимации в Unity">
                    </div>
                </div>
            </a>

            <a href="" class="slide-item">
                <div class="container">
                    <div class="item-content">
                        <span class="badge">анимация</span>
                        <h2>Подготовка спрайтов для анимации в Unity</h2>
                        <p class="description">Спрайты должны немного отличаться друг от друга, чтобы было заметно движение.</p>
                    </div>
                    <div class="item-thumbnail">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/slider/slide_3.jpg" loading="lazy" alt="Подготовка спрайтов для анимации в Unity">
                    </div>
                </div>
            </a>
        </div>

        <div class="slick-nav">
            <div class="slick-prev"></div>
            <div class="slick-next"></div>
        </div>
    </section>

    <section class="about">
        <div class="container flex-container">
            <div class="col-left">
                <h2><a href="">О компании</a></h2>
            </div>
            <div class="col-right">
                <p>Что-то более продвинутое делается с помощью покадровой анимации — когда для разных состояний объекта (стоит, идет, в прыжке, атакует) создается несколько спрайтов (двумерное изображение), которые сменяют друг друга с определенным интервалом.</p>

                <div class="button-wrapper">
                    <a href="" class="btn arrow">подробнее</a>
                </div>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <div class="news-header">
                <h3><a href="">Новости</a></h3>
                <a href="" class="all">Все новости</a>
            </div>

            <ol class="news-list">
                <li class="news-item col-1">
                    <a href="" class="news-content"><img src="<?=DEFAULT_TEMPLATE_PATH?>/img/slider/slide_1.jpg" loading="lazy" alt="Новость 1"></a>
                </li>
                <li class="news-item col-1">
                    <a href="" class="news-content"><img src="<?=DEFAULT_TEMPLATE_PATH?>/img/slider/slide_2.jpg" loading="lazy" alt="Новость 2"></a>
                </li>
                <li class="news-item col-2">
                    <a href="" class="news-content"><img src="<?=DEFAULT_TEMPLATE_PATH?>/img/slider/slide_3.jpg" loading="lazy" alt="Новость 3"></a>
                </li>
            </ol>

            <div class="clone-list"></div>

            <div class="button-wrapper">
                <div class="btn show-more">показать еще</div>
            </div>
        </div>
    </section>

    <section class="form">
        <div class="container">
            <div id="app">
                <form class="callback" :class="{ 'loading': !loading || this.sendForm }" @submit.prevent="send">
                    <h4>Подпишитесь на рассылку</h4>

                    <div class="form-group">
                        <div class="group-item half">
                            <div v-if="!notNumber" class="error-msg">Цифры в имени не допустимы</div>
                            <div v-if="!validName && !isCompleteName && notNumber" class="error-msg">Заполните поле</div>
                            <input type="text" v-model.trim="form.username" placeholder="Имя" :class="{ 'error': !isValidName || !validName || !notNumber, 'complete': isCompleteName && notNumber }">
                        </div>
                        <div class="group-item half">
                            <div v-if="!validEmail && !isCompleteEmail" class="error-msg">Заполните поле</div>
                            <input type="email" v-model="form.email" placeholder="example@mail.com" :class="{ 'error': !isValidEmail || !validEmail, 'complete': isCompleteEmail }">
                        </div>

                        <div class="group-item">
                            <div v-if="!validMsg && !isCompleteMsg" class="error-msg">Заполните поле</div>
                            <textarea v-model.trim="form.msg" placeholder="Комментарии" :class="{ 'error': !isValidMsg || !validMsg, 'complete': isCompleteMsg }"></textarea>
                            <div v-if="msgLength > 0" class="msg-len">Осталось: {{ msgLength }}</div>
                        </div>
                    </div>

                    <button type="submit">Подписаться</button>
                </form>

                <div v-if="loading" :class="[ { 'hidden': !sendForm }, 'success' ]">
                    <div class="icon"></div>
                    <p>Благодарим за подписку!</p>
                </div>
            </div>
        </div>
    </section>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>