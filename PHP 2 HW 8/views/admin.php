<?php if($isAdmin): ?>
<h2>Управление</h2>
<!-- в шаблон приходят готовые значения переменных из контроллера, а контроллер их берёт из модели -->
<?php if(!empty($admin)) : foreach($admin as $item):?>
    <div>
        <h3><a href="/admin/details/?basketid=<?=$item['session_id']?>&statusnow=<?=$item['status']?>&order_id=<?=$item['id']?>&username=<?=$item['name']?>&orderamount=<?=$item['orderAmount']?>">Подробности заказа</a></h3>
        <span>Имя покупателя: <?=$item['name']?></span><br>
        <span>Телефон: <?=$item['phone']?></span><br>
        <span>Email: <?=$item['email']?></span><br>
        <span>Сумма заказа: <?=$item['orderAmount']?>  руб.</span><br>
        <span>Статус заказа: <?=$item['status']?></span><br>
        <hr>
    </div>
<?php endforeach; ?>
<?php else : ?>
    <h3>Извините, заказов нет!</h3>
<? endif; ?>
<?php endif; ?>
