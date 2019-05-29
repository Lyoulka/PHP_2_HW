<table class="table order_card_<?=$user_login?><?=$order_date?>">
    <tbody>
            <tr><td colspan="5" style="border: none;"></tr>
            <tr>
            <td colspan="4" style="background: #98FB98;"><b> ЗАКАЗ №<?=$count?></b> <td>От <?=$order_date?></td></td>
            </tr>
            <tr>
                <td>Логин:</td><td><b><?=$user_login?></b></td><td>ID пользователя: </td><td colspan="2"><b><?=$user_id?></b></td>
             <tr>
                <td style="width: 150px;">Имя получателя:</td><td><b><?=$user_name?></b></td><td>Фамилия получателя: </td><td colspan="2"><b><?=$user_surname?></b></td>
             </tr>
             <tr>
                <td>Город доставки:</td><td><b><?=$orderuser_city?></b></td><td>Адрес доставки:</td><td colspan="2"><b><?=$user_adress?></b></td>
             </tr>
             <tr>
                <td>Статус заказа:</td><td colspan="2"><input class="form-control" type="text" name="order_status" id="order_status<?=$user_login?><?=$order_date?>" onchange="changeStatus('<?=$user_login?>', '<?=$order_date?>')" value="<?=$order_status?>" style="width: 300px;"></td><td><button class="btn btn-primary" id="delete_order_<?=$user_login?><?=$order_date?>" onclick="deleteOrder('<?=$user_login?>', '<?=$order_date?>')">Удалить заказ</button></td><td><button class="btn btn-primary" id="done_order_<?=$user_login?><?=$order_date?>" onclick="done('<?=$user_login?>', '<?=$order_date?>')">Отметить как выполненый</button></td>
             </tr>
             <tr><td colspan="5">Состав заказа:</tr>
                <?=$order_content?>
             <tr>
                <td></td><td><b>Итог: </b></td><td><b><?=$price_res?> руб.</b></td><td></td><td>Общее количество единиц товара: <?=$count_res?> шт.</td>
             </tr>   
    </tbody>
</table>