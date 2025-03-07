<style>


* {
    box-sizing: border-box;
}

.defaut {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    padding: 10px;
    margin-top: 20px;
    margin-left: 10%;
    width: 25%;
    border: solid 1px;
}

.photo {
    width: 150px;
    height: 150px;
    margin-right: 10px;
}

.enfant {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
    text-align: center;
}

.defaut h1 {
    font-size: 35px;
}

.defaut p {
    text-align: right;
}

.btn {
    padding: 12px 20px;
    text-align: center;
    width: 100%;
    max-width: 200px;
    min-width: 150px;
    margin-top: 10px;
    box-sizing: border-box;
    margin-left: auto;
}

@media (max-width: 768px) {
    .defaut {
        margin: 10px;
        width: 95%;
        flex-direction: column;
        align-items: center;
    }

    .photo {
        width: 100px;
        height: 100px;
    }

    .enfant {
        flex-grow: 1.5;
        text-align: center;
        align-items: center;
    }

    h1 {
        font-size: 18px;
    }

    .btn {
        padding: 8px 15px;
        width: 100%;
        max-width: none;
        min-width: 120px;
        margin-left: auto;
    }
}

    
</style>
<?php if(isset($_GET['alert']) && $_GET['alert'] == "succes"){
    echo "<div class='alert alert-success'>La location s'est produite avec succès !</div>";
} 

for($i = 0; $i < count($resultat); $i++): ?>
 <?php if($resultat[$i]->getStock() > 0):?>
<div class="defaut">
    <img class="photo" src="<?php echo "./img/".$resultat[$i]->getCode(); ?>.jpg" alt="img" />
    <div class="enfant">
        <h1><?=$resultat[$i]->getLibelle()?></h1>
        <p>Stock : x<?=$resultat[$i]->getStock()?></p>
        <a href="./?action=location&article=<?=$resultat[$i]->getCode()?>" class="btn btn-danger">Louer</a>
    </div>
</div>
<?php endif;?>
<?php endfor?>