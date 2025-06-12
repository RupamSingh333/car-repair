<?php
include(__DIR__ . '/../common/header.php');

$primary_value = isset($_GET['did']) ? decryptItNew($_GET['did']) : null;
$destination = getDestinationByID($primary_value);

$destination_title         = isset($destination['title']) && !empty($destination['title']) ? $destination['title'] : 'No title available';
$destination_short_title   = isset($destination['short_title']) && !empty($destination['short_title']) ? $destination['short_title'] : '';
$destination_img           = isset($destination['image']) && !empty($destination['image']) ? $destination['image'] : 'default.jpg';
$destination_banner_img           = isset($destination['banner_image']) && !empty($destination['banner_image']) ? $destination['banner_image'] : 'default.jpg';
$destination_description   = isset($destination['description']) && !empty($destination['description']) ? $destination['description'] : 'No description available';
?>

<!-- Hero Section with Dynamic Image and Title -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header"
     style="background: linear-gradient(rgba(20, 20, 31, .7), rgba(20, 20, 31, .7)),
     url('<?php echo SITEPATH; ?>upload/thumb/<?php echo htmlspecialchars($destination_banner_img); ?>');
     background-position: center center;
     background-repeat: no-repeat;
     background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white animated slideInDown"><?php echo htmlspecialchars($destination_title); ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo htmlspecialchars($destination_title); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- About Section with Dynamic Image and Description -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Dynamic Image -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100"
                         src="<?php echo SITEPATH; ?>upload/thumb/<?php echo htmlspecialchars($destination_img); ?>"
                         alt="<?php echo htmlspecialchars($destination_title); ?>"
                         style="object-fit: cover;">
                </div>
            </div>

            <!-- Dynamic Title and Description -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h1 class="mb-4"><span class="text-primary"><?php echo htmlspecialchars($destination_title); ?></span></h1>
                <h6 class="section-title bg-white text-start text-primary pe-3"><?php echo htmlspecialchars($destination_short_title); ?></h6>
                <div class="mb-4">
                    <?php echo $destination_description; // Keep raw for editor content ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../common/footer.php'); ?>
