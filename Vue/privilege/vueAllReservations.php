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

    .reservation-list table {
        width: 100%;
        margin-top: 20px;
    }

    .reservation-list th, .reservation-list td {
        text-align: center;
        padding: 12px;
    }

    .reservation-list th {
        background-color: #343a40;
        color: white;
    }

    .reservation-list td {
        background-color: white;
        border: 1px solid #ddd;
    }

    .reservation-list a {
        margin: 0 10px;
        cursor: pointer;
        text-decoration: none;
        color: #007bff;
    }

    .reservation-list a:hover {
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

    .btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .modal-content {
        border-radius: 10px;
    }

</style>

<div class="container">

    <!-- Liste des réservations -->
    <div class="reservation-list table-responsive">
        <h2>Liste des réservations en cours</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du client</th>
                    <th>Produit réservé</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Signature</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($reservations) > 0): ?>
                    <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?=$reservation->getIdEmprunt(); ?></td>
                    <td><?=ModelConnDAO::getClientNom($reservation->getIdUser());?></td>
                    <td><?=ModelReservationDAO::getEquipementLibelle($reservation->getIdEquip()) ?></td>
                    <td><?=$reservation->getDateDebut(); ?></td>
                    <td><?php 

$time = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));


$reservationEndDate = DateTime::createFromFormat('Y-m-d', $reservation->getDateFin());

if ($reservationEndDate < $time) {

    echo '<b style="color:red;">'. $reservation->getDateFin() . '</b>';
}else{
    echo $reservation->getDateFin();
}

                    
                    ?></td>
<td><img width="100" height="50" src ="./img/signatures/<?=$reservation->getSignature()?>"/></td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#editModal" data-id="<?=$reservation->getIdEmprunt();?>" data-client="<?=ModelConnDAO::getClientNom($reservation->getIdUser());?>" data-product="<?=ModelReservationDAO::getEquipementLibelle($reservation->getIdEquip()) ?>" data-start="<?=$reservation->getDateDebut();?>" data-end="<?=$reservation->getDateFin();?>">Modifier</a> |
                        <a class="delete-btn" href="./?action=allReservations&supprimer=<?=$reservation->getIdEmprunt();?>" data-toggle="modal" data-target="#confirmDeleteModal" data-id="<?=$reservation->getIdEmprunt();?>">Rendu</a>
                    </td>
                </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aucune réservation en cours.</td>
                    </tr>
                <?php endif; ?>
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
                <p>Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action est irréversible.</p>
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
                <h5 class="modal-title" id="editModalLabel">Modifier une réservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    <input type="hidden" name="id" id="reservationId">
                    <input type="text" name="client" id="reservationClient" class="form-control" placeholder="Nom du client" required disabled>
                    <input type="text" name="product" id="reservationProduct" class="form-control" placeholder="Produit réservé" required disabled>
                    <input type="date" name="start" id="reservationStart" class="form-control" required>
                    <input type="date" name="end" id="reservationEnd" class="form-control" required>
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
    // Remplir le formulaire de modification avec les données de la réservation
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var client = button.data('client');
        var product = button.data('product');
        var start = button.data('start');
        var end = button.data('end');

        var modal = $(this);
        modal.find('#reservationId').val(id);
        modal.find('#reservationClient').val(client);
        modal.find('#reservationProduct').val(product);
        modal.find('#reservationStart').val(start);
        modal.find('#reservationEnd').val(end);
    });

    // Lorsque l'utilisateur clique sur "Supprimer", ouvrir le modal de confirmation
    $('.reservation-list a.delete-btn').on('click', function (e) {
        e.preventDefault();  // Empêche la propagation immédiate du lien
        var deleteUrl = $(this).attr('href');  // Récupère l'URL de suppression du lien

        // Ouvrir le modal
        $('#confirmDeleteModal').modal('show');

        // Modifier le lien du bouton de confirmation pour qu'il continue la suppression
        $('#confirmDeleteButton').attr('href', deleteUrl);
    });

</script>
