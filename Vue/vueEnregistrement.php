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
            <h1>Vous inscrire</h1>
<form style="display:flex; flex-direction: column;"method="POST">
    <label>Nom :</label>
    <input class="form-control" name="nom"  />
    <label>Prenom :</label>
    <input class="form-control" name="prenom" required/>
    <label>Email :</label>
    <input class="form-control" name="email" type="email" required/>
    <label>Mot de passe :</label>
    <input class="form-control" name="password" type="password" required />
    <label>Confirmer mot de passe :</label>
    <input class="form-control" name="confirmpassword" type="password" required />
    <button class="btn btn-dark" type="submit">S'inscrire</button>
    <a href="./?action=connexion"> Vous avez déjà un compte?</a>
</form>
</div>