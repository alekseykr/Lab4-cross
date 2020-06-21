<?php
session_start();
include "../database/db.php";
include "../classes/class_user_list.php";
include "../auth/definitions_user.php";
if (!isset($_SESSION['id']) || $_SESSION['role']==1) {
    exit(header('location:../auth/login.php'));
}
$translate = [
    'back' => [
        'ru' => 'Назад',
        'en' => 'Back',
        'ua' => 'Назад'
    ],
    'search' => [
        'ru' => 'Поиск',
        'en' => 'Search',
        'ua' => 'Пошук'
    ],
    'what_search' => [
        'name' => [
            'ru' => 'Имя',
            'en' => 'Name',
            'ua' => 'Ім\'я'
        ],
        'surname' => [
            'ru' => 'Фамилия',
            'en' => 'Surname',
            'ua' => 'Прізвище'
        ],
        'login' => [
            'ru' => 'Логин',
            'en' => 'Login',
            'ua' => 'Логін'
        ],
        'lang' => [
            'ru' => 'Язык',
            'en' => 'Language',
            'ua' => 'Мова'
        ],
        'role' => [
            'ru' => 'Роль',
            'en' => 'Role',
            'ua' => 'Роль'
        ]
    ]
]
?>
<form action="" method="POST">
    <?php echo $translate['search'][$_SESSION['lang']]; ?>
    <select name="what_search" id="select">
        <option value="name"><?php echo $translate['what_search']['name'][$_SESSION['lang']]; ?></option>
        <option value="surname"><?php echo $translate['what_search']['surname'][$_SESSION['lang']]; ?></option>
        <option value="login"><?php echo $translate['what_search']['login'][$_SESSION['lang']]; ?></option>
        <option value="lang"><?php echo $translate['what_search']['lang'][$_SESSION['lang']]; ?></option>
        <option value="role"><?php echo $translate['what_search']['role'][$_SESSION['lang']]; ?></option>
        <option value="id">id</option>
    </select>
    <input name="search" type="text" id="search">
    <button type="submit">ok</button>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
if($_SESSION['role']==3){
?>
<script>
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "GET",
            url: "User_list_panel/search.php",
            data: {
                search: $("#search").val(),
                select: $("#select").val(),
         
            },
        }).done(function(data){
            $('tr:gt(0)').remove()
            $.each(JSON.parse(data),function(index,value){
                $("table").append(
                "<tr><td><b>"+value.name+
                "</b></td><td><b>"+value.surname+
                "</b></td><td><b>"+value.login+
                "</b></td><td><b>"+value.lang+
                "</b></td><td><b>"+value.role+
                "</b></td><td><b>"+value.id+
                "</b></td><td><b><form action='../personal_area/User_list_panel/edit.php' method='POST'><button name='edit_id' value="+value.id+" type='number' >Редактировать</button></form></b></td></b></td><td><b><form action='../personal_area/User_list_panel/delete.php' method='POST'><button name='delete' value="+value.id+" type='number'>Удалить</button></form></b></td></tr>"
                )
                console.log(value)
            })
        });
    })
</script>
<?php
}
else{
    ?>
    <script>
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "GET",
            url: "User_list_panel/search.php",
            data: {
                search: $("#search").val(),
                select: $("#select").val(),
         
            },
        }).done(function(data){
            $('tr:gt(0)').remove()
            $.each(JSON.parse(data),function(index,value){
                $("table").append(
                "<tr><td><b>"+value.name+
                "</b></td><td><b>"+value.surname+
                "</b></td><td><b>"+value.login+
                "</b></td><td><b>"+value.lang+
                "</b></td><td><b>"+value.role+
                "</b></td><td><b>"+value.id+"</b></td></tr>"
                )
                console.log(value)
            })
        });
    })
</script>
    <?php
}
    $users = mysqli_query($db_phpmyadmin->connect(), "SELECT * FROM `users`");
    $adminUserList = new UserList();
    $i = 0;
?>
    <table border="1">
        <?php
        while ($user = mysqli_fetch_assoc($users)) {
        ?>
            <tr>
                <?php
                if ($i == 0) {
                    $adminUserList->UserListInfo($_SESSION['lang'], 0,0);
                ?>
                    <th>Id</th>
                <?php
                }
                ?>
            </tr>
            <tr>
                <th>
                    <?php echo $user['name']; ?>
                </th>
                <th>
                    <?php echo $user['surname']; ?>
                </th>
                <th>
                    <?php echo $user['login']; ?>
                </th>
                <th>
                    <?php echo $user['lang']; ?>
                </th>
                <th>
                    <?php echo $user['role']; ?>
                </th>
                <th>
                    <?php echo $user['id']; ?>
                </th>
                <?php
                if ($_SESSION['role'] == 3) {
                    $adminUserList->UserListEdit($_SESSION['lang'], $user['id']);
                    if ($_SESSION['id'] == $user['id']) {
                        continue;
                    }
                    $adminUserList->UserListDelete($_SESSION['lang'], $user['id']);
                }
                ?>
            </tr>
        <?php
            $i++;
        }
        ?>
    </table>
<?php

if (isset($_SESSION['message_list'])) {
    echo '<p>' . $_SESSION['message_list'] . '</p>';
    unset($_SESSION['message_list']);
}
$adminUserList->UserListCreate($_SESSION['lang'], $user['id']);
?>
<button type="submit" onclick="window.location.href='../'"><?php echo $translate['back'][$_SESSION['lang']] ?></button>
<?php
