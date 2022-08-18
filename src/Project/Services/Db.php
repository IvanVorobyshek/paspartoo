<?php
    namespace Project\Services;

    use Project\Services\Config;

    class Db
    {
        private \PDO $pdo;

        private static ?self $instance = null;

        private function __construct()
        {
            $this->pdo = new \PDO(
                'mysql:host=' . Config::HOST . ';dbname=' . Config::DBNAME,
                Config::DBUSER,
                Config::DBPASS
            );
            $this->pdo->exec('SET NAMES UTF8');
        }

        public static function getInstance():self{
            if (self::$instance === null){
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function getLastInsertId():int
        {
            return (int) $this->pdo->lastInsertId();
        }

        public function selectPostsComments(string $table){
            $sql = 'SELECT * FROM `'.$table.'`';
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
            return $results;
        }

        public function selectCountNegPos(string $table){
            $sql = 'SELECT SUM(IF(rating >= '.Config::STARRATINGPOSITIVE.', 1, 0)) AS positive_posts, SUM(IF(rating <= '.Config::STARRATINGNEGATIVE.', 1, 0)) AS negative_posts, COUNT(*) AS all_posts FROM `'.$table.'`';
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            $results = $sth->fetch(\PDO::FETCH_ASSOC);
            return $results;

        }

        public function selectCountAll(string $table){
            $sql = 'SELECT count(*) FROM `'.$table.'`';
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            $result = $sth->fetchColumn(0);
            return $result;
        }

        public function selectCountPositive(string $table){
            $sql = 'SELECT count(*) FROM `'.$table.'` WHERE rating >= '.Config::STARRATINGPOSITIVE;
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            $result = $sth->fetchColumn(0);
            return $result;            
        }

        public function selectCountNegative(string $table){
            $stars = 2;
            $sql = 'SELECT count(*) FROM `'.$table.'` WHERE rating <= '.$stars;
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            $result = $sth->fetchColumn(0);
            return $result;  
        }

        public function addOnePost($table, $postData){
            //insert product into database
            $columns = [];
            $params = [];
            $paramsAndValues = [];
            $index = 1;
            foreach ($postData as $key => $value) { 
                $columns[] = $key;
                $params[] = ':param' . $index;
                $paramsAndValues[':param' . $index] = $value;
                $result[$key] = $value;
                $index++;
            }
            $sql = 'INSERT INTO `'.$table.'` (' . implode(', ', $columns). ') VALUES ('. implode(', ', $params) .')';
            $sth = $this->pdo->prepare($sql);
            $res = $sth -> execute($paramsAndValues);
            if ((false === $res) or ($this->getLastInsertId() < 1)){
                $result['error_db'] = 'Sorry, Failed to insert data into database!';
                $result['error'] = true;
            }
            return $result;
        }

        public function changePostRating($table, $id, $rating){
            $sql = 'SELECT `count`, `sum` FROM `'.$table.'` WHERE id='.$id;
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
            $results[0]['count'] += 1;
            if ($results[0]['count'] < 1){
                $results[0]['count'] = 1;
            }
            $results[0]['sum'] += $rating;
            $rate = round($results[0]['sum']/$results[0]['count'], 2);
            $sql = 'UPDATE `'.$table.'` SET `count` = '.$results[0]['count'].', `sum` = '.$results[0]['sum'].', `rating` = '.$rate.' WHERE id='.$id;
            $sth = $this->pdo->prepare($sql);
            $sth -> execute();
            return $rate;
        }
    }


?>