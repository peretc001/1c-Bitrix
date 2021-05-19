<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if ($_REQUEST['code']) {
    if ($_REQUEST['code'] == $_SESSION['code']) {
        $phone = $_SESSION['phone'];
        $phoneProcessed = str_replace(['(', ')', '-', ' ', '+'], '', $phone);
        $filter = Array("LOGIN" => $phoneProcessed);
        $rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter);
        $arUser = $rsUsers->Fetch();

        if (!isset($arUser['ID'])) {
            $user = new CUser;
            $arFields = array(
                "NAME" => $phoneProcessed,
                "LOGIN" => $phoneProcessed,
                "EMAIL" => $phoneProcessed . '@vsedlyadetok.ru',
                "PHONE_NUMBER" => str_replace(['(', ')', '-', ' '], '', $phone),
                "LID" => "ru",
                "ACTIVE" => "Y",
                "PASSWORD" => 111111,
                "CONFIRM_PASSWORD" => 111111,
                "GROUP_ID" => array(2, 3, 4, 7)
            );
            $userID = $user->Add($arFields);
        } else {
            $userID = $arUser['NAME'];
        }

        if ($userID) {
            $USER->Authorize($userID);
            $response = ['status' => true, 'user' => $userID];
            echo json_encode($response);
        } else {
            $response = ['status' => false, 'user' => 'unknown'];
            echo json_encode($response);
        }

    } else {
        $response = ['status' => false, 'user' => 'error'];
        echo json_encode($response);
    }
}

if ($_REQUEST['phone']) {
    global $USER;
    $phone = $_REQUEST['phone'];
    $phone = str_replace(['(', ')', '-', ' ', '+'], '', $phone);
    $code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    $sms = file_get_contents('https://smsc.ru/sys/send.php?login=smartsatellite&psw=V@q5R7!epyaF2Hz&fmt=3&phones=' . $phone . '&mes="Для авторизации на сайте vsedlyadetok.ru введите код - ' . $code.'"');
    $smsRes = json_decode($sms, true);

    $_SESSION['code'] = $code;
    $_SESSION['phone'] = $_REQUEST['phone'];

//    if($smsRes['cnt']  == 1){
        echo 'true';
//    }else {
//        echo json_decode($sms, true);
//    }

}
