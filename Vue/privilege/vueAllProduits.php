
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            margin-top: 20px;
        }

        .product-form input, .product-form button {
            margin: 5px;
        }

        .product-list table {
            width: 100%;
            margin-top: 20px;
        }

        .product-list th, .product-list td {
            text-align: center;
            padding: 12px;
        }

        .product-list th {
            background-color: #343a40;
            color: white;
        }

        .product-list td {
            background-color: white;
            border: 1px solid #ddd;
        }

        .product-list a {
            margin: 0 10px;
            cursor: pointer;
            text-decoration: none;
            color: #007bff;
        }

        .product-list a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }


    </style>


<div class="container">

    <!-- Formulaire d'ajout de produit -->
    <div class="product-form">
        <h2>Ajouter un produit</h2>
        <form method="POST">
            <select name="categorie" class="form-control">
                <?php var_dump($allCat);?>
                <option value="" disabled selected>Selectionnez la catégorie</option>
                <?php foreach($allCat as $cat): ?>
                    
                    <option value="<?=$cat->getId();?>"><?=$cat->getLibelle();?></option>
                <?php endforeach; ?>
            </select>
            
            <input type="text" name="nom" class="form-control" placeholder="Nom du produit" required>
            <input type="number" step="0.01" name="prix" class="form-control" placeholder="Prix" required>
            <input type="number" name="stock" class="form-control" placeholder="Stock" required>
            <textarea name="desc" class="form-control" placeholder="Description détaillée" required>Description détaillée</textarea>
            <button type="submit" class="btn btn-primary mt-3" name="ajouter">Ajouter</button>
        </form>
    </div>

    <!-- Liste des produits -->
    <div class="product-list table-responsive">
        <h2>Liste des produits</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>Prix journalier</th>
                    <th>Stock</th>
                    <th>Description</th>
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
                    <td>€<?=$equip->getPrix();?></td>
                    <td><?=$equip->getStock();?></td>
                    <td><?=$equip->getDescription()?></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal" data-id="<?=$equip->getCode();?>" data-desc="<?=$equip->getDescription()?>" data-nom="<?=$equip->getLibelle();?>" data-prix="<?=$equip->getPrix();?>" data-stock="<?=$equip->getStock();?>">Modifier</a> |
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
                    <input type="number" name="prix" id="productPrice" step="0.01" class="form-control" placeholder="Prix" required>
                    <input type="number" name="stock" id="productStock" class="form-control" placeholder="Stock" required>
                    <textarea  name="desc" id="productDesc" class="form-control" placeholder="Description" required></textarea>
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
        var prix = button.data('prix');
        var stock = button.data('stock');
        var desc = button.data('desc');

        var modal = $(this);
        modal.find('#productId').val(id);
        modal.find('#productName').val(nom);
        modal.find('#productPrice').val(prix);
        modal.find('#productStock').val(stock);
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

