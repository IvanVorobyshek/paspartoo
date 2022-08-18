<?php
namespace Project\Models;

class Post{
    protected ?int $id = null;
    protected string $visitore_name;
    protected string $post;
    protected int $count;
    protected int $sum;
    protected float $rating;
    protected string $created_at;

    public function __construct(string $visitore_name, string $post, int $id = null, int $count = 0, int $sum = 0, float $rating = 0, string $created_at = ''){
        $this->id = $id;
        $this->visitore_name = $visitore_name;
        $this->post = $post;
        $this->count = $count;
        $this->sum = $sum;
        $this->rating = $rating;
        $this->created_at = $created_at;
    }

    public function varsToSavePost():array{
        $res = [];
        $res['id'] = $this->id;
        $res['post'] = $this->post;
        $res['visitore_name'] = $this->visitore_name;
        return $res;
    }

    // static function varsToSelectPosts(){
    //     return '(id, name, post, rating, created_at)';
    // }

    // public function getRate():float{
    //     if ($this->count == 0){
    //         return 0;
    //     } else {
    //         return round($this->sum / $this->count, 2);
    //     }
    // }

    // public function getObjectVars(){
    //     return get_object_vars($this);
    // }
    
}



?>