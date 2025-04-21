<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo ROOT_URL?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Comments</li>
    </ol>
</nav>
<table class="table table-responsive">
    <thead>
    <tr>
        <th scope="col">ID_User</th>
        <th scope="col">ID_Book</th>
        <th scope="col">Lend date</th>
        <th scope="col">Return date</th>
        <th scope="col">ID_Borrow User</th>
        <th scope="col">Confirmation</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($viewmodel as $item): ?>
        <tr>
            <td><?php echo $item['user_id']?></td>
            <td><?php echo $item['book_id']?></td>
            <td><?php echo $item['lend_date']?></td>
            <td><?php echo $item['return_date']?></td>
            <td><?php echo $item['borrow_user_id']?></td>
            <td><?php echo $item['userConfirmation']?></td>
            <td>
                <a class="btn btn-primary-outline col-12 col-md-12 col-lg-8 col-xl-5 mt-2" href="<?php echo ROOT_URL?>dashboard/editLendBook/<?php echo $item['user_id']?>/<?php echo $item['book_id']?>/<?php echo $item['lend_date']?>">Edit</a>
                <button class="btn btn-primary-color col-12 col-md-12 col-lg-8 col-xl-5 mt-2" data-bs-toggle="modal" data-bs-target="#modalToDelete-<?php echo $item['user_id']?>/<?php echo $item['book_id']?>/<?php echo $item['lend_date']?>">Delete</button>
            </td>
        </tr>
        <!-- Modal -->
        <div class="modal fade" id="modalToDelete-<?php echo $item['user_id']?>/<?php echo $item['book_id']?>/<?php echo $item['lend_date']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Caution!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this lent book?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>dashboard/deleteLendBook/<?php echo $item['user_id']?>/<?php echo $item['book_id']?>/<?php echo $item['lend_date']?>">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
    </tbody>
</table>