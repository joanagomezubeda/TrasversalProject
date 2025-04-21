<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo ROOT_URL?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
</nav>
<table class="table table-responsive">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col text-clamp-oneLine">Complete Adress</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($viewmodel as $item): ?>
        <tr>
            <th scope="row"><?php echo $item['id']?></th>
            <td><?php echo $item['name']?></td>
            <td><?php echo $item['email']?></td>
            <?php if (!empty($item['address'])): ?>
                <td><?php echo $item['address'] ?>, <?php echo $item['city'] ?>, <?php echo $item['province'] ?></td>
            <?php else: ?>
                <td>Unknown</td>
            <?php endif; ?>
            <td>
                <a class="btn btn-primary-outline col-12 col-md-12 col-lg-8 col-xl-5 mt-2" href="<?php echo ROOT_URL?>users/profile/<?php echo $item['id']?>">Edit</a>
                <button class="btn btn-primary-color shadow col-12 col-md-12 col-lg-8 col-xl-5 mt-2" data-bs-toggle="modal" data-bs-target="#modalToDelete-<?php echo $item['id']?>">Delete</button>
            </td>
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="modalToDelete-<?php echo $item['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?php echo $item['name']?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>dashboard/deleteUser/<?=$item['id']?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </tbody>
</table>