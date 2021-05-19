<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="progress-bar"></div>
<footer id="contact">
    <div class="container">
        <div class="footer-group">
            <div class="footer-group--item mobile">
                <a href="tel:88003330030" class="allo mgo-number-21521">8 800 333 00 30</a>
                <span>бесплатная консультация</span>
            </div>
            <div class="footer-group--item">
                <a href="https://yandex.ru/maps/-/CCQhzGVkHA" target="_blank" id="adress-link">г. Краснодар, Красноармейская, 34</a>
                <span>Краснодарское отделение Сбербанка 8619</span>
            </div>
            <div class="footer-group--item desctop">
                <a href="tel:88003330030" class="allo mgo-number-21521">8 800 333 00 30</a>
                <span>бесплатная консультация</span>
            </div>
            <div class="footer-group--item">
                <a href="mailto:info@ssbs.ru" id="email-link">info@ssbs.ru</a>
                <span>сотрудничество</span>
            </div>
            <div class="footer-group--item last">
                <button class="btn btn-accent" data-target="modal" data-modal="question" data-form="Футер: Задать вопрос">Задать вопрос</button>
            </div>
        </div>
        <div class="copyright">
            2019-<?=date('Y')?> ©️ smart satellite | business solutions
        </div>

        <div style="display:none" itemscope itemtype="http://schema.org/Organization">
            <div itemprop="name"><?$APPLICATION->ShowTitle()?></div>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <span itemprop="postalCode">350000</span>, <span itemprop="addressLocality">г. Краснодар</span>, <span itemprop="streetAddress">Красноармейская, 34</span>
                <link itemprop="url" href="https://ssbs.ru">
            </div>
            <span itemprop="telephone">8-800-333-00-30</span>
        </div>
    </div>
</footer>

<div class="modal">
    <div class="modal-body consulting">
        <h6>Заказать консультацию</h6>
        <p>Мы свяжемся с вами в ближайшее время</p>
        <form action="" class="callback__form" method="post" novalidate>
            <input type="hidden" name="title" class="title">
            <label for="username">
                <p class="js-placeholder">Имя<span>*</span></p>
                <input type="text" id="username" name="name">
            </label>
            <label for="userphone">
                <p class="js-placeholder">Номер телефона<span>*</span></p>
                <input type="tel" id="userphone" class="phone_mask" name="phone">
            </label>
            <label for="useremail">
                <p class="js-placeholder">Электронная почта<span>*</span></p>
                <input type="email" id="useremail" name="email">
            </label>
            <button id="callbackform-consulting" class="btn btn-accent">Отправить</button>
        </form>
        <small>Нажимая кнопку "Отправить", вы подтверждаете свое согласие на обработку персональных данных</small>
    </div>

    <div class="modal-body question">
        <h6>Задать вопрос</h6>
        <p>Мы свяжемся с вами в ближайшее время</p>
        <form action="" class="callback__form" method="post" novalidate>
            <input type="hidden" name="title" class="title">
            <label for="username">
                <p class="js-placeholder">Имя<span>*</span></p>
                <input type="text" id="username" name="name">
            </label>
            <label for="userphone">
                <p class="js-placeholder">Номер телефона<span>*</span></p>
                <input type="tel" id="userphone" class="phone_mask" name="phone">
            </label>
            <label for="useremail">
                <p class="js-placeholder">Электронная почта<span>*</span></p>
                <input type="email" id="useremail" name="email">
            </label>
            <label for="usermsg">
                <textarea name="msg" id="usermsg" placeholder="Вопрос"></textarea>
            </label>
            <button id="callbackform-question" class="btn btn-accent">Отправить</button>
        </form>
        <small>Нажимая кнопку "Отправить", вы подтверждаете свое согласие на обработку персональных данных</small>
    </div>
</div>
<div class="response good">
    <div class="response-body">
        <p class="done"></p>
        <p>Спасибо, <br>ваша заявка получена</p>
        <p>Мы свяжемся с вами в ближайшее время</p>
    </div>
</div>
<div class="response error">
    <div class="response-body">
        <p class="error"></p>
        <p>Опс, <br>что-то пошло не так</p>
        <p>Свяжитесь с нами <a href="tel:88003330030">8 800 333 00 30</a></p>
    </div>
</div>

<script>
    (function(w,d,u){
        var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
        var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://prosto24.com/upload/crm/site_button/loader_1_wz8yrd.js');
</script>
<!-- Marquiz script start -->
<script src="//script.marquiz.ru/v1.js" type="application/javascript"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Marquiz.init({
            host: '//quiz.marquiz.ru',
            id: '5f0b65308145fd0044e9aac3',
            autoOpen: false,
            autoOpenFreq: 'once',
            openOnExit: false
        });
    });
</script>
<!-- Marquiz script end -->
</body>
</html>
