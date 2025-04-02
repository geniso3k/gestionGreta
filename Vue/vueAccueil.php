<style>
/* Global Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif; /* Nouvelle police */
}

body {
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}
@media(min-width: 1200px){
    body{
        overflow-y:hidden;
    }
    .equip{
        overflow-y: auto;
    }
}

/* Container */
.ensemble {
    display: flex;
    flex-direction: row;
    width: 100%;
    gap: 20px;
    justify-content: space-between;
    margin-top: 20px;

}


.equip {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
    width: 65%;
    max-height: 800px;
    padding-left: 15px;

}


.defaut {
    display: flex;
    flex-direction: column;
    padding: 15px;
    margin-top: 20px;
    border: solid 1px #e0e0e0;
    border-radius: 8px;
    width: calc(33.333% - 20px); /* 3 cards per row */
    background-color: #fff;
    transition: box-shadow 0.3s ease-in-out;
}

.defaut:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Image Style */
.photo {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* Info Section */
.enfant {
    display: flex;
    flex-direction: column;
    gap: 10px;
    text-align: center;
}

.enfant h1 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}

.enfant p {
    font-size: 1rem;
    color: #666;
}

/* Boutton */
.btn {
    padding: 12px 20px;
    width: 100%;
    max-width: 200px;
    background-color: #ff5733;
    color: white;
    text-decoration: none;
    text-transform: uppercase;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    margin-top: 15px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background-color: #e74c3c;
    transform: translateY(-2px);
}

/* Description Section */
.description {
    background-color: #f7f7f7;
    padding: 30px;
    border-radius: 8px;
    
    flex: 2 ;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.description img {
    max-width: 100%;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    body{
        overflow-y: auto;
    }
    .ensemble {
        flex-direction: column-reverse;
    }

    .equip {
        width: 100%;
        height: 20%;
    }

    .defaut {
        width: 100%;
    }

    .photo {
        height: 150px;
    }

    .btn {
        padding: 10px;
    }

    .description {
        width: 100%;
        margin-top: 20px;
    }

    h1 {
        font-size: 1.5rem;
    }
}


</style>

<?php if(isset($_GET['alert']) && $_GET['alert'] == "succes"){ 
    echo "<div class='alert alert-success'>La location s'est produite avec succès !</div>";
} ?>





<div class="ensemble">
    <div class="equip">
        <form id="searchForm" style="width:100%;" method="POST">
            <input id="search" name="search" type="text" class="form-control" placeholder="Rechercher un produit en particulier..." />
        </form>
    <p> OU</p>
    <select id="categorie" name="categorie" class="form-control">

                <option value="" disabled selected>Selectionnez la catégorie</option>
                <option value="*">Tous</option>
                <?php foreach($allCat as $cat): ?>
                    
                    <option value="<?=$cat->getId();?>"><?=$cat->getLibelle();?></option>
                <?php endforeach; ?>
    </select>
    <select id="lieu" name="lieu" class="form-control">

        <option value="" disabled selected>Selectionnez la localité</option>
        <option value="*">Tous</option>
        <?php foreach($allLieu as $lieux): ?>
            
         <option value="<?=$lieux->getId();?>"><?=$lieux->getLibelle();?></option>

        <?php endforeach; ?>

    </select>




        <?php

if(isset($categorie) && isset($lieu)){

    if($categorie == '*'){
        $categorie = null;
    }
    if($lieu == '*'){
        $lieu = null;
    }
    if($allobj == null){
        $allobj = ModelEquipementDAO::getAllEquipement($categorie, $lieu);
    }
    //var_dump($allobj); die();
   
        foreach($allobj as $result){
            if(!ModelReservationDAO::reservationExist($result->getCode()))
            {
                $resultat[] = $result;
            }
        
        
        }


        
        
        if(isset($resultat)){
        for($i = 0; $i < count($resultat); $i++):?>
            <div class="defaut">
                <img class="photo" src="<?php echo "./img/".$resultat[$i]->getCode(); ?>.jpg" alt="img" />
                <div class="enfant">
                    <h1><?=$resultat[$i]->getLibelle()?></h1>
                    <p>Localité : <b><?=ModelLieuDAO::getLieu($resultat[$i]->getLieu()) ?></b></p>
                    <div class="prix">
                    <a href="./?action=location&article=<?=$resultat[$i]->getCode()?>" class="btn">Réserver</a>
                    </div>
                </div>
            </div>

        <?php endfor;

    
        }else{
            echo 'Aucun article disponible.';
        }
        
    }
     ?>

      


    </div>

<div class="description">
    <img class="img-fluid" src="./img/commercial.jpg" alt="Commercial" />
    <h2>Bienvenue sur Greta Location !</h2>
    <p>Greta Location est une plateforme permettant aux employés de réserver et de louer facilement du matériel. Que ce soit pour des ordinateurs, des meubles ou des outils, notre service simplifie l'accès à ces éléments essentiels.</p>
    <p>Avec une réservation rapide en ligne, vous pouvez choisir le matériel adapté à vos besoins, pour un environnement plus interactif et dynamique.</p>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $('#lieu').hide();
        $('#categorie').on('change', function() {               
            var selectedCat = $(this).val();
            $('#lieu').show("slow");
           $('#lieu').on('change', function(){
                    var selectedLieu = $('#lieu').val();
                    window.location.href="./?idCat=" + selectedCat + "&idLieu=" + selectedLieu;
                    console.log(selectedLieu);
                })
            
        });
</script>
<script>
    $(document).ready(function() {
        $('#search').focus(function() {
            $('#search').keypress(function(e) {
                var key = e.which;
                if (key == 13) {  
                    $("#searchForm").submit();
                }
            });
        });
    });
</script>
