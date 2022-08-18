<?php

namespace Project\Controllers;

use Project\View\View;
use Project\Services\Db;
use Project\Models\Post;
use Project\Models\Comment;

class MainController{
    private $view;

    public function __construct(){
        $this->view = new View(__DIR__."/../../../templates");
    }

    public function main(){
        $db = Db::getInstance();
        $table1 = 'posts';
        $table2 = 'comments';
        $posts = $db->selectPostsComments($table1);
        $comments = $db->selectPostsComments($table2);
        $postsCNP = $db->selectCountNegPos($table1);//count all positive negative POSTS
        // $all_posts = $db->selectCountAll($table1);
        // $negative_posts = $db->selectCountNegative($table1);
        // $positive_posts = $db->selectCountPositive($table1);
        //making posts and comments in one array
        $comm = [];
        foreach ($comments as $comment){
            $comm[$comment['post_id']][] = [
                'visitore_name' => $comment['visitore_name'],
                'comment' => $comment['comment'],
                'created_at' => $comment['created_at']
            ];
        }
        foreach ($posts as &$post){
            $post['comments'] = $comm[$post['id']];
        }
        $postsInfo = [
            'negative_posts' => $postsCNP['negative_posts'],
            'positive_posts' => $postsCNP['positive_posts'],
            'all_posts' => $postsCNP['all_posts']
        ];
        $this->view->renderHTML('/main/main.php', ['posts' => $posts, 'postsInfo' => $postsInfo]);
    }

    public function addPost(){
        //проверить name i text на правильность
        $name = $_POST['visitore_name'];
        $text = $_POST['post'];
        $post = new Post($name, $text);
        $postData = $post->varsToSavePost();
        $db = Db::getInstance();
        $table = 'posts';
        $result = $db->addOnePost($table, $postData);
        header('Location: /');
    }

    public function addComment(){
        //проверить name i text на правильность
        $name = $_POST['visitore_name'];
        $post_id = $_POST['post_id'];
        $text = $_POST['comment'];
        $comment = new Comment($post_id, $name, $text);
        $commentData = $comment->varsToSaveComment();
        $db = Db::getInstance();
        $table = 'comments';
        $result = $db->addOnePost($table, $commentData);
        header('Location: /');
    }

    public function addRating(){
        $rating = (int)$_POST['rating'];
        $id = (int)$_POST['hid_id'];
        if (($rating > 5) or ($rating < 1)){
            $result['error'] = 'Rating must be from 1 to 5 stars';
            $result['good'] = false;
            echo json_encode($result);
            exit();
        }
        $db = Db::getInstance();
        $table = 'posts';
        $res = $db->changePostRating($table, $id, $rating);
        $result = $db->selectCountNegPos($table);//count all positive negative POSTS
        // $all_posts = $db->selectCountAll($table);
        // $negative_posts = $db->selectCountNegative($table);
        // $positive_posts = $db->selectCountPositive($table);
        // $result = [
        //     'negative_posts' => $negative_posts,
        //     'positive_posts' => $positive_posts,
        //     'all_posts' => $all_posts
        // ];
        $result['newRating'] = $res;
        $result['good'] = true;
        echo json_encode($result);

    }
}
?>