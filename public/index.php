<?php
session_start();

require_once __DIR__ . "/../functions/helpers.php";
require_once __DIR__ . "/../functions/db.php";
require_once __DIR__ . "/../functions/views.php";

$films = getfilms();

// dd($films);


?>
<?php include_once __DIR__ . "/../partials/head.php";?>
<?php include_once __DIR__ . "/../partials/nav.php";?> 

    <!-- Main -->
     <main class="container">
        <h1 class="text-center display-5 my-3">Liste des films</h1>
        <div class="d-flex justify-content-end align-items-center my-3">
            <a href="/create.php" class="btn btn-primary shadow">&#43; Ajouter film</a>
        </div> 

        <?php if (count($films) > 0) : ?>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">

                <?php if (isset($_SESSION['success']) && !empty($_SESSION['success']) ) : ?>
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <?=  $_SESSION['success']; ?>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
                <?php endif ?>

                 <?php foreach($films as $film) : ?>

                    <article class="film-card bg-white shadow rounded p-3 mb-4">
                        <h2>Titre : <?=  htmlspecialchars( $film['title'])?></h2>
                        <p><strong>Note : </strong><?= isset($film['rating']) && ($film['rating'] !== "") ? displayStars(htmlspecialchars((float) $film['rating'])) : "Non renseignée" ?></p>
                        <hr>
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <a href="" class="btn btn-sm btn-dark">Voir détails</a>
                            <a href="" class="btn btn-sm btn-secondary">Modifier</a>
                            <a href="" class="btn btn-sm btn-danger">Suprrimer</a>
                        </div>

                    </article>
                    <?php endforeach ?>
                </div>

            </div>

        </div>
        <?php else : ?>
            <p class="mt-5 text-center">Aucun film ajouté à la liste</p>
        <?php endif ?>

     </main>

    <?php include_once __DIR__ . "/../partials/footer.php";?>
    <?php include_once __DIR__ . "/../partials/foot.php";?>
    
