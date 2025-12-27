<?php
session_start();

    require_once __DIR__ . "/../functions/helpers.php";
    require_once __DIR__ . "/../functions/db.php";

    // var_dump($_SERVER);die();
    // print_r($_SERVER);//die();
    // var_dump("$_REQUEST",$_REQUEST);//die();
    // var_dump($_SERVER['REQUEST_METHOD']);

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        
        // FAILLES 
        // Faille csrf jetton
        if (
            !isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token']) ||
            empty($_SESSION['csrf_token']) || empty($_POST['csrf_token']) ||
            ($_SESSION['csrf_token']) !== ($_POST['csrf_token'])
            ) {
            // dd("Erreur");
            redirectToPage("create");

            // header("Location: create.php");
            // die();
        }

        unset($_SESSION['csrf_token']);
        unset($_POST['csrf_token']);

        // dd("Continue la partie");
        if (
            !isset($_POST['honey_pot']) || ($_POST['honey_pot'] !== "") 
           ) {
            redirectToPage("create");
        //    header("Location: create.php");
        //     die();
        }
        unset($_POST['honey_pot']);

        // Vérification des contraintes des input
         $formErrors=[];
var_dump($_SERVER['REQUEST_METHOD']);

        if (isset($_POST['title'])) {
            $title = trim($_POST['title']);

            if ($title === "") {
                $formErrors['title'] = "Le titre est obligatoire";
            } else if (mb_strlen($_title)> 255 ){
                $formErrors['title'] = "Le titre ne doit pas dépasser 255 caractères.";
            }
        }

            if (isset($_POST['rating']) && ($_POST['rating']) !== ""){
                $rating = trim($_POST['rating']);
                if ( ! is_numeric($rating)){
                    $formErrors['rating'] = "La note doit être un nombre.";
                } else if (floatval($rating) < 0 || floatval($rating) > 5 ) {
                    $formErrors['rating'] = "La note doit être comprise entre 0 et 5.";
                }
            }

            if (isset($_POST['comment']) && ($_POST['comment']) !== "") {
                $rating = trim($_POST['comment']);
                
                if (mb_strlen($_rating)> 1000 ){
                $formErrors['comment'] = "Le commentaire ne doit pas dépasser 1000 caractères.";
            }
        }
        // Création du tableaux d'erreurs
        if (count($formErrors) > 0 ) {
            $_SESSION['form_errors'] = $formErrors;
            $_SESSION['old'] = $_POST;
            
            redirectToPage("create");

        }
        dd('Continuer la partie');
        $ratingRounded = null;
        if (isset($_post['rating']) && $_POST['rating'] !== "") {
            $ratingRounded = round($_POST['rating'],1);
        }
        // Requete d'insertion du nouveau film dans la base
        insertFilm($ratingRounded,$_POST);
        // Sauvegarde du message flash de succés
        $_SESSION['success']= "Le film a bien été rajouté à la liste";
        // Redirection vers la page d'accueil
        redirectToPage('index');
    }
    

$_SESSION['csrf_token']=bin2hex(random_bytes(32));
//  var_dump("$_SESSION",$_SESSION);die();
//  var_dump("$_POST",$_POST);die();

?>

<?php include_once __DIR__ . "/../partials/head.php";?>
<?php include_once __DIR__ . "/../partials/nav.php";?> 



    <!-- Main -->
     <main class="container">
        <h1 class="text-center display-5 my-3">Nouveau film</h1>
    
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 mx-auto bg-write shadow rounded p-4">
                
                <?php if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            <?php foreach($_SESSION['form_errors'] as $error) : ?>
                            <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                    </div>
                    <?php unset($_SESSION['form_errors']); ?>
                <?php endif ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="title">Titre <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="<?= isset($_SESSION['old']['title']) && !empty($_SESSION['old']['title']) ? htmlspecialchars($_SESSION['old']['title']) : ""; unset($_SESSION['old']['title']);  ?>" autofocus require>
                    </div>
                    <div class="mb-3">
                        <label for="rating">Note / 5</label>
                        <input inputmode="decimal" type="number" name="rating" id="rating" class="form-control"  value="<?= isset($_SESSION['old']['rating']) && !empty($_SESSION['old']['rating']) ? htmlspecialchars($_SESSION['old']['rating']) : ""; unset($_SESSION['old']['rating']);  ?>">
                    </div>
                     <div class="mb-3">
                        <label for="comment">Laissez un commentaire</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" value="<?= isset($_SESSION['old']['comment']) && !empty($_SESSION['old']['comment']) ? htmlspecialchars($_SESSION['old']['comment']) : ""; unset($_SESSION['old']['comment']); ?>"></textarea> 
                    </div>
                    <div>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="honey_pot" value="">
                    </div>
                    <div>
                        <input formnovalidate type="submit" class="btn btn-primary w-100" value="Ajouter">
                    </div>
                </form>
            </div>

        </div>

    </div>
    </main>

    <?php include_once __DIR__ . "/../partials/footer.php";?>
    <?php include_once __DIR__ . "/../partials/foot.php";?>
    
