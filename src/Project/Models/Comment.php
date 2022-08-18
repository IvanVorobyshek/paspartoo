<?php
namespace Project\Models;

class Comment{
    protected ?int $id = null;
    protected int $post_id;
    protected string $visitore_name;
    protected string $comment;
    protected string $created_at;


public function __construct(int $post_id, string $visitore_name, string $comment, int $id = null, string $created_at=''){
    $this->id = $id;
    $this->post_id = $post_id;
    $this->visitore_name = $visitore_name;
    $this->comment = $comment;
    $this->created_at = $created_at;
}

public function varsToSaveComment():array {
    $res = [];
    $res['id'] = $this->id;
    $res['post_id'] = $this->post_id;
    $res['comment'] = $this->comment;
    $res['visitore_name'] = $this->visitore_name;
    return $res;
}

}
?>