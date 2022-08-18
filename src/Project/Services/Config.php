<?php
    namespace Project\Services;

    class Config{
        public const HOST = 'localhost';
        public const DBNAME = 'paspartoo';
        public const DBUSER = 'paspartoo';
        public const DBPASS = '12345678';
        public const STARRATINGNEGATIVE = 2;//higher limit for negative rating
        public const STARRATINGPOSITIVE = 4;//lower limit for positive rating
        public const ROUTES = [
            '~^$~' => [\Project\Controllers\MainController::class, 'main'],//main page
            '~^addpost(/*)$~' => [\Project\Controllers\MainController::class, 'addPost'],//add post
            '~^addrating(/*)$~' => [\Project\Controllers\MainController::class, 'addRating'],//change rating
            '~^addcomment(/*)$~' => [\Project\Controllers\MainController::class, 'addComment'],//add comment
        ];
    }
?>