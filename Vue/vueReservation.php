<style>
    /* Styles de base */
* {
    box-sizing: border-box;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 36px;
    margin-top: 20px;
}

.reservations-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
}

.defaut {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #fff;
    padding: 15px;
    margin: 10px;
    width: 300px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.photo {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
}

.enfant {
    text-align: center;
    margin-top: 10px;
}

h1 {
    font-size: 22px;
    margin: 10px 0;
}

p {
    font-size: 16px;
    color: #555;
}

.btn {
    background-color: #e74c3c;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    display: inline-block;
}

.btn:hover {
    background-color: #c0392b;
}

.alert {
    color: green;
    font-size: 16px;
    text-align: center;
    margin: 20px 0;
    background-color: #d4edda;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #c3e6cb;
}
</style>
<h1>Mes Réservations</h1>
<?php if(isset($_GET['alert']) && $_GET['alert'] == "succes"):?>
<div class="alert">
    La réservation a été annulée avec succès !
</div>
<?php endif; ?>

<div class="reservations-container">
    <?php if (count($reservations) > 0): ?>

        <?php foreach ($reservations as $reservation): ?>

        <?php $equipement = ModelEquipementDAO::findById($reservation->getIdEquip()); ?>

        

            <div class="defaut">

                <img class="photo" src="./img/<?php echo $reservation->getIdEquip(); ?>.jpg" alt="Image de l'article" />

                <div class="enfant">
                    <h1><?php echo $equipement->getLibelle(); ?></h1>
                    <p>Date de réservation : <?php echo $reservation->getDateDebut(); ?></p>
                    <p>A rendre impérativement le : <?=$reservation->getDateFin();?></p>
                    <p>Quantité empruntée : x<?php echo $reservation->getQuantite(); ?></p>
                    <p>Prix réglé : <?php echo $reservation->getPrix(); ?>€</p>
                    
                </div>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p>Vous n'avez aucune réservation pour le moment.</p>
    <?php endif; ?>
</div>
