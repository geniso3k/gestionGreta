<div style="margin-top: 20px;" class="table-responsive container table-container">
    <h2>Liste des utilisateurs</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

<?php foreach($users as $user):?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=ModelConnDAO::getClientNom($user['id'])?></td>
                <td><?=$user['email']?></td>
                <td><?=ModelConnDAO::getRoleNom($user['role'])?></td>
                <td>

                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#changeRoleModal" 
                            data-id="<?=$user['id']?>" 
                            data-client="<?=ModelConnDAO::getClientNom($user['id'])?>"
                            data-email="<?=$user['email']?>" 
                            data-role="<?=$user['role']?>">
                        Changer rôle
                    </button>
                    <a href="?action=allUtilisateurs&id=<?=$user['id']?>&email=<?=$user['email']?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>

            <?php endforeach;?>
        </tbody>
    </table>
    <!-- Modal pour changer le rôle -->
    <div class="modal fade" id="changeRoleModal" tabindex="-1" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeRoleModalLabel">Changer le rôle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="user_id" id="reservationId">
                        <input type="hidden" name="email_id" id="reservationEmailId">
                        <div class="mb-3">
                            <label for="client" class="form-label">Nom du client</label>
                            <input type="text" class="form-control" id="reservationClient" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="client" class="form-label">Email du client</label>
                            <input type="text" class="form-control" id="reservationClientEmail" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Modifier le rôle</label>
                            <select name="role" id="role" class="form-select">
                                <option value="3">Client</option>
                                <option value="2">Commercial</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="majRole" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="?page=1" aria-label="Première">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?page=1" aria-label="Précédente">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

<?php for($i = 1; $i <= $totalPages; $i++):?>

            <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                <a class="page-link" href="?action=allUtilisateurs&page=<?=$i?>"><?=$i?></a>
            </li>
            <?php endfor;?>



            <li class="page-item">
                <a class="page-link" href="?page=2" aria-label="Suivante">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?page=3" aria-label="Dernière">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


<script>
$(document).ready(function() {
    $('#changeRoleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Le bouton qui a déclenché l'événement
        var id = button.data('id');
        var client = button.data('client');
        var role = button.data('role');
        var email = button.data('email');

        var modal = $(this);
        modal.find('#reservationClientEmail').val(email);
        modal.find('#reservationEmailId').val(email);
        modal.find('#reservationId').val(id); // Remplir le champ caché pour l'ID de l'utilisateur
        modal.find('#reservationClient').val(client); // Afficher le nom du client dans le modal
        modal.find('#role').val(role); // Pré-sélectionner le rôle actuel dans la liste déroulante
    });
});


</script>

