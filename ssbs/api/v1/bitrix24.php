<?php
define('PATH_BX24', '############################');

function query($url, $fields)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $fields,
    ));
    $result = curl_exec($curl);
    $result = json_decode($result, true);

    curl_close($curl);

    return $result["result"];
}

function getContact($data) {
    $url = PATH_BX24 . 'crm.contact.list';

    $fields = array(
        'filter' => array(
            "PHONE" => strip_tags($data['phone']),
            "VALUE_TYPE" => "WORK"
        )
    );

    $queryData = http_build_query($fields);

    $result = query($url, $queryData);

    return $result;
}

function addContact($data)
{

    $url = PATH_BX24 . 'crm.contact.add';

    $fields = array(
        'fields' => array(
            'NAME' => strip_tags($data['name']),
            'TYPE_ID' => 'CLIENT',
            'ASSIGNED_BY_ID' => 479,
            "EMAIL" => array(array("VALUE" => $data['email'], "VALUE_TYPE" => "WORK")),
        ),
    );

    if ($data['phone']) {
        $fields['fields']['PHONE'] = array(
            array(
                "VALUE" => strip_tags($data['phone']),
                "VALUE_TYPE" => "WORK"
            )
        );
    }

    if ($data['site']) {
        $fields['fields']['WEB'] = array(
            array(
                "VALUE" => strip_tags($data['site']),
                "VALUE_TYPE" => "WORK"
            )
        );
    }

    if ($data['title']) {
        $fields['fields']['UF_CRM_DCT_SOURCE'] = strip_tags($data['title']);
    }

    $queryData = http_build_query($fields);

    $result = query($url, $queryData);
    return $result;
}

function addDeal($data)
{
    $url = PATH_BX24 . 'crm.deal.add';

    $fields = array(
        'fields' => array(
            'TITLE' => strip_tags($data['title']),
            'ASSIGNED_BY_ID' => 479,
//            'UF_CRM_1583587732' => '111',
        ),
    );

    if ($data['msg'] && $data['industry']) {
        $fields['fields']['COMMENTS'] = 'Отрасль: '.$data['industry'] .'<br>Сообщение: '. $data['msg'];
    }
    #Сообщение
    if ($data['msg'] && empty($data['industry'])) {
        $fields['fields']['COMMENTS'] = 'Сообщение<br>'. strip_tags($data['msg']);
    }

    #Сфера деятельности
    if (empty($data['msg']) && $data['industry']) {
        $fields['fields']['COMMENTS'] = '<br>Отрасль: '.strip_tags($data['industry']);
    }

    /*
     * services

    if ($_REQUEST['services']) {
        $fields['fields']['UF_CRM_1586439723'] = strip_tags($_REQUEST['services']);
    }


    #utm_source
    if ($_REQUEST['utm_source']) {
        $fields['fields']['UF_CRM_1583587703'] = strip_tags($_REQUEST['utm_source']);
    }

    #utm_medium
    if ($_REQUEST['utm_medium']) {
        $fields['fields']['UF_CRM_1583587714'] = strip_tags($_REQUEST['utm_medium']);
    }

    #utm_compaign
    if ($_REQUEST['utm_compaign']) {
        $fields['fields']['UF_CRM_1583587726'] = strip_tags($_REQUEST['utm_compaign']);
    }

    #utm_content
    if ($_REQUEST['utm_content']) {
        $fields['fields']['UF_CRM_1586956894'] = strip_tags($_REQUEST['utm_content']);
    }

   #utm_term
    if ($_REQUEST['utm_term']) {
        $fields['fields']['UF_CRM_1586956902'] = strip_tags($_REQUEST['utm_term']);
    }

    */

    $queryData = http_build_query($fields);


    $result = query($url, $queryData);
    return $result;
}

function addDealToContact($deal, $contact)
{
    $url = PATH_BX24 . 'crm.deal.contact.add';

    $queryData = http_build_query(array(
        'id' => $deal,
        'fields' => array(
            'CONTACT_ID' => $contact,
        ),
    ));

    $result = query($url, $queryData);
    return $result;
}

if (isset($_REQUEST['data'])):
    $data = json_decode($_REQUEST['data'], true);

    if ($data['name'] and $data['email'] and $data['phone']):

        $response = [];

        $getCurrentContact = getContact($data);

        if (!empty($getCurrentContact)):

            $idDeal = addDeal($data);
            $res = addDealToContact($idDeal, $getCurrentContact[0]['ID']);

            if ($res):
                $response['status'] = true;
            else:
                $response['status'] = false;
            endif;

        else:

            $idContact = addContact($data);
            $idDeal = addDeal($data);

            $res = addDealToContact($idDeal, $idContact);

            if ($idContact):
                $response['status'] = true;
            else:
                $response['status'] = false;
            endif;

        endif;

        echo json_decode($response['status']);


    endif;

else:
    echo 'error';
endif;

