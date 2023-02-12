<?php

include_once "config/boot.php";
$database = new Database();
$db = $database->getConnection();

if (isset($_POST['search']))
{
    $word = $_POST['search'];

    // формирование поискового запроса к базе
    $sth = $db->prepare("SELECT * FROM `factor` WHERE `CppName` LIKE '%" . $word . "%' OR `Name` LIKE '%" . $word . "%' OR `Tags` LIKE '%" . $word . "%' OR `Group` LIKE '%" . $word . "%'");
    $sth->execute();
    // получение результатов
    $row = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(count($row))
    {
        $end_result = '';
        foreach($row as $r)
        {
            $result = $r['CppName'] . ' | ' . $r['Name'] . ' | ' . $r['Tags'];
            // выделим найденные слова
            $bold = '<span class="found">' . $word . '</span>';
            $end_result .= '<li>' . str_ireplace($word, $bold, $result) . '</li>';
        }
        echo $end_result;
    }
    else
    {
        echo '<li>Ничего не найдено</li>';
    }
}
?>