<?php
include("../../system_config.php");
include_once("../common/head.php");
$name = "Add New Booking";
if (isset($_GET['id'])) {
    $name = "Update Booking";
    $id = decryptIt($_GET['id']);
    $res = getcareer_byID($id);
    // pr($res);exit;
} else {
    if ($r['user_type'] == "0") { ?>
        <script>
            window.location.href = "../dashboard.php";
        </script>
    <?php } ?>
<?php }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo SITEPATH; ?>syspanel/js/custom.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <?php include_once("../common/left_menu.php"); ?>
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <h1>
                    <?php if ($per['user']['add'] == 1) { ?>
                        <?php echo $name; ?>
                    <?php } else {
                        echo "&nbsp;";
                    } ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo SITEPATH; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">
                        <?php if ($per['user']['view'] == 1) { ?>
                            <?php echo $name; ?>
                        <?php } else {
                            echo "&nbsp;";
                        } ?>
                    </li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="box box-info">
                    <form id="form" name="form" action="<?php echo SITEPATH; ?>admin/action/career.php?action=save" method="post">
                        <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
                        <div class="box-body">
                            <div class="row">
                                <!-- Client Details Section -->
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" required name="client_name" placeholder="Enter name" type="text" value="<?php echo $res['client_name']; ?>" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input class="form-control" required name="client_contact" placeholder="Enter phone" value="<?php echo $res['client_contact']; ?>" type="tel" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="form-control" required name="client_email" placeholder="Enter email" value="<?php echo $res['client_email']; ?>" type="email" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                </div>

                                <!-- Event Details Section -->
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Event Type</label>
                                        <select name="event_type" class="form-control" required>
                                            <option value="">Select Event Type</option>
                                            <option value="Wedding" <?php echo ($res['event_type'] == 'Wedding') ? 'selected' : ''; ?>>Wedding</option>
                                            <option value="Corporate" <?php echo ($res['event_type'] == 'Corporate') ? 'selected' : ''; ?>>Corporate</option>
                                            <option value="Private" <?php echo ($res['event_type'] == 'Private') ? 'selected' : ''; ?>>Private</option>
                                            <option value="Other" <?php echo ($res['event_type'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Event Date</label>
                                        <input class="form-control" required name="event_date" min="<?= date('Y-m-d'); ?>" value="<?php echo $res['event_date']; ?>" type="date" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Event Time</label>
                                        <input class="form-control" required name="event_time" value="<?php echo $res['event_time']; ?>" type="time" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <h4 class="divd">Artist Info Section</h4>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Venue Address</label>
                                        <input class="form-control" required name="venue_address" placeholder="Enter venue address" value="<?php echo $res['venue_address']; ?>" type="text" onFocus="txtFocus(this);" onfocusout="txtFocusOut(this);">
                                        <label class="label-brdr" style="width: 0%;"></label>
                                    </div>
                                </div>

                                <!-- Artist Info Section -->
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Artist Type</label>
                                        <?php
                                        // Convert the comma-separated string into an array
                                        $artist_types = json_decode($res['artist_type'], true) ?? [];
                                        // pr($artist_types);
                                        // exit;
                                        ?>
                                        <select name="artist_type[]" class="form-control" multiple required>
                                            <option value="Singers: Solo, Duet, Choir" <?php echo in_array('Singers: Solo, Duet, Choir', $artist_types) ? 'selected' : ''; ?>>Singers: Solo, Duet, Choir</option>
                                            <option value="Musicians: Instrumentalists, Percussion, Flute" <?php echo in_array('Musicians: Instrumentalists, Percussion, Flute', $artist_types) ? 'selected' : ''; ?>>Musicians: Instrumentalists, Percussion, Flute</option>
                                            <option value="Bands: Live, Acoustic, Jazz" <?php echo in_array('Bands: Live, Acoustic, Jazz', $artist_types) ? 'selected' : ''; ?>>Bands: Live, Acoustic, Jazz</option>
                                            <option value="DJs: Bollywood, EDM, Regional" <?php echo in_array('DJs: Bollywood, EDM, Regional', $artist_types) ? 'selected' : ''; ?>>DJs: Bollywood, EDM, Regional</option>
                                            <option value="Dancers: Solo, Group, Traditional" <?php echo in_array('Dancers: Solo, Group, Traditional', $artist_types) ? 'selected' : ''; ?>>Dancers: Solo, Group, Traditional</option>
                                            <option value="Anchors: Male/Female" <?php echo in_array('Anchors: Male/Female', $artist_types) ? 'selected' : ''; ?>>Anchors: Male/Female</option>
                                            <option value="Special Acts: Comedians, Magicians, Fire Shows" <?php echo in_array('Special Acts: Comedians, Magicians, Fire Shows', $artist_types) ? 'selected' : ''; ?>>Special Acts: Comedians, Magicians, Fire Shows</option>
                                            <option value="Visuals: Sand Art, Painters, Light Shows" <?php echo in_array('Visuals: Sand Art, Painters, Light Shows', $artist_types) ? 'selected' : ''; ?>>Visuals: Sand Art, Painters, Light Shows</option>
                                            <option value="Unique Acts: Beatboxers, Rap, Poetry" <?php echo in_array('Unique Acts: Beatboxers, Rap, Poetry', $artist_types) ? 'selected' : ''; ?>>Unique Acts: Beatboxers, Rap, Poetry</option>
                                            <option value="Speakers: Motivational, Corporate" <?php echo in_array('Speakers: Motivational, Corporate', $artist_types) ? 'selected' : ''; ?>>Speakers: Motivational, Corporate</option>
                                        </select>


                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Genre Preference</label>
                                        <select name="genre_preference" class="form-control" required>
                                            <option value="Bollywood" <?php echo ($res['genre_preference'] == 'Bollywood') ? 'selected' : ''; ?>>Bollywood</option>
                                            <option value="Sufi" <?php echo ($res['genre_preference'] == 'Sufi') ? 'selected' : ''; ?>>Sufi</option>
                                            <option value="Classical" <?php echo ($res['genre_preference'] == 'Classical') ? 'selected' : ''; ?>>Classical</option>
                                            <option value="Folk" <?php echo ($res['genre_preference'] == 'Folk') ? 'selected' : ''; ?>>Folk</option>
                                            <option value="Rock" <?php echo ($res['genre_preference'] == 'Rock') ? 'selected' : ''; ?>>Rock</option>
                                            <option value="Jazz" <?php echo ($res['genre_preference'] == 'Jazz') ? 'selected' : ''; ?>>Jazz</option>
                                            <option value="EDM" <?php echo ($res['genre_preference'] == 'EDM') ? 'selected' : ''; ?>>EDM</option>
                                            <option value="Acoustic" <?php echo ($res['genre_preference'] == 'Acoustic') ? 'selected' : ''; ?>>Acoustic</option>
                                            <option value="Regional" <?php echo ($res['genre_preference'] == 'Regional') ? 'selected' : ''; ?>>Regional</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Budget Range</label>
                                        <select name="budget_range" class="form-control" required>
                                            <!-- <option value="1000-5000" <?php echo ($res['budget_range'] == '1000-5000') ? 'selected' : ''; ?>>₹1,000 - ₹5,000</option> -->
                                            <option value="5000-10000" <?php echo ($res['budget_range'] == '5000-10000') ? 'selected' : ''; ?>>₹5,000 - ₹10,000</option>
                                            <option value="10000-20000" <?php echo ($res['budget_range'] == '10000-20000') ? 'selected' : ''; ?>>₹10,000 - ₹20,000</option>
                                            <option value="20000-50000" <?php echo ($res['budget_range'] == '20000-50000') ? 'selected' : ''; ?>>₹20,000 - ₹50,000</option>
                                            <option value="50000-100000" <?php echo ($res['budget_range'] == '50000-100000') ? 'selected' : ''; ?>>₹50,000 - ₹1,00,000</option>
                                            <option value="100000-500000" <?php echo ($res['budget_range'] == '100000-500000') ? 'selected' : ''; ?>>₹1,00,000 - ₹5,00,000</option>
                                            <option value="500000-1000000" <?php echo ($res['budget_range'] == '500000-1000000') ? 'selected' : ''; ?>>₹5,00,000 - ₹10,00,000</option>
                                            <option value="above-1000000" <?php echo ($res['budget_range'] == 'above-1000000') ? 'selected' : ''; ?>>Above ₹10,00,000</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Resume</label>
                                        <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                                    </div>
                                </div> -->

                                <!-- Additional Details Section -->
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Special Requests</label>
                                        <input class="form-control" maxlength="500" name="special_requests" placeholder="Enter any special requests" value="<?php echo $res['special_requests']; ?>" type="text">
                                    </div>
                                </div>
                                <div class="box-footer clearfix"> </div>

                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Audience Size</label>
                                        <input class="form-control" name="audience_size" placeholder="Enter audience size" value="<?php echo $res['audience_size']; ?>" type="number">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="user_status" name="status" class="form-control">
                                            <option value="Y" <?php echo ($res['status'] == 'Y') ? 'selected' : ''; ?>>Active</option>
                                            <option value="N" <?php echo ($res['status'] == 'N') ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="btn-submit-active">
                                    <input type="submit" id="validate" value="Submit" />
                                    <span></span>
                                </div>
                                <a href="<?php echo SITEPATH; ?>admin/career" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>

                    <div class="box-footer clearfix"> </div>
                </div>
            </section>
        </div>
        <!--close page contets , start footer-->

        <footer class="main-footer">
            <?php include_once("../common/copyright.php"); ?>
        </footer>
    </div>
    <?php include_once("../common/footer.php"); ?>
</body>

</html>