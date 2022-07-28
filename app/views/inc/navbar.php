<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container nav-style">
        <a class="navbar-brand nav-item" href="<?php echo URLROOT ?>"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
                </li>


                <?php if (isset($_SESSION['user_id'])) : ?>

                    <li class="nav-item logout">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
                    </li>

                <?php else : ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
                    </li>
            </ul>
        <?php endif; ?>

        </div>
    </div>
</nav>