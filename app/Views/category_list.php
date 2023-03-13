<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH . '/css/bootstrap.css'; ?>" />
    <title>Category List</title>
</head>

<body>
    <div class="row">
        <div class="col-6 mx-auto">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Category Name </th>
                        <th scope="col">Total Items</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $category) {
                    ?>
                            <tr>
                                <td><?php echo $category['name']; ?></td>
                                <td><?php echo $category['total_items']; ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="2" class="text-center">Item not found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
