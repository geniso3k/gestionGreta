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

/* Container */
.ensemble {
    display: flex;
    flex-direction: row;
    width: 100%;
    gap: 20px;
    justify-content: space-between;
    margin-top: 20px;

}

/* Card Container */
.equip {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
    width: 65%;
    height: 20%;
    padding-left: 15px;

}

/* Single Card */
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

/* Button */
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
    .ensemble {
        flex-direction: column;
    }

    .equip {
        width: 100%;
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

    <select id="categorie" name="categorie" class="form-control">

                <option value="" disabled selected>Selectionnez la catégorie</option>
                <?php foreach($allCat as $cat): ?>
                    
                    <option value="<?=$cat->getId();?>"><?=$cat->getLibelle();?></option>
                <?php endforeach; ?>
    </select>




        <?php

if(isset($_GET['idCat'])){
    $categorie = filter_input(INPUT_GET, 'idCat', FILTER_SANITIZE_STRING);
    $allobj = ModelEquipementDAO::getAllEquipement($categorie);

   
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
                    <div class="prix">
                    <a href="./?action=location&article=<?=$resultat[$i]->getCode()?>" class="btn">Louer</a>
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
    <h2>Bienvenue sur notre site !</h2>
    <p>Notre site est une plateforme permettant aux enseignants de réserver et de louer facilement du matériel informatique pour leurs classes. Que ce soit pour des ordinateurs, des tablettes ou des projecteurs, notre service simplifie l'accès à ces outils informatiques essentiels.</p>
    <p>Avec une réservation rapide en ligne, les professeurs peuvent choisir le matériel adapté à leurs besoins et à la durée de leur cours, pour un enseignement plus interactif et dynamique.</p>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$('#categorie').on('change', function() {               
            var selectedValue = $(this).val(); // Get the selected value
            
            if (selectedValue != "") { // Check if it's not empty
                window.location.href = "./?action=accueil&idCat=" + selectedValue;
            }
        });
</script>