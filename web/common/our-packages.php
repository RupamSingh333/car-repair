<?php
// include('./system_config.php');
$getActivePackageList = getActiveSpecialPackageList(true); // Getting special packages
header('Content-Type: text/html; charset=utf-8');
?>

<div class="row g-4 justify-content-center">
    <?php if (!empty($getActivePackageList)) {
        $delay = 0.1;
        foreach ($getActivePackageList as $package) {
            // Handle image path
            $imagePath = !empty($package['package_image']) ? SITEPATH . "upload/thumb/" . $package['package_image'] : SITEPATH . "web/assets/img/default-package.jpg";

            // Truncate description
            $shortDesc = strip_tags($package['title']);
            if (strlen($shortDesc) > 100) {
                $shortDesc = substr($shortDesc, 0, 100) . '...';
            }
            // Detail Page Link
            $detailsUrl = SITEPATH . "/package-details.php?id=" . $package['package_id'];
            $encryptedId = urlencode(encryptItNew($package['package_id']));
            $slug = slugify($package['package_name']);
            $packageUrl = SITEPATH . 'packages?pid=' . $encryptedId . '&slug=' . $slug;
    ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?= number_format($delay, 1) ?>s">
                <div class="package-item" style="height: 100%; display: flex; flex-direction: column; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>" style="width: 100%; height: 250px; object-fit: cover;">
                    </div>
                    <div class="d-flex border-bottom" style="border-color: #ccc;">
                        <small class="flex-fill text-center border-end py-2" style="border-color: #ccc;"><i class="fa fa-hotel text-primary me-2"></i>Hotels</small>
                        <small class="flex-fill text-center border-end py-2" style="border-color: #ccc;"><i class="fa fa-taxi text-primary me-2"></i>Cabs</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-utensils text-primary me-2"></i>Meals</small>
                    </div>
                    <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h4 class="text-center mt-2" style=""><?php echo htmlspecialchars($package['package_name']); ?></h4>
                            <p class="text-center" style="font-size: 14px; margin-bottom: 10px;"><strong><?php echo htmlspecialchars($package['package_route_summary']); ?></strong></p>
                            <p style="text-align:center;"><?php echo htmlspecialchars($package['title']); ?></p>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="<?php echo $packageUrl; ?>" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                            <a href="#" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php $delay += 0.2; // Increase delay by 0.1s for each item 
        }
    } else { ?>
        <div class="col-12 text-center">
            <p>No special packages available at the moment.</p>
        </div>
    <?php } ?>
</div>