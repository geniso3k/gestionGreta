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
<div class="alert alert-danger" style="display:none">La longueur du mot de passe est insuffisante.</div>
<div class="blocConn">
            <h1>Vous inscrire</h1>
<form style="display:flex; flex-direction: column;"method="POST">
    <label>Nom :</label>
    <input class="form-control" name="nom"  required />
    <label>Prenom :</label>
    <input class="form-control" name="prenom" required/>
    <label>Email :</label>
    <input class="form-control" name="email" type="email" required/>
    <label class="pass">Mot de passe :</label>
    <input class="form-control" minlenght="6" name="password" type="password" required />
    <label class="pass">Confirmer mot de passe :</label>
    <input class="form-control" minlenght="6" name="confirmpassword" type="password" required />
    <button class="btn btn-dark" id="submit" type="submit">S'inscrire</button>
    <a href="./?action=connexion"> Vous avez déjà un compte?</a>
</form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
let pass = document.querySelector('input[name="password"]');
let submit = document.getElementById("submit");
let clrpass = document.querySelectorAll('label[class="pass"]');
let alert =document.querySelector('div.alert.alert-danger');

submit.addEventListener("click", function(e){

    if(pass.value.length < 5){
        clrpass.forEach(function(i){
            i.style.color = "red";
        });

        alert.style.display="block";
        pass.focus();

        pass.addEventListener("click", function handler(){
            clrpass.forEach(function(i){
            i.style.color = "";
             });
             alert.style.display = "none";
             pass.removeEventListener("click", handler);

        });
        e.preventDefault();
    }

});
});


</script>