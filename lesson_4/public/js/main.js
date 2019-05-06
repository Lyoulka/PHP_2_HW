 $(document).ready(function(){
        $('#show_more').click(function(){
        var btn_more = $(this);
        var count_show = parseInt($(this).attr('count_show'));
        var count_add  = $(this).attr('count_add');
        btn_more.val('Подождите...'); 
        $.ajax({
                    url: "../engine/getGoods.php", // куда отправляем
                    type: "post", // метод передачи

                    data: {"count_show":count_show,"count_add":count_add},
                    // после получения ответа сервера
                    success: function(data){             	
                    if(data !== "finish"){
                    	btn_more.val('Показать еще');
                   		btn_more.attr('count_show', (count_show+4));
                    }else{
                btn_more.val('Больше нечего показывать');
            }
                },
            error: function(xml, error) { console.log(error); }
                }).done(function(result){
                	if(result !== "finish"){
            			$(".goods").append(result);}
       				 });
            });
             
        });
          