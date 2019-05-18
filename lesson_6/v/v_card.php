<div class="card" id="<?= $id?>" >
                		<img src="v/img/thumbs/<?=$image?>" class="card-img-top" alt="Изображение_товара_<?= $name?>">
                		<div class="card-body">
                  			<h5 class="card-title"><?= $name?></h5>
                  			<p class="card-text"><b> Цена: <?= $price?> руб.</b></p>
                  			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalsearch-<?= $id?>">Подробнее...</button>
                    			<button type="button" class="btn btn-primary" onclick="item('<?=$id?>')">В корзину</button>
                    			<div class="modal fade" id="myModalsearch-<?= $id?>" tabindex="-1" role="dialog"> 
                    			<div class="modal-dialog" role="document">
                        			<div class="modal-content" style="background: #ffffff;">
                            			<div class="modal-body">
                                			<img src='v/img/<?= $image?>'>
                                			<h5 class="modal-title"><?= $name?></h5>
                                			<p>Назначение: <?= $type?>.'</p>
                                			<p><?= $description?></p>
                                			<p class="card-text"> <b>Цена: <?= $price?> руб.</b></p>
                                			<button type="button" class="btn btn-primary" onclick="item('<?=$id?>')">В корзину</button>
                                        </div>
                        			</div>
                   			 	</div>
                			</div>
            			</div>
        			</div>