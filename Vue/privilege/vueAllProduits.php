<style>
    .mbottom{
        margin-bottom:10px;
    }
</style>

<div class="container">

    <!-- Formulaire d'ajout de produit -->
    <div class="product-form">
        <h2>Ajouter un produit</h2>
        <form method="POST" enctype="multipart/form-data">
            <select name="categorie" class="form-control mbottom">
                <option value="" disabled selected>Selectionnez la catégorie</option>
                <?php foreach($allCat as $cat): ?>
                    
                    <option value="<?=$cat->getId();?>"><?=$cat->getLibelle();?></option>
                <?php endforeach; ?>
            </select>
            <select id="lieu" name="lieu" class="form-control mbottom">

                    <option value="" disabled selected>Selectionnez la localité</option>
                    <?php foreach($allLieu as $lieux): ?>
                        
                    <option value="<?=$lieux->getId();?>"><?=$lieux->getLibelle();?></option>

                    <?php endforeach; ?>

            </select>
            <input type="text" name="nom" class="form-control mbottom" placeholder="Nom du produit" required>
            <textarea name="desc" class="form-control mbottom" placeholder="Description détaillée" required>Description détaillée</textarea>
            <p>Veuillez insérer une image</p> <input type="file" name="image" id="image" class="form-control" required> 
            <button type="submit" class="btn btn-primary mt-3" name="ajouter">Ajouter</button>
        </form>
    </div>

    <!-- Liste des produits -->
    <div class="product-list table-responsive">
        <h2>Liste des produits</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Lieu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($equipement) > 0):?>
                    <?php foreach($equipement as $equip): ?>
                <tr>
                    <td><?=$equip->getCode(); ?></td>
                    
                    <td><?=$equip->getCategorie(); ?></td>
                    <td><?=$equip->getLibelle(); ?></td>
                    <td><?=$equip->getDescription()?></td>
                    <td><?=ModelLieuDAO::getLieu($equip->getLieu());?></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal" data-id="<?=$equip->getCode();?>" data-desc="<?=$equip->getDescription()?>" data-nom="<?=$equip->getLibelle();?>"">Modifier</a> |
                        <a  class="delete-btn" href="./?action=allProduits&supprimer=<?=$equip->getCode();?>" data-toggle="modal" data-target="#confirmDeleteModal" data-id="<?=$equip->getCode();?>">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif;?>
            </tbody>
        </table>
    </div>

    

</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce produit ? Cette action supprimera également toutes les réservations associées à ce produit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a id="confirmDeleteButton" href="#" class="btn btn-danger">Continuer la suppression</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal Bootstrap pour Modifier -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier un produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    <input type="hidden" name="id" id="productId">
                    <input type="text" name="nom" id="productName" class="form-control" placeholder="Nom du produit" required>
                    <textarea  name="desc" id="productDesc" class="form-control" placeholder="Description" required></textarea>
                    <select id="lieu" name="lieu" class="form-control mbottom">

                    <option value="" disabled selected>Selectionnez la localité</option>
                    <?php foreach($allLieu as $lieux): ?>
                        
                    <option value="<?=$lieux->getId();?>"><?=$lieux->getLibelle();?></option>

                    <?php endforeach; ?>

            </select>
                    <button type="submit" class="btn btn-primary mt-3" name="modifier">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    // Remplir le formulaire de modification avec les données du produit
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nom = button.data('nom');
        var lieu = button.data('lieu');
        var desc = button.data('desc');

        var modal = $(this);
        modal.find('#productId').val(id);
        modal.find('#productName').val(nom);
        modal.find('#productLieu').val(lieu);
        modal.find('#productDesc').val(desc);
    });

    // Lorsque l'utilisateur clique sur "Supprimer", ouvrir le modal de confirmation
$('.product-list a.delete-btn').on('click', function (e) {
    e.preventDefault();  // Empêche la propagation immédiate du lien
    var deleteUrl = $(this).attr('href');  // Récupère l'URL de suppression du lien

    // Ouvrir le modal
    $('#confirmDeleteModal').modal('show');

    // Modifier le lien du bouton de confirmation pour qu'il continue la suppression
    $('#confirmDeleteButton').attr('href', deleteUrl);
});

</script>

