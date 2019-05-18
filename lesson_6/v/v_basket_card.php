<tr>
    <td><img src="v/img/thumbs/<?=$image?>"></td>
    <td><a href="index.php?c=page&act=catalogue"><?=$name?></a></td>
    <td><?=$price?> руб.</td>
    <td> 
        <div class="input_numbers">
          <button type="button" class="btn btn-primary" onclick="item(<?= $id?>)">+</button>
          <input class="form-control" type="text" name="numbers" id="count<?= $id?>" onchange="change(<?=$id?>)" value="<?=$numbers?>" style="width: 50px;">
          <button  type="button" class="btn btn-primary" onclick="deleteItem(<?=$id?>)">-</button> 
        </div> 
    </td>
</tr>