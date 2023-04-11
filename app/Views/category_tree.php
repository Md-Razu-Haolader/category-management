<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Tree</title>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH.'/css/bootstrap.min.css'; ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS_PATH.'/css/all.min.css'; ?>" />
    <link rel="stylesheet" href="<?php echo ASSETS_PATH.'/css/tree.css'; ?>" />
    <style>

    </style>
    <script type="text/javascript">

    </script>
</head>

<body>

    <div class="row mt-5">
        <div class="col-4 mx-auto">
            <?php
            function buildNestedList($data)
            {
                $html = '<ul id="nav-tree">';
                foreach ($data as $item) {
                    $totalItems = isset($item['sub_category']) && isset($item['total_items_with_sub_cat']) ? $item['total_items_with_sub_cat'] : $item['total_items'];
                    $html .= "<li id='li{$item['id']}' data-value='li{$item['id']}'><a href='javascript:void(0)'>{$item['name']} ({$totalItems})</a>";
                    if (isset($item['sub_category'])) {
                        $html .= buildNestedList($item['sub_category']);
                    }
                    $html .= '</li>';
                }
                $html .= '</ul>';

                return $html;
            }

            echo buildNestedList($data);
    ?>
        </div>
    </div>

    <script src="<?php echo ASSETS_PATH.'/js/bootstrap.bundle.min.js'; ?>"></script>
    <script src="<?php echo ASSETS_PATH.'/js/tree.js'; ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            NavTree.createBySelector("#nav-tree", {
                showEmptyGroups: true,

                groupOpenIconClass: "fas",
                groupOpenIcon: "fa-chevron-down",

                groupCloseIconClass: "fas",
                groupCloseIcon: "fa-chevron-right",

                linkIconClass: "fas",
                linkIcon: "fa-link",

                iconPlace: "start"
            });
        });
    </script>
</body>

</html>
