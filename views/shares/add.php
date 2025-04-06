<div class="mt-5">
    <h3>Share something!</h3>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" placeholder="Introduce a title" name="title" class="form-control" id="title">
        </div>
        <div class="form-group mt-3">
            <label for="body">Body:</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="link">Link:</label>
            <input type="text" placeholder="Introduce a link" name="link" class="form-control" id="link">
        </div>
        <div class="mt-3">
            <button class="btn btn-primary-color" name="submit" type="submit" value="submit">Submit</button>
            <a href="<?php echo ROOT_PATH;?>shares" class="btn btn-secondary-color">Cancel</a>
        </div>
    </form>
</div>