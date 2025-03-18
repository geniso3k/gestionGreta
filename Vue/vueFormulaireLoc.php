<style>
    .tout {
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

    h1 {
        text-align: center;
    }

    .date {
        width: 100%;
    }

    .valider {
        margin-left: 47%;
    }

    @media (max-width: 768px) {
        .tout {
            margin-left: 10%;
            margin-right: 10%;
            padding: 20px;
        }

        .photo {
            height: 200px;
            width: 200px;
            margin-left: 10%;
            margin-right: auto;
        }

        h1 {
            font-size: 1.5rem;
        }

        .valider {
            margin-left: 0;
            display: block;
            margin-top: 20px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-control {
            width: 100%;
        }
    }

    .prix {
        color: green;
    }

    #canvas {
        border: 1px solid #000;
        cursor: crosshair;
    }
</style>

<div class="tout">
    <form id="signatureForm" method="post" enctype="multipart/form-data">
        <img class="photo" src="./img/<?=$modele->getCode()?>.jpg" alt="img" />
        <h1><?=$modele->getLibelle();?></h1>
        <h4>Description :</h4><p> 
        <?=$modele->getDescription();?>
        </p>
        
        <div class="form-group">
            <label for="email">Location enregistrée sous le nom de : </label>
            <input type="email" class="form-control" value="<?= ModelConnDAO::getClientNom($_SESSION['user_id']);?>" disabled id="email" placeholder="name@example.com">
        </div>
        
        <div class="form-group">
            <label for="datepicker">Sélectionnez la date de retour du produit</label></br>
            <input class="date" name="datepicker" required type="date"></input>
        </div>

        <p>Signature : </p>
        <canvas id="canvas" width="200" height="100"></canvas>
</br></br>

        <div class="form-group">
            <input type="checkbox" id="consentement" name="consentement" required />
            <label for="consentement">J'accepte de rendre le produit dans les temps et en état.</label>
        </div>
        
        <h1><div id="prix"></div></h1>

        <!-- Champ caché pour la signature sous forme de fichier -->
        <input type="file" name="signature" id="signature" style="display:none;">
        
        <button type="submit" class="valider btn btn-success">Valider</button>
    </form>
</div>

<script>



const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

let isDrawing = false;


canvas.addEventListener("mousedown", startDrawing);
canvas.addEventListener("touchstart", startDrawing, { passive: false });


canvas.addEventListener("mousemove", draw);
canvas.addEventListener("touchmove", draw, { passive: false });


canvas.addEventListener("mouseup", stopDrawing);
canvas.addEventListener("touchend", stopDrawing);


canvas.addEventListener("touchstart", (e) => e.preventDefault());
canvas.addEventListener("touchmove", (e) => e.preventDefault());

function startDrawing(e) {
    isDrawing = true;
    const pos = getTouchPos(e);
    ctx.beginPath();
    ctx.moveTo(pos.x, pos.y);
}

function draw(e) {
    if (!isDrawing) return;
    const pos = getTouchPos(e);
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
}

function stopDrawing() {
    isDrawing = false;
    convert();
}

// Fonction pour obtenir la position du doigt ou de la souris
function getTouchPos(e) {
    let rect = canvas.getBoundingClientRect();
    let x, y;

    // Pour un appareil tactile, obtenir les coordonnées du touch
    if (e.touches) {
        x = e.touches[0].clientX - rect.left;
        y = e.touches[0].clientY - rect.top;
    } else {
        x = e.offsetX;
        y = e.offsetY;
    }

    return { x: x, y: y };
}





// Convertir le canvas en Blob et l'ajouter au champ de fichier avant soumission
function convert() {
    canvas.toBlob(function(blob) {
        const file = new File([blob], "signature.png", { type: "image/png" });

        // Ajouter le fichier au champ de fichier caché
        const signatureField = document.getElementById('signature');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        signatureField.files = dataTransfer.files;

        console.log("File added to hidden input:", file); // Ajouté pour le débogage
    }, 'image/png');
}



</script>
