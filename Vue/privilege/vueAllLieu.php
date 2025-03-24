<style>
    .mbottom{
        margin-bottom:10px;
    }
</style>

<div class="container">

    <!-- Formulaire d'ajout de produit -->
    <div class="product-form ">
        <h2 class="mbottom">Ajouter une localité</h2>
        <form method="POST">
            <input type="text" name="nom" class="form-control " placeholder="Nom du lieu" required>
            <button type="submit" class="btn btn-primary mt-3" name="ajouter">Ajouter</button>
        </form>
    </div>

    <!-- Liste des produits -->
    <div class="product-list table-responsive">
        <h2>Liste des lieux disponible</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>

                    <th>Nom</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($lieux) > 0):?>
                    <?php foreach($lieux as $equip): ?>
                <tr>
                    <td><?=$equip->getId(); ?></td>
                    
                    
                    <td><?=$equip->getLibelle(); ?></td>

                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal" data-id="<?=$equip->getId();?>"  data-nom="<?=$equip->getLibelle();?>"">Modifier</a> |
                        <a  class="delete-btn" href="./?action=allLieu&supprimer=<?=$equip->getId();?>" data-toggle="modal" data-target="#confirmDeleteModal" data-id="<?=$equip->getId();?>">Supprimer</a>
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

