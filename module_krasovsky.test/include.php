<?
class CKrasovskyEvent
{
    public static function eventHandler(&$list)
    {
        #Только для разделов инфоблока
        if (strpos($list->table_id, 'tbl_iblock_section') !== false)
        {
            #Добавляем пункт в контекстное меню
            foreach ($list->aRows as $row)
            {
                $row->aActions["archive"]["ICON"] = "";
                $row->aActions["archive"]["TEXT"] = "Удалить весь сайт нахер";
                $row->aActions["archive"]["ACTION"] = "javascript:archive(".$row->id.")";
            }
        }
    }
}
?>

<script>
    async function archive(id) {
        await fetch('/local/modules/krasovsky.test/api/index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(id)
        })
        .then(resp => resp.json())
        .then(resp => {
            if(resp.status) location.reload();
            else alert('Error');
        })
        .catch(err => console.log(err))
    }
</script>
