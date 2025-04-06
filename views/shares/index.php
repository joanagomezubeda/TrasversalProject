<div>
    <?php if(isset($_SESSION['is_logged_in'])) : ?>
    <a href="<?php echo ROOT_PATH; ?>shares/add" class="btn btn-primary-color mt-4">Share Something</a>
    <?php endif; ?>
    <?php foreach ($viewmodel as $item): ?>
        <div class="mt-3 border rounded shadow p-4 ">
            <h3><?php echo $item['title'];?></h3>
            <small><?php echo $item['create_date']; ?></small>
            <hr>
            <p><?php echo $item['body'];?></p>
            <br>
            <a href="<?php echo $item['link'];?>" target="_blank" class="btn btn-primary-outline">Go To Website</a>
        </div>
    <?php endforeach; ?>
</div>
