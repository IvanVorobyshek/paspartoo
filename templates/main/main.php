<?php include_once __DIR__ . "/../header.php"; ?>

<div class="content">
    <h1>COUNTER</h1>
    <div class="counter">
        <div>
            <p class="negativeposts"><?= $postsInfo['negative_posts']; ?></p>
            <p>Negative Posts</p>
        </div>
        <div>
            <p class="allposts"><?= $postsInfo['all_posts']; ?></p>
            <p>All Posts</p>
        </div>
        <div>
            <p class="positiveposts"><?= $postsInfo['positive_posts']; ?></p>
            <p>Positive Posts</p>
        </div>
    </div>

    <h1>POSTS</h1>
    <!-- Add POST -->
    <div class="form">
        <form method="post" class="post_form" id="post" action="/addpost">
            <label class="label_inp">Name</label><input class="inp" id="post_author_name" type="text" name="visitore_name" required />
            <br />
            <label class="label_inp">Text</label>
            <textarea class="inp_text" id="post_text" name="post" required></textarea>
            <br />
            <input class="btn btn_add_post" type="submit" value="Add Post" />
        </form>
    </div>
    <div class="posts">
        <!-- open window to add POST -->
        <div class="post_btn">
            <input class="btn open_post_window" type="submit" value="Add Post" onclick="showAddPost()" />
        </div>
        <hr>
        <div class="posts">
            <?php
            if ($posts != Null) :
                foreach ($posts as $post) :
                    // var_dump($post);
            ?>
                    <div class="post">
                        <p>by <?= $post['visitore_name']; ?></p>
                        <input class="btn" type="submit" name="" value="Add Comment" onclick="showAddComment(<?= $post['id']; ?>)" />
                        <p><?= $post['post']; ?></p>
                        <div class="form__item">
                            <div data-ajax=true class="rating rating_set">
                                <input class="hidden_id" value="<?= $post['id'];?>" hidden />
                                <div class="rating__body">
                                    <div class="rating__active"></div>
                                    <div class="rating__items">
                                        <input type="radio" class="rating__item" value="1" name="rating">
                                        <input type="radio" class="rating__item" value="2" name="rating">
                                        <input type="radio" class="rating__item" value="3" name="rating">
                                        <input type="radio" class="rating__item" value="4" name="rating">
                                        <input type="radio" class="rating__item" value="5" name="rating">
                                    </div>
                                </div>
                                <div name="rate" class="rating__value"><?= round($post['rating'], 2); ?></div>
                            </div>
                        </div>
                        <p class="date"><?= $post['created_at']; ?></p>
                    </div>
                    <?php
                    if ($post['comments'] != Null) :
                        foreach ($post['comments'] as $comment) :
                            // var_dump($comment);
                    ?>
                            <div class="comment">
                                <p>by <?= $comment['visitore_name']; ?></p>
                                <p><?= $comment['comment']; ?></p>
                                <br>
                                <p class="date"><?= $comment['created_at']; ?></p>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Add COMMENT -->
        <div class="form">
            <form method="post" class="comment_form" action="/addcomment">
                <label class="label_inp">Name</label><input class="inp" id="comment_author_name" type="text" name="visitore_name" required />
                <br />
                <input class="inp" id="post_id" type="text" name="post_id" required hidden />
                <label class="label_inp">Text</label>
                <textarea class="inp_text" id="comment_text" name="comment" required></textarea>
                <br />
                <input class="btn btn_add_comment" type="submit" value="Add Comment" />
            </form>
        </div>
    </div>
</div>
<hr>
<?php
//Task 1, task 2
echo 'Task 1<br>';
$num = 5;

function arrows(int $num):string{
    $str = '';
    for($i = 1; $i <= $num; $i++){
        $str = '<' . $str. '>';
    }
    return $str;
}
echo arrows($num);
echo '<br>';
//or
echo str_repeat('<', $num).str_repeat('>', $num);
echo '<br><br>';

echo 'Task 2';
function sortDeliveryMethods($arr):array{
    $sortArr = [];
    foreach ($arr as $arr1){
        foreach ($arr1['customer_costs'] as $key => $value){
            $sortArr[$key][$arr1['code']] = $value;
        }
    }
    return $sortArr;
}

$deliveryMethodsArray = [
    [
        'code' => 'dhl',
        'customer_costs' => [
            22 => '1.000', 
            11 => '3.000',
        ]
    ],
    [
        'code' => 'fedex',
        'customer_costs' => [
            22 => '4.000',
            11 => '6.000',
        ]
    ]
];
$result = sortDeliveryMethods($deliveryMethodsArray);
echo '<pre>';
var_dump($result);
echo '</pre>';
?>
<?php include_once __DIR__ . "/../footer.php"; ?>