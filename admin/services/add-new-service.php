<?php
include("../../system_config.php");
include_once("../common/head.php");

$name = "Add New Service";
$id = "";
$row = [];

if (isset($_GET['id'])) {
    $name = "Update Service";
    $id = urlencode(decryptIt($_GET['id']));
    $row = get_service_byID($id); // <-- Make sure this function exists
}
?>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1><?php echo $name; ?></h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?php echo $name; ?></li>
                </ol>
            </section>

            <section class="content">
                <div class="box box-info">
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/service.php?action=save" method="post" enctype="multipart/form-data">
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
                        <div class="box-body">
                            <div class="row">

                                <!-- Service Name -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Service Name</label>
                                        <input id="service_name" placeholder="Service Name" class="form-control" name="service_name" type="text" required
                                            value="<?php echo (isset($row['service_name'])) ? $row['service_name'] : ''; ?>" />
                                    </div>
                                </div>


                                <!-- Slug (URL) -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Service URL</label>
                                        <input id="service_slug" name="service_slug" type="text" class="form-control" readonly
                                            value="<?php echo isset($row['service_slug']) ? $row['service_slug'] : ''; ?>" required />
                                    </div>
                                </div>


                                <!-- Service Title -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Service Title</label>
                                        <input id="service_title" placeholder="Service Title" class="form-control" name="service_title" type="text" required
                                            value="<?php echo (isset($row['service_title'])) ? $row['service_title'] : ''; ?>" />
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- First Column: Input for selecting an icon -->
                                    <div class="col-sm-4 position-relative">
                                        <div class="form-group">
                                            <label>FontAwesome Icon Class</label>
                                            <input type="text" id="icon_class" name="icon_class" class="form-control"
                                                value="<?php echo isset($row['icon_class']) ? htmlspecialchars($row['icon_class']) : ''; ?>"
                                                placeholder="Type or select an icon (e.g. fa-hotel)" autocomplete="off" />

                                            <!-- Dropdown Suggestions -->
                                            <div id="iconSuggestions" class="dropdown-menu p-2" style="display: none; max-height: 200px; overflow-y: auto; width: auto; position: absolute; right: 0; top: 100%;">
                                                <?php
                                                $iconOptions = [
                                                    'fa-suitcase-rolling',
                                                    'fa-hotel',
                                                    'fa-map-marked-alt',
                                                    'fa-landmark',
                                                    'fa-mountain',
                                                    'fa-umbrella-beach',
                                                    'fa-route',
                                                    'fa-binoculars',
                                                    'fa-plane-departure',
                                                    'fa-globe',
                                                    'fa-campground',
                                                    'fa-ship',
                                                    'fa-car',
                                                    'fa-tree',
                                                    'fa-camera-retro',
                                                    'fa-compass',
                                                    'fa-bus',
                                                    'fa-skiing',
                                                    'fa-hiking',
                                                    'fa-passport'
                                                ];
                                                foreach ($iconOptions as $icon) {
                                                    echo "<div class='suggestion-item' style='cursor:pointer; padding:5px;' data-icon=\"$icon\">
                        <i class=\"fa $icon me-2\"></i> $icon
                    </div>";
                                                }
                                                ?>
                                            </div>
                                            <small class="text-muted">Start typing or select from the suggestions below.</small>
                                        </div>
                                    </div>

                                </div>



                                <style>
                                    #iconSuggestions {
                                        display: none;
                                        position: absolute;
                                        z-index: 100;
                                        background: white;
                                        border: 1px solid #ddd;
                                        width: 100%;
                                        max-height: 200px;
                                        overflow-y: auto;
                                        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                                    }

                                    .suggestion-item {
                                        padding: 8px 10px;
                                        cursor: pointer;
                                    }

                                    .suggestion-item:hover {
                                        background-color: #f5f5f5;
                                    }
                                </style>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const iconInput = document.getElementById("icon_class");
                                        const suggestionsBox = document.getElementById("iconSuggestions");
                                        const selectedIconDisplay = document.getElementById("selectedIconDisplay");
                                        const selectedIcon = document.getElementById("selectedIcon");

                                        // Show suggestions when the input field is focused or clicked
                                        iconInput.addEventListener("focus", function() {
                                            suggestionsBox.style.display = "block";
                                        });

                                        iconInput.addEventListener("click", function() {
                                            suggestionsBox.style.display = "block";
                                        });

                                        // When a suggestion is clicked, update the input value and hide the suggestions box
                                        suggestionsBox.addEventListener("click", function(e) {
                                            if (e.target.classList.contains("suggestion-item")) {
                                                const selectedIconClass = e.target.dataset.icon;
                                                iconInput.value = selectedIconClass; // Update the input field
                                                selectedIcon.className = "fa " + selectedIconClass + " fa-3x text-primary"; // Update the icon display
                                                suggestionsBox.style.display = "none"; // Hide the suggestions box after selection
                                            }
                                        });

                                        // Hide suggestions when clicking outside of the input field or suggestion box
                                        document.addEventListener("click", function(e) {
                                            if (!iconInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                                                suggestionsBox.style.display = "none"; // Hide suggestions box if click is outside
                                            }
                                        });

                                        // Optional: Auto-hide suggestions if user starts typing (without clicking)
                                        iconInput.addEventListener("input", function() {
                                            if (iconInput.value.trim() === "") {
                                                suggestionsBox.style.display = "none"; // Hide if input is empty
                                            }
                                        });
                                    });
                                </script>

                                <!-- Upload Image -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="images" id="images" accept="image/*" class="form-control" />
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control">
                                            <?php
                                            foreach ($config['display_status'] as $key => $value) {
                                                $selected = ($key == $row['status']) ? ' selected="selected"' : '';
                                                echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- here add new filds radio button  is special for service -->
                                <div class="col-sm-4">
                                    <div class="form-group
">
                                        <label>Is Special</label>
                                        <div class="radio">
                                            <label><input type="radio" name="is_special" value="Y" <?php echo (isset($row['is_special']) && $row['is_special'] == "Y") ? 'checked' : ''; ?>>Special</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="is_special" value="N" <?php echo (isset($row['is_special']) && $row['is_special'] == "N") ? 'checked' : ''; ?>>No</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit and Cancel -->
                                <div class="clearfix"></div>
                                <div class="btn-submit-active">
                                    <input type="submit" value="Submit" />
                                    <span></span>
                                </div>
                                <a href="<?php echo SITEPATH; ?>admin/services" class="btn btn-cancel">Cancel</a>

                            </div> <!-- /.row -->
                        </div> <!-- /.box-body -->
                    </form>
                    <div class="box-footer clearfix"> </div>
                </div>
            </section>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nameInput = document.getElementById('service_name');
                const slugInput = document.getElementById('service_slug');

                function slugify(text) {
                    return text.toString().toLowerCase()
                        .trim()
                        .replace(/\s+/g, '-') // Replace spaces with -
                        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                        .replace(/\-\-+/g, '-'); // Replace multiple - with single -
                }

                nameInput.addEventListener('input', function() {
                    slugInput.value = slugify(nameInput.value);
                });
            });
        </script>

        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>
</body>

</html>