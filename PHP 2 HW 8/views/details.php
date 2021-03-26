<?php if($isAdmin): ?>
<h2>Подробности заказа <?=$username?>: </h2>
<form action="/admin/status" method="post">
    <select name="status" >
        <option <?php if ($statusNow == "Новый") echo 'selected'?>><b>Новый</b></option>
        <option <?php if ($statusNow == "В работе") echo 'selected'?>><b>В работе</b></option>
        <option <?php if ($statusNow == "Передан в службу доставки") echo 'selected'?>><b>Передан в службу доставки</b></option>
        <option <?php if ($statusNow == "Отменён") echo 'selected'?>><b>Отменён</b></option>
        <option <?php if ($statusNow == "Выполнен") echo 'selected'?>><b>Выполнен</b></option>
    </select>
    <input type="text" name="order_id" hidden value="<?=$order_id?>">
   <input type="submit" name="refresh" value="Обновить статус заказа">
</form>
<?php if(!empty($details)) : foreach($details as $item):?>

    <div>
        <h3><?=$item['name']?></a></h3>

        <img src="/image/small/<?= $item['image'] ?>" width="150" alt="image"/><br>

        <p>Стоимость: <?=$item['price']?>  руб.</p>

        <hr>
    </div>
<?php endforeach; ?>
    <b>Итого к оплате на момент заказа: <?=$orderamount?> руб. </b>
<?php else : ?>
    <h3>Корзина пуста.</h3>
<? endif; ?>
<?php endif; ?>


