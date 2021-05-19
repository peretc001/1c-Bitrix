<p>
    <b>Списать <br>бонусные баллы</b>
</p>
<p>введите сумму бонусов, чтобы списать</p>

<form action="/" method="post" class="setPromocode">
    <input type="tel" name="promocode[]" class="code-input" maxlength="1" tabindex="1" autocomplete="off">
    <input type="tel" name="promocode[]" class="code-input" maxlength="1" tabindex="2" autocomplete="off">
    <input type="tel" name="promocode[]" class="code-input" maxlength="1" tabindex="3" autocomplete="off">
    <input type="tel" name="promocode[]" class="code-input" maxlength="1" tabindex="4" autocomplete="off">

    <p class="text">на счету</p>

    <p class="all-bonus">
    <?
        if ($ar = CSaleUserAccount::GetByID($USER->GetID())):
            echo number_format($ar["CURRENT_BUDGET"], 0, '.', ' ') .' Б';
        endif;
    ?>
    </p>
    <button type="submit"></button>
    <span class="error"></span>
</form>
