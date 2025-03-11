<style>
    .tout{
        margin: 30px;
        margin-left: 20%;
        margin-right: 20%;
        padding: 50px;
        border: solid 1px;
    }
    .photo {
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 100%; 
    max-width: 700px;
    height: auto; 
}

    h1{
        text-align: center;
    }
    .date{
        width: 100%;
    }
    .valider{
        margin-left: 47%;
    }

    @media (max-width: 768px) {
        .tout{
            margin-left: 10%;
            margin-right: 10%;
            padding: 20px;
        }

        .photo{
            height: 200px;
            width: 200px;
            margin-left: 10%;
            
            margin-right: auto;
        }

        h1{
            font-size: 1.5rem; /* Réduction de la taille du titre */
        }

        .valider{
            margin-left: 0; /* Centrer le bouton */
            display: block;
            margin-top: 20px;
            width: 100%;
        }

        .form-group{
            margin-bottom: 10px;
        }

        .form-control{
            width: 100%; /* S'assurer que tous les champs prennent toute la largeur */
        }
    }
    .prix{
        font-color: green;
    }
</style>

<div class="tout">
    <form method="post">
        <img class="photo" src="./img/<?=$modele->getCode()?>.jpg" alt="img" />
        <h1><?=$modele->getLibelle();?></h1>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" value="<?=$_SESSION['email'] ?>" disabled id="email" placeholder="name@example.com">
        </div>
        <input style="display:none;" type="text" id="price" name="prix" value="<?=$modele->getPrix()?>"/>
        <div class="form-group">
            <label for="datepicker">Sélectionnez la date de retour du produit</label></br>
            <input class="date" name="datepicker" required type="date"></input>
        </div>
        <div class="form-group">
            <label for="qtt">Quantité souhaitée</label>
            <select class="form-control" name="qtt">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option> 
            </select>
        </div>
        <h4>Description :</h4><p> </br>
        <?=$modele->getDescription();?>
</p>
        <div class="form-group">
            <input type="checkbox" id="consentement" name="consentement" required />
            <label for="consentement">J'accepte de rendre le produit dans les temps et en état. Chaque jour de retard entrainera des frais de 25% du prix unitaire.</label>
        </div>
        <h1><div  id="prix"></div></h1>
        <button type="submit" class="valider btn btn-success">Valider</button>
    </form>
</div>
<script>
    var prix = parseFloat(document.getElementById("price").value);
    // Fonction pour calculer la différence en jours entre deux dates
    function calculateDaysDifference(startDate, endDate) {
        const oneDay = 24 * 60 * 60 * 1000; // Millisecondes dans une journée
        const start = new Date(startDate);
        const end = new Date(endDate);

        // Calcul de la différence en jours
        const diffDays = Math.round((end - start) / oneDay);
        return diffDays >= 0 ? diffDays : 0; // Si la date de retour est dans le passé, retour 0 jours
    }

    // Fonction pour mettre à jour le prix total
    function updatePrice() {
        const pricePerDay = prix; // Prix par jour
        const quantity = parseInt(document.querySelector('select[name="qtt"]').value); // Quantité
        const returnDate = document.querySelector('input[name="datepicker"]').value; // Date de retour
        
        if (returnDate) {
            const currentDate = new Date().toISOString().split('T')[0]; // Date d'aujourd'hui en format yyyy-mm-dd
            const daysDifference = calculateDaysDifference(currentDate, returnDate); // Calcul des jours de location

            const totalPrice = daysDifference * pricePerDay * quantity; // Calcul du prix total
            document.getElementById('prix').innerText = "Total: "+ totalPrice.toFixed(2)+ "€"; // Mise à jour du prix total avec 2 décimales
            document.getElementById('price').value = totalPrice.toFixed(2);
        }
    }

    // Événements pour déclencher la mise à jour du prix lors de la sélection de la date et de la quantité
    document.querySelector('input[name="datepicker"]').addEventListener('change', updatePrice);
    document.querySelector('select[name="qtt"]').addEventListener('change', updatePrice);

    // Initialisation du prix au chargement de la page
    window.onload = updatePrice;
</script>

