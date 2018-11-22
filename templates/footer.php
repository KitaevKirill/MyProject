</td>

<td width="300px" class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <ul>
        <li><a href="/">Главная страница</a></li>
        <li><a href="/about-me">Обо мне</a></li>
        <?php if (isset($user)): ?>
            <li><a href="/personalArea">Войти в личный кабинет</a></li>
        <?php endif; ?>
        <?php if (isset($user) && $user->isAdmin()): ?>
            <li><a href="/articles/add">Добавить статью</a></li>
            <li><a href="/adminPanel">Войти в панель Администратора</a></li>
        <?php endif; ?>
    </ul>
</td>
</tr>
<tr>
    <td class="footer" colspan="2">Все права защищены (c) Мой блог</td>
</tr>
</table>

</body>
</html>