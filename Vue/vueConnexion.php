<style>

@media (min-width: 1200px){
    

    input{
        margin-bottom: 5px;
    }
    .blocConn{
        margin:40%;margin-top: 20px;
    }

}
@media(max-width: 1200px){
     .blocConn *{
        font-size: 1rem;
        margin: 5px;
    }
    .blocConn input{

        width: 95%;
    }
    input{
        margin: 20px;
        
    }
    h1{
        text-align: center;
        font-weight: bold;
    }
}
</style>
<div class="blocConn">
            <h1>Vous connecter</h1>
<form style="display:flex; flex-direction: column;"method="POST">
    <input name="email" type="email" class="form-control" placeholder="Email" required/>
    <input name="password" type="password" class="form-control" required placeholder="Mot de passe"/>
    <button class="btn btn-dark" type="submit">Se connecter</button>
    <a href="./?action=enregistrement"> Nouveau client</a>
</form>
</div>
<?php if(!empty($_GET['alert']) && $_GET['alert'] == "succes"):?>

    <script>alert("Inscription avec succès, veuillez vous connecter à présent.");
        window.location.href=" ./?action=connexion";
    </script>

    <?php endif?>