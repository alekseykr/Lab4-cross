<?php

class User
{
    protected $name;
    protected $surname;

    function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public function welcome()
    {
        $welcome = [
            "ru" => "Здравствуйте, ",
            "en" => "Hello, ",
            "ua" => "Добрий день, "
        ];
        return $welcome;
    }
}

class Admin  extends User
{
    public function adminwelcome($lang)
    { 
        if($lang=="ru"){
            echo "<h3>Панель админа</h3>";?></br><?php
            echo parent::welcome()['ru'] . "админ " . $this->name . " " . $this->surname . ". Вы можете на сайте делать всё.";
            ?></br>
            <button type="submit" onclick="window.location.href='../personal_area/Users_list.php'">Список пользователей</button>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Выход</button>
            <?php
        } 
        if ($lang=="en"){
            echo "<h3>Admin panel</h3>";?></br><?php
            echo parent::welcome()['en'] . "admin " . $this->name . " " . $this->surname . ". You can do everything on the site.";
            ?></br>
                        <button type="submit" onclick="window.location.href='../personal_area/Users_list.php'">Users list</button>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Exit</button>
            <?php
        }
        if ($lang=="ua"){
            echo "<h3>Панель адміністратора</h3>";?></br><?php
            echo parent::welcome()['ua'] . "адмiн " . $this->name . " " . $this->surname . ". Ви можете на сайті робити все.";
            ?></br>
            <button type="submit" onclick="window.location.href='../personal_area/Users_list.php'">Cписок користувачів</button>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Вихід</button>
            <?php
        }
        
    }
}

class Client extends  User
{
    public function clientwelcome($lang)
    {
        if($lang=="ru"){
            echo"<h3>Панель клиента</h3>";?></br><?php
            echo parent::welcome()['ru'] . "клиент " . $this->name . " " . $this->surname . ". Вы можете на сайте просматривать информацию доступную пользователям.";
            ?></br>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Выход</button>
            <?php
        }
        if ($lang=="en"){
            echo "<h3>Client panel</h3>";?></br><?php
            echo parent::welcome()['en'] . "client " . $this->name . " " . $this->surname . ". You can view information available to users on the site.";
            ?></br>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Exit</button>
            <?php
        }
        if ($lang ==="ua"){
            echo "<h3>Панель кліента</h3>";?></br><?php
            echo parent::welcome()['ua'] . "кліент " . $this->name . " " . $this->surname . ". Ви можете на сайті робити все.";
            ?></br>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Вихід</button>
            <?php
        }
    }
}

class Manager  extends User
{
    public function managerwelcome($lang)
    {
        if($lang=="ru"){
            echo"<h3>Панель менеджера</h3>";?></br><?php
            echo parent::welcome()['ru'] . "менеджер " . $this->name . " " . $this->surname . ". Вы можете на сайте изменять, удалять и создавать клиентов.";
            ?></br> 
            <button type="submit" onclick="window.location.href='../personal_area/Users_list.php'">Список пользователей</button>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Выход</button>
            <?php
        }
        if ($lang == "en"){
            echo"<h3>Manager panel</h3>";?></br><?php
            echo parent::welcome()['en'] . "manager " . $this->name . " " . $this->surname . ". You can change, delete and create clients on the site.";
            ?></br>
            <button type="submit" onclick="window.location.href='../personal_area/Users_list.php'">Users list</button>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Exit</button>
            <?php
        }
        if ($lang == "ua"){
            echo"<h3>Панель менеджера</h3>";?></br><?php
            echo parent::welcome()['ua'] . "менеджер " . $this->name . " " . $this->surname . ". Ви можете на сайті змінювати, видаляти і створювати клієнтів.";
            ?></br>
            <button type="submit" onclick="window.location.href='../personal_area/Users_list.php'">Cписок користувачів</button>
            <button type="submit" onclick="window.location.href='../auth/logout.php'">Вихід</button>
            <?php
        }
    }
    
}
