<div class="callback">
    <form action="" class="callback__form" method="post" novalidate>
        <input type="hidden" name="title" value="Страница Маркетинг">
        <div class="form-wrapper">
            <h4>У вас есть проект?</h4> <h5>Давайте его обсудим!</h5>
            <div class="form-group">
                <label class="form-col1" for="name">
                    <p class="js-placeholder">Имя<span>*</span></p>
                    <input type="text" id="name" name="name"></label>
            </div>
            <div class="form-group">
                <label class="form-col1" for="phone">
                    <p class="js-placeholder">Номер телефона<span>*</span></p>
                    <input type="tel" id="phone" class="phone_mask" name="phone">
                </label>
                <label class="form-col2" for="site">
                    <input type="url" id="url" name="site" placeholder="Ваш сайт">
                </label>
            </div>
            <div class="form-group">
                <label class="form-col1" for="email">
                    <p class="js-placeholder">Электронная почта<span>*</span></p>
                    <input type="email" id="email" name="email"></label>
                <div class="select-item">
                    <div class="select">
                        <input type="text" name="industry" class="industry" value="" placeholder="Отрасль">
                        <p>Отрасль</p>
                        <ul>
                            <li data-value="Финансы">Финансы</li>
                            <li data-value="Услуги">Услуги</li>
                            <li data-value="Торговля">Торговля</li>
                            <li data-value="Недвижимость">Недвижимость</li>
                            <li data-value="Строительство">Строительство</li>
                            <li data-value="Производство">Производство</li>
                            <li data-value="Медицина">Медицина</li>
                            <li data-value="Ресторанный бизнес">Ресторанный бизнес</li>
                            <li data-value="Гостиничный бизнес">Гостиничный бизнес</li>
                            <li data-value="Другая сфера">Другая сфера</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="textarea-item"><textarea name="msg" placeholder="Описание проекта" onresize="none"></textarea></div>
            </div>
            <button id="callbackform-general" class="btn btn-accent">Обсудить проект</button>
        </div>
        <div class="bottom"></div>
    </form>
</div>
