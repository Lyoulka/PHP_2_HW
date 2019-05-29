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
  $(document).ready(function(){
        $('#show_more_admin').click(function(){
        var btn_more = $(this);
        var count_show = parseInt($(this).attr('count_show'));
        var count_add  = $(this).attr('count_add');
        btn_more.val('Подождите...'); 
        var $url = "index.php?c=page&act=goods_administration_page";
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
                        $(".good").append(result);}
                     });
            });
        });
function item(goods_id){
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=catalogue_add_item',
        data: {goods_id:goods_id},
        success: function(data){
            alert(data);
            alert("Вы добавили товар в корзину!");
            $(".basket-items").html(data);
        }
    });
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
           /* $(".order-items").html(data);*/
        }
    });
}
function addNewGood(){
    event.preventDefault(); 
    var form_data = new FormData(document.getElementById('form_add_good'));
    form_data.append("file",$("#file")[0].files[0].name);
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=goods_administration_add_good',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false, 
        success: function(data){
            alert("Вы добавили новый товар!");
            $(".new_goods").append(data);
            $('#file').val('');
            $('#good_name').val('');
            $('#good_price').val('');
            $('#good_type').val('');
            $('#good_description').val('');
        },
        error:function(data){
            alert("Что-то пошло не так");
        } 
    });
}
function deleteOldGood(goods_id){
    event.preventDefault(); 
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=goods_administration_delete_good',
        data: {goods_id:goods_id},
        success: function(data){
            alert("Вы удалили товар из каталога!");
            document.getElementById("good_"+goods_id).remove();     
            } 
     });
}
function changeImg(goods_id, link){
    var form_data = new FormData(document.getElementById('form_change_good'));
    form_data.append("value",$("#file_"+goods_id)[0].files[0].name);
    form_data.append("link", link);
    form_data.append("goods_id", goods_id);

    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=administration_change_good',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false, 
        success: function(data){
            alert(data);
            document.getElementById("img_"+goods_id).src="v/img/thumbs/"+data;
            alert("Вы изменили описание товара!");
            
        }
    }); 
}
function changeGood(goods_id, link){
    var description = document.getElementById(link+"_"+ goods_id).value;
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=administration_change_good',
        data: {link:link,goods_id:goods_id,value:description},
        success: function(data){
            alert(data);
            alert("Вы изменили описание товара!");
            document.getElementById(link+"_"+ goods_id).val(data);
        }
    }); 
}
function deleteOrder(user_login, date){
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=administration_page',
        data: {deleteOrder:user_login,date:date},
        success: function(data){
            alert("Вы удалили заказ!");
            Array.from(document.getElementsByClassName("order_card_"+ user_login+date))
    .forEach(element => element.remove());   
        }
    });
}
function done(user_login, date){
    $.ajax({
        type: 'POST',
        url:'index.php?c=page&act=administration_page',
        data: {doneOrder:user_login,date:date},
        success: function(data){
            alert("Вы отметили заказ как выполненный!");
            Array.from(document.getElementsByClassName("order_card_"+ user_login+date))
    .forEach(element => element.remove());   
        }
    });
}
