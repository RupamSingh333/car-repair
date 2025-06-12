<?php
include(__DIR__ . '/../common/header.php');
// pr($_GET);die;
$primary_value = isset($_GET['pid']) ? decryptItNew($_GET['pid']) : null;
$package = getPackagebyID($primary_value);
// pr($package);exit;
// Check if the package name exists
$package_name = isset($package['package_name']) && !empty($package['package_name']) ? $package['package_name'] : 'No name available';
$package_img = isset($package['package_image']) && !empty($package['package_image']) ? $package['package_image'] : 'default.jpg';
$package_description = isset($package['package_description']) && !empty($package['package_description']) ? $package['package_description'] : 'No description available';

?>



<div class="container-fluid bg-primary py-5 mb-5 hero-header"
    style="background: linear-gradient(rgba(20, 20, 31, .7), rgba(20, 20, 31, .7)), url('<?php echo SITEPATH; ?>upload/thumb/<?php echo htmlspecialchars($package_img); ?>'); 
           background-position: center center;
           background-repeat: no-repeat;
           background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <!-- Display dynamic package name or fallback if not available -->
                <h1 class="display-3 text-white animated slideInDown"><?php echo htmlspecialchars($package_name); ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo htmlspecialchars($package_name); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

</div>
<!-- Navbar & Hero End -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6 class="section-title bg-white text-center text-primary px-3"><?php echo htmlspecialchars($package_name); ?></h6>
            <p></p>
            <div class="text-justify package-description">
                <!-- Safely render the HTML content from the database -->
                <?php echo html_entity_decode($package_description); ?>
            </div>
            <!-- <strong class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>DAY 01: ARRIVAL SRINAGAR AIRPORT</strong>
            <p>Welcome to Srinagar, the summer capital of Jammu and Kashmir! Upon arrival at the Srinagar International Airport, you will be greeted by our representative who will assist you with your luggage and transfer you to your hotel.
                Srinagar is a beautiful city located in the heart of the Kashmir Valley and is known for its scenic beauty, serene lakes, and Mughal gardens. After checking into your hotel, you can relax for a while and then head out to explore the city.
                In the evening, you can take a leisurely stroll around the famous Dal Lake, where you can take a shikara ride and enjoy the serene beauty of the lake and its surroundings. You can also visit the local markets and indulge in some shopping for traditional Kashmiri handicrafts, such as pashmina shawls, carpets, and handwoven fabrics.
                Enjoy a comfortable overnight stay at your hotel in Srinagar and get ready for an exciting day ahead.</p>
            <strong class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>DAY 02: SRINAGAR-PAHALGAM</strong>
            <p>Welcome to Srinagar, the summer capital of Jammu and Kashmir! Upon arrival at the Srinagar International Airport, you will be greeted by our representative who will assist you with your luggage and transfer you to your hotel.
                Srinagar is a beautiful city located in the heart of the Kashmir Valley and is known for its scenic beauty, serene lakes, and Mughal gardens. After checking into your hotel, you can relax for a while and then head out to explore the city.
                In the evening, you can take a leisurely stroll around the famous Dal Lake, where you can take a shikara ride and enjoy the serene beauty of the lake and its surroundings. You can also visit the local markets and indulge in some shopping for traditional Kashmiri handicrafts, such as pashmina shawls, carpets, and handwoven fabrics.
                Enjoy a comfortable overnight stay at your hotel in Srinagar and get ready for an exciting day ahead.</p>
            <strong class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>DAY 03: PAHALGAM-SRINAGAR</strong>
            <p>Welcome to Srinagar, the summer capital of Jammu and Kashmir! Upon arrival at the Srinagar International Airport, you will be greeted by our representative who will assist you with your luggage and transfer you to your hotel.
                Srinagar is a beautiful city located in the heart of the Kashmir Valley and is known for its scenic beauty, serene lakes, and Mughal gardens. After checking into your hotel, you can relax for a while and then head out to explore the city.
                In the evening, you can take a leisurely stroll around the famous Dal Lake, where you can take a shikara ride and enjoy the serene beauty of the lake and its surroundings. You can also visit the local markets and indulge in some shopping for traditional Kashmiri handicrafts, such as pashmina shawls, carpets, and handwoven fabrics.
                Enjoy a comfortable overnight stay at your hotel in Srinagar and get ready for an exciting day ahead.</p> -->
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <?php include(__DIR__ . '/../common/our-services.php'); ?>
</div>

<?php include(__DIR__ . '/../common/footer.php'); ?>