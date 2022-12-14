<?php require APPROOT . '/views/inc/header.php' ?>
<?php flash('post_message'); ?>

<div class="row mb-4 justify-content-between d-flex">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <div class="d-flex welcome-container">

            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="mdi mdi-pencil"></i> Add Post
            </a>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <span class="welcome-user">Welcome <?php echo $_SESSION['user_name']; ?>!</span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3 post-card shadow rounded">
        <div class="d-flex justify-content-between">
            <h4 class="card-title"><?php echo $post->title ?></h4>
            <a href="<?php echo URLROOT; ?>/pages/profile/<?php echo $post->userId; ?>"><?php echo 'Go to ' . $post->name . "'s profile" ?></a>
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

                <form action="<?php echo URLROOT; ?>/posts/likePost/<?php echo $post->postId; ?>" method="post" class="me-5">
                    <button type="submit" class="btn btn-info">Like! </button>
                </form>
                <div class="move">Total likes: <span class="fs-2 fw-bold"><?= $post->likes ?></span> </div>
            </div>
        </div>
    </div>


<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php' ?>