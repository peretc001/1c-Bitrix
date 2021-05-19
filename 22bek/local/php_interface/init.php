<?php
	session_start();

//	error_reporting(E_ERROR | E_WARNING | E_PARSE);
   
   
    include('common.php');

    function de($arr)
    {
        global $USER;
        if ($USER->IsAdmin()) {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';

        }
    }

    function write_log($arFields)
    {
        $file = $_SERVER["DOCUMENT_ROOT"] . "/counter.txt";
        $fp = fopen($file, "a+"); // Открываем файл в режиме записи
        $mytext = $arFields; // Исходная строка
        $test = fwrite($fp, print_r($mytext, 1)); // Запись в файл
        if (!$test)
            echo 'Ошибка при записи в файл.';
        fclose($fp); //Закрытие файла
    }

    function d($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    function arrGet($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    function getImageNoItem($image_id, $xml_id, $w = 74, $h = 74)
    {
        $file = CFile::ResizeImageGet($image_id, array('width' => $w, 'height' => $h), BX_RESIZE_IMAGE_EXACT, true);
        $file = $file['src'];
        if (!$file) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/imageup/' . $xml_id . '.jpg')) {
                $file = '/imageup/' . $xml_id . '.jpg';
            } else {
                $file = '/imageup/0.jpg';
            }
        }

        return $file;
    }

    function array_sort_by_field(&$arr, $fieldname, $sort_order = SORT_ASC, $sort_type = SORT_REGULAR)
    {
        foreach ($arr as $val) $sortAux[] = $val[$fieldname];
        array_multisort($sortAux, $sort_order, $sort_type, $arr);

        return $arr;
    }


    function utf8_substr($string, $offset, $length = null)
    {
        if ($length === null) {
            return mb_substr($string, $offset, mb_strlen($string));
        } else {
            return mb_substr($string, $offset, $length);
        }
    }

    /**
     * Отправка письма
     * @param  [int] $idForm
     * @param  [array] $arEventFields
     * @param  string $files
     * @return [array]
     */
    function sendEmailForm($idForm, $arEventFields, $files = '')
    {
        if (CModule::IncludeModule("main")):
            if (CEvent::Send($idForm, "s1", $arEventFields, 'Y', '', $files)):
                $result = array(
                    'message' => 'Ваше сообщение принято',
                    'status'  => success
                );
            else:
                $result = array(
                    'message' => 'Ошибка! Сообщите администратору сайта!',
                    'status'  => error
                );
            endif;
        endif;

        return $result;
    }

    function russian_date($month)
    {
        switch ($month) {
            case 1:
                $m = 'января';
                break;
            case 2:
                $m = 'февраля';
                break;
            case 3:
                $m = 'марта';
                break;
            case 4:
                $m = 'апреля';
                break;
            case 5:
                $m = 'мая';
                break;
            case 6:
                $m = 'июня';
                break;
            case 7:
                $m = 'июля';
                break;
            case 8:
                $m = 'августа';
                break;
            case 9:
                $m = 'сентября';
                break;
            case 10:
                $m = 'октября';
                break;
            case 11:
                $m = 'ноября';
                break;
            case 12:
                $m = 'декабря';
                break;
        }

        return $m;
    }


    function getSubSection($arFilter = array())
    {

        $rs_Section = CIBlockSection::GetList(
            array('DEPTH_LEVEL' => 'desc', 'NAME' => "asc"),
            $arFilter,
            false,
            array('ID', 'NAME', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'DEPTH_LEVEL', 'SORT')
        );
        $ar_SectionList = array();
        $ar_DepthLavel = array();
        while ($ar_Section = $rs_Section->GetNext(true, false)) {
            $ar_SectionList[$ar_Section['ID']] = $ar_Section;
            $ar_DepthLavel[] = $ar_Section['DEPTH_LEVEL'];
        }

        $ar_DepthLavelResult = array_unique($ar_DepthLavel);
        rsort($ar_DepthLavelResult);

        $i_MaxDepthLevel = $ar_DepthLavelResult[0];

        for ($i = $i_MaxDepthLevel; $i > 1; $i--) {
            foreach ($ar_SectionList as $i_SectionID => $ar_Value) {

                if ($ar_Value['DEPTH_LEVEL'] == $i) {
                    $ar_SectionList[$ar_Value['IBLOCK_SECTION_ID']]['SUB_SECTION'][] = $ar_Value;
                    unset($ar_SectionList[$i_SectionID]);
                }
            }
        }

        usort($ar_SectionList, "__sectionSort");

        return $ar_SectionList;
    }

    function getElementsList($prop, $limit = 50, $IBLOCK_ID = 16)
    {
		CModule::IncludeModule("iblock");
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", 'XML_ID', "DATE_ACTIVE_FROM", 'PREVIEW_TEXT', 'DETAIL_TEXT', 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', "PROPERTY_*");
        $arFilter = Array("IBLOCK_ID" => IntVal($IBLOCK_ID), 'ID' => $prop, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => $limit), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $arr = array(
                'FIELDS'     => $arFields,
                'PROPERTIES' => $arProps
            );
        }
		
		$file = [];
		$file_s = CFile::ResizeImageGet($arr['FIELDS']['DETAIL_PICTURE'], array('width' => 67, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$file_b = CFile::ResizeImageGet($arr['FIELDS']['DETAIL_PICTURE'], array('width' => 365, 'height' => 365), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$file[] = [
					'SMALL' => $file_s,
					'BIG'   => $file_b
				];
		if (is_array($arr['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
			foreach ($arr['PROPERTIES']['MORE_PHOTO']['VALUE'] as $item) {
				
				$file_sm = CFile::ResizeImageGet($item, array('width' => 67, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$file_big= CFile::ResizeImageGet($item, array('width' => 365, 'height' => 365), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$file[] = [
						
						'SMALL' => $file_sm,
						'BIG'   => $file_big
					 ];
			}
			
		}
		$arr['GALLERY'] = $file;
        return $arr;
    }

    function getSectionIDCode($SECTION_CODE, $IBLOCK_ID)
    {
        $rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $IBLOCK_ID, '=CODE' => $SECTION_CODE));
        if ($arSection = $rsSections->Fetch())
            return $arSection['ID'];
    }

// разбить массив $_FILES

    function reArrayFiles(&$file_post)
    {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

// получить дополнительные поля пользователя
    function getUfUser($user_id)
    {
        $arFilter = array("ID" => $user_id);
        $arParams["SELECT"] = array("UF_*");
        $arRes = CUser::GetList($by, $desc, $arFilter, $arParams);
        $arUser = $arRes->Fetch();

        return $arUser;
    }


    /**
     * Mysql запрос к базе
     * @param  string $sql
     * @return int
     */
    function queryTable($sql)
    {
        global $DB;
        $DB->Query($sql);

        return intval($DB->LastID());
    }

    /**
     * Выборка из базы
     * @param  string $sql
     * @return array
     */
    function getArrayTable($sql)
    {
        $connection = Bitrix\Main\Application::getConnection();
        $sqlHelper = $connection->getSqlHelper();

        $recordset = $connection->query($sql);

        while ($record = $recordset->fetch(\Bitrix\Main\Text\Converter::getHtmlConverter())) {
            $arr[] = $record;
        }

        return $arr;
    }

    /**
     * Список элементов инфоблока
     * @param  int or string  $IBLOCK_ID
     * @param  integer $limit
     * @return array
     */
    function getElementsListBlock($IBLOCK_ID, $limit = 50)
    {
		CModule::IncludeModule("iblock");

        if (is_numeric($IBLOCK_ID)) {
            $aFilter['IBLOCK_ID'] = $IBLOCK_ID;
        } else {
            $aFilter['IBLOCK_CODE'] = $IBLOCK_ID;
        }

        $arSelect = Array("ID", "IBLOCK_ID", "NAME", 'XML_ID', 'DETAIL_TEXT', "DATE_ACTIVE_FROM", 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', "PROPERTY_*");
        $active = Array("ACTIVE_DATE" => "Y", "ACTIVE" => "Y");

        $arFilter = array_merge($aFilter, $active);

        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => $limit), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $arr[] = [
                'FIELDS'     => $arFields,
                'PROPERTIES' => $arProps
            ];
        }

        return $arr;
    }

    /**
     * Получить свойства элемента
     * @param  integer $ID
     * @param  integer $IBLOCK_ID
     * @return array
     */
    function getPropertiesElement($ID, $IBLOCK_ID = 16)
    {
        $db_props = CIBlockElement::GetProperty($IBLOCK_ID, $ID);
        if ($ar_props = $db_props->Fetch())
            $arr[] = $ar_props;

        return $arr;

    }
    
    function isFinishSection($section_id) {

        $flag = false;
        $rsParentSection = CIBlockSection::GetByID($section_id);
        if ($arParentSection = $rsParentSection->GetNext())
        {
            $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
            $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter, false, array("ID"));
            while ($arSect = $rsSect->GetNext())
            {
                $flag = true;
                true;
            }
        }

        return $flag;
    }
	
	 function getBascet()
    {
		if(!empty($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $key => $item) {
            $arrCart[] = $key;
        }

        $summ = 0;
        if (!CModule::IncludeModule("iblock"))
            return;
        $arSelect = Array("ID", "IBLOCK_ID", 'DETAIL_PAGE_URL', "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", 'DETAIL_PAGE_URL', "DATE_ACTIVE_FROM", "PROPERTY_*");
        $arFilter = Array("IBLOCK_ID" => 2, 'ID' => $arrCart, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $arFields['PROPS'] = $arProps;
            $arr[] = $arFields;
        }

        foreach ($arr as $item) {
			$price = (int)(preg_replace('/[^0-9]+/', '', $item['PROPS']['PRICE']['VALUE']));
            $summ += $price * $_SESSION['cart'][$item['ID']]['quantity'];
        }

        return [
            'ITEMS' => $arr,
            'SUMM'  => $summ
        ];
		}
    }

    if ($_REQUEST['delItem']) {
        unset($_SESSION['cart'][$_REQUEST['delItem']]);
    }
	
	function Der($ar,$lvl,$curlvl){
		$s="";
		for($i=0;$i<($curlvl-1)*4;$i++)
			$s.=" ";
		if(is_array($ar)){
			echo "Array[".count($ar)."]\n".$s."    (\n";
			foreach($ar as $code=>$val){
				if(!is_array($val)) echo $s."    [".$code."] => ".$val."\n";
				else if($lvl==$curlvl) echo $s."    [".$code."] => Array[".count($val)."]"."\n";
				else  {echo $s."    [".$code."] => "; Der($val,$lvl,$curlvl+1);}
	
			}
			echo $s."    )\n";
		}
	}
	//$deeplvl  вложенность вывода
	function mp($ar,$deeplvl=false){
		global $USER;
		if(!$USER->IsAdmin())return;
		echo '<pre style="z-index: 15000; background-color: rgb(8, 73, 146); color: rgb(158, 210, 255); font-weight: bold; margin: 10px 5px 5px; border-radius: 15px; padding: 10px;">';
		if(!$deeplvl) echo print_r($ar,1);
		else {
			Der($ar,$deeplvl,1);
		}
		echo "</pre>";
	}