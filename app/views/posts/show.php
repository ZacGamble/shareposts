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


<?php require APPROOT . '/views/inc/footer.php' ?>