<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/style.css">
    <title>Posts</title>
</head>

<body>
    
    <!-- <form action="#" class="form form_margin"> -->
        <div class="form__item">
            <div class="form__label">Точный рейтинг: </div>
            <div data-ajax=true class="rating rating_set">
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
                <div class="rating__value">1.6</div>
            </div>
        </div>
        <!-- <button type="submit" class="form__btn btn">SEND</button> -->
    <!-- </form> -->

    <div class="content">
        <h1>COUNTER</h1>
        <div class="counter">
            <div class="negposts">
                <p>20</p>
                <p>Negative Posts</p>
            </div>
            <div class="allposts">
                <p>40</p>
                <p>All Posts</p>
            </div>
            <div class="posposts">
                <p>20</p>
                <p>Positive Posts</p>
            </div>
        </div>
        <!-- <input type="submit" onclick="showAddPost()" /> -->
        <h1>POSTS</h1>
        <!-- Add POST -->
        <div class="form">
            <form method="post" class="post_form" id="post">
                <label class="label_inp">Name</label><input class="inp" id="post_author_name" type="text" name="name" required />
                <br />
                <label class="label_inp">Text</label>
                <textarea class="inp_text" id="post_text" name="text" required></textarea>
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
                <div class="post">
                    <p>by user1</p>
                    <input class="btn" type="submit" value="Add Comment" onclick="showAddComment()" />
                    <p>
                        First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!!
                        First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!!
                        First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!! First post!!!

                    </p>
                    <p>☆☆☆☆☆</p>
                    <p class="date">25.02.2022</p>
                </div>
                <div class="comment">
                    <p>by user2</p>
                    <p>
                        First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!!
                        First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!! First Comment!!!
                    </p>
                    <br>
                    <p class="date">25.02.2022</p>
                </div>

            </div>

            <!-- Add COMMENT -->
            <div class="form">
                <form method="post" class="comment_form">
                    <label class="label_inp">Name</label><input class="inp" id="comment_author_name" type="text" name="name" required />
                    <br />
                    <label class="label_inp">Text</label>
                    <textarea class="inp_text" id="comment_text" name="text" required></textarea>
                    <br />
                    <input class="btn btn_add_comment" type="submit" value="Add Comment" />
                </form>
            </div>
        </div>
    </div>
</body>
<script src="/script.js" type="text/javascript"></script>

</html>