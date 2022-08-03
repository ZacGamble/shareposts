<?php require APPROOT . '/views/inc/header.php' ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light my-3 hover"><i class="mdi mdi-skip-backward"></i>Back</a>
<br>
<div class="row">
    <h1><?php echo $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 my-3">
        Authored by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
    </div>
    <p><?php echo $data['post']->body; ?></p>

    <?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <div class="d-flex justify-content-between">

            <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

            <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post" class="">
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
    <?php endif; ?>

</div>

<div class="row">
    <div class="mt-4">
        <h3>Comments</h3>
        <form action="<?php echo URLROOT; ?>/posts/addComment/<?php echo $data['post']->id; ?>" method="POST">
            <div class="d-flex flex-column">

                <textarea class="p-2" name="body" placeholder="Add comment here..." cols="30" rows="4"></textarea>
                <button class="btn btn-info ms-auto mt-2">Comment</button>
            </div>
        </form>
    </div>


    <?php foreach ($data['comments'] as $comment) : ?>
        <div class="p-5">
            <div class="comment-box border shadow rounded">
                <span class="fs-3 fw-bold p-3"><?php echo $comment->username ?> says:</span>
                <p class="p-4 fs-5"><?php echo $comment->body ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>


<?php require APPROOT . '/views/inc/footer.php' ?>

<style>
    textarea {
        border-radius: 10px;
        box-shadow: 2px 2px 2px gray;
        color: whitesmoke;
        background-color: black;
        text-shadow: 1px 1px 10px white;
        font-weight: 800;
    }

    textarea::placeholder {
        color: whitesmoke;
        text-shadow: 1px 1px 10px white;
        transform: skew(-10deg);
        font-weight: 900;
    }
</style>