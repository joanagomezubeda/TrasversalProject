<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo ROOT_URL?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Publications</li>
    </ol>
</nav>
<table class="table table-responsive">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Description</th>
        <th scope="col">ID_User</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($viewmodel as $item): ?>
        <tr>
            <th scope="row"><?php echo $item['ID']?></th>
            <td style="width: 65%" class="text-justify"><?php echo $item['description']?></td>
            <td><?php echo $item['id_user']?></td>
            <td>
                <a class="btn btn-primary-outline col-12 col-md-12 col-lg-8 col-xl-5 mt-2" href="<?php echo ROOT_URL?>dashboard/editPublication/<?php echo $item['ID']?>">Edit</a>
                <button class="btn btn-primary-color col-12 col-md-12 col-lg-8 col-xl-5 mt-2" data-bs-toggle="modal" data-bs-target="#modalToDelete-<?php echo $item['ID']?>">Delete</button>
            </td>
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="modalToDelete-<?php echo $item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this publication?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>dashboard/deletePublication/<?=$item['ID']?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </tbody>
</table>