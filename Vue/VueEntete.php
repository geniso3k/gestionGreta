<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/navbar.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
<body>
<nav class="navbar navbar-dark" style="background-color: black;">
             <a class="navbar-brand" href="./?action=accueil">Accueil</a>
             
             <div class="navbar-brand">Greta Location</div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
</svg>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample01">
              <ul class="navbar-nav mr-auto">
    <?php if(!isset($_SESSION["email"])) :?>
                <li class="nav-item">
                  <a class="nav-link" href="./?action=connexion">Se connecter</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?action=enregistrement">S'inscrire</a>
                </li>
            <?php else: ?>
              
                <li class="nav-item">
                  <a class="nav-link" href="./?action=reservation">Mes réservations</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?action=deconnexion">Se déconnecter</a>
                </li>
                <?php if($_SESSION['role'] < 3):?>
                  <hr />
                <li class="nav-item">
                  <a class="nav-link" href="./?action=allProduits">Produits</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?action=allLieu">Lieux</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./?action=allReservations">Réservations</a>
                </li>
                <?php endif;?>
                <?php if($_SESSION['role'] <2):?>
                  <li class="nav-item">
                  <a class="nav-link" href="./?action=allUtilisateurs">Utilisateurs</a>
                </li>
                  <?php endif;?>
                <?php endif;?>              
                
              </ul>
              
            </div>
          </nav>