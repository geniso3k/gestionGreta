<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/navbar.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
<body>
<nav class="navbar navbar-dark bg-dark">
             <a class="navbar-brand" href="./?action=accueil">Accueil</a>
             
             <div class="navbar-brand">Gestionnaire de stocks pour location</div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
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