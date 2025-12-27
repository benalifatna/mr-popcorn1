<?php
session_start();
?>
<?php include_once __DIR__ . "/../partials/head.php";?>
<?php include_once __DIR__ . "/../partials/nav.php";?> 

    <!-- Main -->
     <main class="container">
        <h1 class="text-center display-5 my-3">Liste des films</h1>
        <div class="d-flex justify-content-end align-items-center my-3">
            <a href="/create.php" class="btn btn-primary shadow">&#43; Ajouter film</a>
        </div> 

        <?php if (isset($_SESSION['success']) && !empty($_SESSION['success']) ) : ?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <?=  $_SESSION['success']; ?>
                 <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif ?>
     </main>

    <?php include_once __DIR__ . "/../partials/footer.php";?>
    <?php include_once __DIR__ . "/../partials/foot.php";?>
    
