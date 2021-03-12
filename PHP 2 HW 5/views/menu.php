<?php if ($isAuth): ?>
    <h4>Приветствую Вас, <?= $userName ?>! <a class="exit"  href="/auth/logout">[Выход]</a></h4>
<?php else: ?><br><br>
    <form action="/auth/login" method="post" > <!-- <form action="/auth/login имя класса/метода.
    Контроллера который  будет обрабатывать этот запрос, имя метода в которое будет передано управление -->
          <input type="text" name="login" placeholder="Логин:">
         <input type="password" name="pass" placeholder="Пароль:">
        Сохранить? <input type="checkbox" name="save"> <input type="submit" value="Войти">
    </form>
<?php endif; ?><br>
    <!-- берем от пользователя данные, они отсюда уходят в Users методом пост, а сюда приходят данные из Controller.php  -->
    <!-- $userName $isAuth -->
    <!-- Пользуясь ООП просто представляем себе один объект, его поля и методы и всё, всё остальное- взаимодействие между объектами -->


<a href="/">Главная</a>
<a href="/product/catalog">Каталог</a><!-- каталогом будет заниматься контроллер product, и в нём будет action, по умолчанию будем ипольз.index -->
<a href="/basket">Корзина</a>  <!-- /controller/action/?any value -->
