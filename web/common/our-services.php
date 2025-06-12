<?php
//include('./system_config.php');
$getServiceList = getActiveServiceList($isSpecial = true);

// pr($getActiveDestinationList);die;
?>

<div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
        <h1 class="mb-5">Our Services</h1>
    </div>

    <div class="row g-4">
        <?php
        $delay = 0.1;
        $defaultIcons = ['fa-suitcase-rolling', 'fa-hotel', 'fa-map-marked-alt', 'fa-landmark'];
        $i = 0;

        foreach ($getServiceList as $service) {
            // Use icon from DB if available, otherwise rotate from default icons
            $iconClass = !empty($service['icon_class']) ? $service['icon_class'] : $defaultIcons[$i % count($defaultIcons)];


        ?>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                <!-- <a href="<?php echo SITEPATH . 'services/'  . urlencode(encryptItNew($service['service_id'])) . '/' . $service['service_slug']; ?>"> -->
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x <?php echo htmlspecialchars($iconClass); ?> text-primary mb-4"></i>
                            <h5><?php echo htmlspecialchars($service['service_name']); ?></h5>
                            <p><?php echo htmlspecialchars($service['service_title']); ?></p>
                        </div>
                    </div>
                <!-- </a> -->
            </div>
        <?php
            $delay += 0.2;
            $i++;
        }
        ?>
    </div>

</div>