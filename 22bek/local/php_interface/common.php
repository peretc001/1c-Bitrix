<?php

$managerIDs = [37,21,19];

function getNewABID()
{
    global $managerIDs;
    $abidNextI = \Bitrix\Main\Config\Option::get('main', 'abidNextI', 0);
    if($abidNextI >= count($managerIDs))
        $abidNextI = 0;
    \Bitrix\Main\Config\Option::set('main', 'abidNextI', $abidNextI+1);
    return $managerIDs[$abidNextI];
}

$code = '1bfqde3jrp76guci';
$domain = '22bek.bitrix24.ru';
$user_id = '39';
$queryUrl = 'https://'.$domain.'/rest/'.$user_id.'/'.$code.'/crm.lead.add';

function getSourceDesc()
{
    $res = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $utm = '';
    $utm_source = $_COOKIE['utm_source'];
    if($_REQUEST['utm_source'])
        $utm_source = $_REQUEST['utm_source'];
    $utm_medium = $_COOKIE['utm_medium'];
    if($_REQUEST['utm_medium'])
        $utm_source = $_REQUEST['utm_medium'];
    $utm_campaign = $_COOKIE['utm_campaign'];
    if($_REQUEST['utm_campaign'])
        $utm_source = $_REQUEST['utm_campaign'];
    $utm_content = $_COOKIE['utm_content'];
    if($_REQUEST['utm_content'])
        $utm_source = $_REQUEST['utm_content'];
    $utm_term = $_COOKIE['utm_term'];
    if($_REQUEST['utm_term'])
        $utm_source = $_REQUEST['utm_term'];
    if($utm_source) $utm .= "\nutm_source=$utm_source";
    if($utm_medium) $utm .= "\nutm_medium=$utm_medium";
    if($utm_campaign) $utm .= "\nutm_campaign=$utm_campaign";
    if($utm_content) $utm .= "\nutm_content=$utm_content";
    if($utm_term) $utm .= "\nutm_term=$utm_term";
    if($utm)
        $res .= $utm;
    return $res;
}

function result($queryUrl, $queryData){
    //Bitrix\Main\Diag\Debug::dumpToFile($queryData, '', "log.txt");
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    return json_decode($result, 1);
}


session_start();
header('Content-Type: text/html; charset=utf-8');

if ($_REQUEST['modeJs']) {

    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
    if (!CModule::IncludeModule("iblock"))
        return;

    $params = array();
    parse_str($_REQUEST['data'], $params);

    $url = parse_url($_SERVER['HTTP_REFERER']);

    global $USER;
    if (!is_object($USER))
        $USER = new CUser;


    if ($params['mode'] == 'feedbackForm') {

        $to = COption::GetOptionString("main", "email_from");

        $params['text'] = 'Прошу вас перезвонить мне по указанному телефону';

        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($params['nameForm']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($params['email']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($params['phoneForm']),
            "TEXT"         => htmlspecialcharsEx($params['text']),
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FEEDBACK_FORM', $arEventFields);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );

        echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Feedback, ' . $_POST['name_order_author'] . ', ' . $_POST['phone_order_author'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }

    if ($_REQUEST['modeJs'] == 'fastOrder') {

        $cart = getBascet();

        $text = '';
        foreach ($cart['ITEMS'] as $item) {
            $text .= '<p>Название товара: ' . $item['NAME'] . '</p>
            <p>Ссылка на товар: ' . $item['DETAIL_PAGE_URL'] . '</p>';
        }

        $text .= '<br />--------------------------------------<br />';


        $text .= '<p>Имя: ' . $_POST['name_order_author'] . '</p>';
        $text .= '<p>Email: ' . $_POST['email_order_author'] . '</p>';
        $text .= '<p>Телефон: ' . $_POST['phone_order_author'] . '</p>';
        $text .= '<p>Комментарии к заказу: ' . $_POST['message_order_author'] . '</p>';

        $text .= '<p>Название: ' . $_POST['product_name'] . '</p>';
        $text .= '<p>Ссылка: ' . $_POST['product_link'] . '</p>';
        if($_POST['color'])
            $text .= '<p>Цвет: ' . $_POST['color'] . '</p>';
        if($_POST['size'])
            $text .= '<p>Размер: ' . $_POST['size'] . '</p>';

        $to = COption::GetOptionString("main", "email_from");
        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['name_order_author']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['phone_order_author']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['email_order_author']),
            "TEXT"         => $text,
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FAST_ORDER', $arEventFields);

        $el = new CIBlockElement;

        $PROP = array();

        $PROP[36] = $_REQUEST['order_name'];
        $PROP[37] = $_REQUEST['order_phone'];
        $PROP[38] = $_REQUEST['order_email'];

        $arLoadProductArray = Array(
            "MODIFIED_BY"       => 1,
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"         => 12,
            "PROPERTY_VALUES"   => $PROP,
            "PREVIEW_TEXT"      => htmlspecialchars_decode($text),
            "NAME"              => 'Заказ ' . $_POST['order_name'],
            "ACTIVE"            => "Y",
        );

        $el->Add($arLoadProductArray);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );
        echo json_encode($result);
        Bitrix\Main\Diag\Debug::dumpToFile($_POST['email_order_author'], '', "log.txt");
        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Новая заявка, ' . $arEventFields['AUTHOR'] . ', ' . $arEventFields['AUTHOR_PHONE'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }

    if ($_REQUEST['modeJs'] == 'orderCartForm') {

        $cart = getBascet();

        $text = '';
        foreach ($cart['ITEMS'] as $item) {
            $text .= '<p>Название товара: ' . $item['NAME'] . '</p>
            <p>Ссылка на товар: ' . $item['DETAIL_PAGE_URL'] . '</p>';
        }

        $text .= '<br />--------------------------------------<br />';


        $text .= '<p>Имя: ' . $_POST['order_name'] . '</p>';
        $text .= '<p>Email: ' . $_POST['order_email'] . '</p>';
        $text .= '<p>Телефон: ' . $_POST['order_phone'] . '</p>';
        $text .= '<p>Комментарии к заказу: ' . $_POST['message_order_author'] . '</p>';

        $to = COption::GetOptionString("main", "email_from");
        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['order_name']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['order_phone']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['order_email']),
            "TEXT"         => $text,
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FAST_ORDER', $arEventFields);

        $el = new CIBlockElement;

        $PROP = array();

        $PROP[36] = $_REQUEST['order_name'];
        $PROP[37] = $_REQUEST['order_phone'];
        $PROP[38] = $_REQUEST['order_email'];

        $arLoadProductArray = Array(
            "MODIFIED_BY"       => 1,
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"         => 12,
            "PROPERTY_VALUES"   => $PROP,
            "PREVIEW_TEXT"      => htmlspecialchars_decode($text),
            "NAME"              => 'Заказ ' . $_POST['order_name'],
            "ACTIVE"            => "Y",
        );

        $el->Add($arLoadProductArray);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );
        echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Новая заявка, ' . $_POST['name_order_author'] . ', ' . $_POST['phone_order_author'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }




    if ($_REQUEST['modeJs'] == 'orderPresentation') {

        $text = '';
        $text .= '<p>Название товара: ' . $_POST['product_name'] . '</p>';
        $text .= '<p>Ссылка на товар: ' . $_POST['product_link'] . '</p>';

        $to = COption::GetOptionString("main", "email_from");
        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['name_order_author']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['phone_order_author']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['email_order_author']),
            "TEXT"         => $text,
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FAST_ORDER', $arEventFields);

        $el = new CIBlockElement;

        $result = array(
            'message' => 'Ваша призентация успешно заказана',
            'status'  => true
        );

        echo json_encode($result);

        unset($_SESSION['cart']);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Заказ презентации',
                "NAME" => $arEventFields['AUTHOR'] . " " . $arEventFields['AUTHOR_EMAIL'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }


    if ($_REQUEST['modeJs'] == 'contactForm') {
        $to = COption::GetOptionString("main", "email_from");

        $params['text'] = 'Прошу вас перезвонить мне по указанному телефону';

        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['contact_name_author']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['contact_email_author']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['contact_phone_author']),
            "TEXT"         => htmlspecialcharsEx($params['text']),
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FEEDBACK_FORM', $arEventFields);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );

        //echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Форма на главной, '
                    . $arEventFields['AUTHOR'] . ', '
                    . $arEventFields['AUTHOR_PHONE'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);
        //echo json_encode($result);
        die();
    }



    if ($_REQUEST['modeJs'] == 'contactFormMainBanner') {
        if(!empty($_REQUEST[ 'phone' ])) exit;
        $to = COption::GetOptionString("main", "email_from");

        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['name_author']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['email_author']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['phone_author']),
            "TEXT"         => htmlspecialcharsEx($_POST['message_author']),
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FEEDBACK_FORM', $arEventFields);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );

        echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Контакты, ' . $arEventFields['AUTHOR'] . ', ' . $arEventFields['AUTHOR_PHONE'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }



    if ($_REQUEST['modeJs'] == 'contactFormMainBanner2') {
        if(!empty($_REQUEST[ 'phone' ])) exit;
        $to = COption::GetOptionString("main", "email_from");

        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['name_author2']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['email_author2']),
            "AUTHOR_PHONE" => '',
            "TEXT"         => htmlspecialcharsEx($_POST['message_author2']),
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FEEDBACK_FORM', $arEventFields);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );

        echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Контакты 2, ' . $_POST['name_order_author'] . ', ' . $_POST['phone_order_author'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }



    if ($_REQUEST['modeJs'] == 'contactFormMainBanner3') {
        if(!empty($_REQUEST[ 'phone' ])) exit;
        $to = COption::GetOptionString("main", "email_from");

        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['name_author3']),
            "AUTHOR_EMAIL" => '',
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['phone_author3']),
            "TEXT"         => htmlspecialcharsEx($_POST['message_author3']),
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FEEDBACK_FORM', $arEventFields);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );

        echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Контакты 3, ' . $_POST['name_order_author'] . ', ' . $_POST['phone_order_author'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }


    if ($_REQUEST['modeJs'] == 'contactFormMain') {
        if(!empty($_REQUEST[ 'phone' ])) exit;
        $to = COption::GetOptionString("main", "email_from");

        $arEventFields = array(
            "AUTHOR"       => htmlspecialcharsEx($_POST['contacts_name']),
            "AUTHOR_EMAIL" => htmlspecialcharsEx($_POST['contacts_email']),
            "AUTHOR_PHONE" => htmlspecialcharsEx($_POST['contacts_phone']),
            "TEXT"         => htmlspecialcharsEx($_POST['contacts_message']),
            "EMAIL_TO"     => $to
        );

        sendEmailForm('FEEDBACK_FORM', $arEventFields);

        $result = array(
            'message' => 'Ваше сообщение успешно отправлено',
            'status'  => true
        );

        echo json_encode($result);

        $queryData = http_build_query([
            'FIELDS' => [
                "TITLE" => 'Контакты, ' . $arEventFields['AUTHOR'] . ', ' . $arEventFields['AUTHOR_PHONE'],
                "NAME" => $arEventFields['AUTHOR'],
                "STATUS_ID" => "NEW",
                "PHONE" => [
                    ['VALUE' => $arEventFields['AUTHOR_PHONE'], 'VALUE_TYPE' => 'WORK']
                ],
                'EMAIL' => [[
                    "VALUE" => $arEventFields['AUTHOR_EMAIL'],
                    "VALUE_TYPE" => "WORK"
                ]],
                "COMMENTS" => $arEventFields['TEXT'],
                'SOURCE_ID' => 'WEB',
                'SOURCE_DESCRIPTION' => getSourceDesc(),
                'ASSIGNED_BY_ID' => getNewABID()
            ]
        ]);

        $result = result($queryUrl, $queryData);

        die();
    }

    if ($_REQUEST['modeJs'] == 'addBascetSection') {

        $quantity = (int)$_REQUEST["quantity"] > 0 ? (int)$_REQUEST["quantity"] : 1;
        $productID = intval(htmlspecialchars($_REQUEST["id"]));
        $color = htmlspecialchars($_REQUEST["color"]);
        $size = htmlspecialchars($_REQUEST["size"]);
        CModule::IncludeModule('catalog');

        $_SESSION['cart'][(int)$_REQUEST['id']] = [
            'id'       => $productID,
            'color'    => $color,
            'quantity' => $quantity,
            'size'     => $size,
        ];

        $result = array(
            'status' => 'success'
        );

        echo json_encode($result);

        die;
    }

    if ($_REQUEST['modeJs'] == 'addBascet') {

        $quantity = $_REQUEST['quantity'] ? $_REQUEST['quantity'] : 1;

        $_SESSION['cart'][(int)$_REQUEST['id']] = [
            'id'       => (int)$_REQUEST['id'],
            'color'    => $_REQUEST['color'],
            'quantity' => $quantity,
            'size'     => $_REQUEST['size'],
        ];

        $result = array(
            'status' => 'success'
        );

        echo json_encode($result);

        die;
    }

    if ($_REQUEST['modeJs'] == 'cartForm') {

        foreach ($_POST['quanitySniper'] as $key => $item) {
            $_SESSION['cart'][$key]['quantity'] = $item;
        }
    }

}