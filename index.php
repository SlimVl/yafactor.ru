<!DOCTYPE html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="main.css">
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script type="text/javascript">

            jQuery(function($) {

                $(".w3-button").click(function() {
                    // получаем строку, которую ввел пользователь
                    var searchString    = $(".w3-input").val();

                    // формируем поисковый запрос
                    var data = 'search='+ searchString;

                    // если введенная информация не пуста
                    if(searchString) {

                        // вызов ajax
                        $.ajax({
                            type: "POST",
                            url: "search.php",
                            data: data,
                            beforeSend: function(html) { // действие перед отправлением
                                $("#results").html('');
                                $("#searchresults").show();
                                $(".word").html(searchString);
                            },
                            success: function(html){ // действие после получения ответа
                                console.log(searchString);
                                $("#results").show();
                                $("#results").append(html);
                            }
                        });
                    }
                    return false;
                });
            });
        </script>
    </head>
<body>
    <div class="w3-top">
        <div id="main-nav" class="w3-row w3-padding w3-black">
            <div class="menu-item ">
                <a href="/yafactor.ru/" class="w3-buttons w3-block w3-black">Home</a>
            </div>

            <div class="menu-item ">
                <a href="/slice" class="w3-buttons w3-block w3-black">All Slices</a>
            </div>

            <div class="menu-item ">
                <a href="/tag" class="w3-buttons w3-block w3-black">All Tags</a>
            </div>

            <div class="menu-item ">
                <a href="/yafactor.ru/group.php" class="w3-buttons w3-block w3-black">All Groups</a>
            </div>

            <div class="menu-item ">
                <a href="search.php" class="w3-buttons w3-block w3-black">Search</a>
            </div>

            <div class="menu-item w3-hide-small">
                <form action="search.php" method="POST" class="w3-container w3-padding-0 w3-margin-0" style="display: flex;">
                    <input type="text" name="search" class="w3-input" style="border-radius: 10px 0 0 10px;" placeholder="Search">
                    <button type="submit" class="w3-button w3-dark-gray" style="border-radius: 0 10px 10px 0;">Go</button>
                </form>
            </div>
        </div>
    </div>
    <div style="text-align: center">
        <div id="searchresults">Результат поиска для <span class="word"></span></div>
        <ul id="results" class="update">
        </ul>
    </div>
    </body>
</html>

<?php

