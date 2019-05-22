 $(document).ready(function(){
        $('#show_more').click(function(){
        var btn_more = $(this);
        var count_show = parseInt($(this).attr('count_show'));
        var count_add  = $(this).attr('count_add');
        btn_more.val('Подождите...'); 
        var $url = "index.php?c=page&act=catalogue_page";
        $.ajax({
                    url: $url, // куда отправляем
                    type: "post", // метод передачи
                    data: {"count_show":count_show,"count_add":count_add},
                    // после получения ответа сервера
                    success: function(data){             	
                    if(data !== ""){
                    	btn_more.val('Показать еще');
                   		btn_more.attr('count_show', (count_show+4));
                    }else{
                btn_more.val('Больше нечего показывать');
            }
                },
            error: function(xml, error) { console.log(error); }
                }).done(function(result){
                	if(result !== ""){
            			$(".goods").append(result);}
       				 });
            });
        });
function item(goods_id){
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=catalogue_add_item',
        data: 'goods_id='+ goods_id,
        success: function(data){
            alert("Вы добавили товар в корзину!");
            $(".basket-items").html(data);
        }
    });
}
function deleteItem(goods_id){
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=basket_page',
        data: 'goods_id_delete='+ goods_id,
        success: function(data){
            alert("Вы удалили единицу товара из корзину!");
            $(".basket-items").html(data);
        }
    });
}
function change(goods_id){
    var value = document.getElementById("count"+goods_id).value;
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=basket_page',
        data: {change:goods_id,count:value},
        success: function(data){
            alert("Вы изменили количество товара в корзине!");
            $(".basket-items").html(data);
        }
    });
}
function changeStatus(user_login, date){
    var value = document.getElementById("order_status"+user_login).value;
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=administration_page',
        data: {changeStatus:user_login,order_status:value,date:date},
        success: function(data){
            alert("Вы изменили статус заказа!");
            $(".order-items").html(data);
        }
    });
}

