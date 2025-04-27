<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo ROOT_URL?>/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Books</li>
    </ol>
</nav>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Author</th>
            <th scope="col">Editorial</th>
            <th scope="col">Genre</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($viewmodel as $item): ?>
            <tr>
                <th scope="row"><?php echo $item['ID']?></th>
                <td><?php echo $item['title']?></td>
                <td style="width:35%" class="text-justify"><?php echo $item['description']?></td>
                <td><?php echo $item['author']?></td>
                <td><?php echo $item['editorial']?></td>
                <td><?php echo $item['genre']?></td>
                <td>
                    <a class="btn btn-primary-outline col-12 mt-2" href="<?php echo ROOT_URL?>/myLibrary/edit/<?php echo $item['ID']?>">Edit</a>
                    <button class="btn btn-primary-color col-12 mt-2" data-bs-toggle="modal" data-bs-target="#modalToDelete-<?php echo $item['ID']?>">Delete</button>
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
                            <p>Are you sure you want to delete <?php echo $item['title']?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary-outline" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary-color" href="<?php echo ROOT_PATH; ?>dashboard/deleteBook/<?=$item['ID']?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </tbody>
    </table>
</div>