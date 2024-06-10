<?php require('partials/head.php') ?>

<div class="container mt-5">
    <h1 class="text-center">To Do App</h1>
    <form method="POST" class="mb-5 mt-5">
        <div class="form-row">
            <div class="col"></div>
            <div class="col">
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter a task here" required >
                <?php if (isset($errors['name']) && !isset($_POST['_method'])): ?>
                    <p class="text-danger"><?= $errors['name'] ?></p>
                <?php endif; ?>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary pl-3 pr-3">Save</button>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="table-responsive mx-auto" style="max-width: 800px">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 10%;">No.</th>
                    <th scope="col" style="width: 70%;">Todo item</th>
                    <th scope="col" style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lists as $list): ?>
                    <tr>
                        <th scope="row"><?= $list['id'] ?></th>
                        <td>
                            <div class="task-name">
                                <?php if (isset($_POST['edit_mode']) && $_POST['edit_mode'] == $list['id']): ?>
                                    <form method="POST" class="form-inline">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="id" value="<?= $list['id'] ?>">
                                        <input type="text" name="name" class="form-control mr-2 fixed-width" value="<?= htmlspecialchars($list['name']) ?>" required>
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                <?php else: ?>
                                    <span class="fixed-width"><?= htmlspecialchars($list['name']) ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <div class="d-inline">
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $list['id'] ?>">
                                    <button type="submit" name="edit_mode" value="<?= $list['id'] ?>" class="btn btn-primary btn-sm">Edit</button>
                                </form>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('partials/footer.php') ?>

