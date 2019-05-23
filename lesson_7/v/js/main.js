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
function get_element(){

}
function add_item(goods_id){
    var value = "#count"+goods_id;
    var price_res = parseInt(document.getElementById('price_res').innerHTML);
    var good_price = parseInt(document.getElementById("price"+goods_id).innerHTML);
    var count_res = parseInt(document.getElementById("count_res").innerHTML);
    var result = price_res + good_price; 
    var value = "#count"+goods_id;
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=basket_page',
        data: 'goods_id='+ goods_id,
        success: function(data){
            alert("Вы добавили товар в корзину!");
            $(value).val(data);
            document.getElementById('price_res').innerHTML = result;
            document.getElementById('count_res').innerHTML = count_res + 1;
        }
    });
}
function deleteItem(goods_id){
    var value = "#count"+goods_id;
    var price_res = document.getElementById('price_res').innerHTML;
    var good_price = document.getElementById("price"+goods_id).innerHTML;
    var count_res = document.getElementById("count_res").innerHTML;
    var result = price_res - good_price; 
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=basket_page',
        data: 'goods_id_delete='+ goods_id,
        success: function(data){
            if (data > 0){
                alert("Вы удалили единицу товара из корзины!");
                $(value).val(data);
                
            } else {
                document.getElementById("good_card_"+goods_id).remove();
                var n_res = parseInt(document.getElementById("n_res").innerHTML);
                document.getElementById('n_res').innerHTML = n_res-1;                
            }
            document.getElementById('price_res').innerHTML = result;
            document.getElementById('count_res').innerHTML = count_res - 1;
        }
    });
}
function memorizing(goods_id){
     var old_value = document.getElementById("count"+goods_id).value;
     document.getElementById("count"+goods_id).setAttribute("old_value", old_value);
}
function change(goods_id){
    var add_value = "#count"+goods_id;
    var old_value =  parseInt(document.getElementById("count"+goods_id).getAttribute("old_value"));
    var value = parseInt(document.getElementById("count"+goods_id).value);
    var price_res = parseInt(document.getElementById('price_res').innerHTML);
    var good_price = parseInt(document.getElementById("price"+goods_id).innerHTML);
    var count_res = parseInt(document.getElementById("count_res").innerHTML);
    var differ;
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=basket_page',
        data: {change:goods_id,count:value},
        success: function(data){
            data = parseInt(data);
            if (data !== 0) {
                if (data > old_value){
                    differ = data - old_value;
                    price_res = price_res + differ*good_price;
                    count_res = count_res + differ;

                } else {
                    differ = old_value - data;
                    price_res = price_res - differ*good_price;
                    count_res = count_res - differ;
                }  
                $(add_value).val(data);
            } else {
                document.getElementById("good_card_"+goods_id).remove();
                var n_res = parseInt(document.getElementById("n_res").innerHTML);
                document.getElementById('n_res').innerHTML = n_res-1;
                price_res = price_res - old_value*good_price;
                count_res = count_res - old_value;
            }
            alert("Вы изменили количество товара в корзине!");
            document.getElementById('price_res').innerHTML = price_res;
            document.getElementById('count_res').innerHTML = count_res;
        }
    });
}
function changeStatus(user_login, date){
    var order_status = document.getElementById("order_status"+ user_login);
    var value = document.getElementById("order_status"+user_login+date).value;
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=administration_page',
        data: {changeStatus:user_login,order_status:value,date:date},
        success: function(data){
            alert("Вы изменили статус заказа!");
            document.getElementById("order_status"+user_login+date).val(data);
            $(".order-items").html(data);
        }
    });
}

