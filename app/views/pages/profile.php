<?php require APPROOT . '/views/inc/header.php' ?>
<?php flash('post_message'); ?>

<h1><?php echo $data['user']->name; ?>'s posts</h1>
<div class="mt-5"></div>


<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3 post-card shadow rounded">
        <div class="d-flex justify-content-between">
            <h4 class="card-title"><?php echo $post->title ?></h4>
            <?php if ($_SERVER["REQUEST_URI"] == 'shareposts/pages/profile/' . $post->user_id) : ?>
                <a href="<?php echo URLROOT; ?>/pages/profile/<?php echo $post->userId; ?>"><?php echo 'Go to ' . $post->name . "'s profile" ?></a>
            <?php endif; ?>
        </div>
        <div class="bg-light p-2 mb-3">
            Authored by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <div class="d-flex justify-content-between">

            <div>
                <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
            </div>
            <div class="d-flex">

                <form action="<?php echo URLROOT; ?>/posts/likePostFromProfile/<?php echo $post->postId; ?>" method="post" class="me-5">
                    <button type="submit" class="btn btn-info">Like! </button>
                </form>
                <div class="move">Total likes: <span class="fs-2 fw-bold"><?= $post->likes ?></span> </div>
            </div>
        </div>
    </div>


<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>

<?php
