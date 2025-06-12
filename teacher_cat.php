<?php
include("system_config.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get user ID from session
$user_id = $_SESSION['userid'];

// Fetch user data from database
$user_data = getuser_byID($user_id);

// Pagination logic
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8; // Number of items per page
$offset = ($page - 1) * $limit;

// Fetch paginated categories
$rows_list = categories_list_service_type($limit, $offset);

// Ensure this function returns the total count of categories
// $total_categories = count_total_categories(); // Ensure this function returns the total count of categories
$total_pages = ceil($total_categories / $limit);
?>

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-img-top {
        width: 100%;
        height: 200px;
        /* Adjust as needed */
        object-fit: cover;
    }

    .card-body {
        flex: 1;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title a {
        text-decoration: none;
        color: #333;
    }

    .card-text a {
        color: #007bff;
        text-decoration: none;
    }

    .card-text a:hover {
        text-decoration: underline;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Pagination */
    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        padding: 8px 12px;
        border-radius: 5px;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
</style>

<div class="innerpagebg">
    <?php include('common/header.php'); ?>

    <!-- Breadcrumb Section -->
    <div class="breadcrumb-bar py-3">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <h2 class="breadcrumb-title">Our Tutor</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo htmlspecialchars(SITEPATH); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Tutor</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb Section -->

    <!-- Bookmark Content -->
    <div class="dashboard-content py-5">
        <div class="container">
            <div class="row">
                <?php foreach ($rows_list as $rows) { ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card">
                            <a href="<?php echo htmlspecialchars(SITEPATH); ?>Tutor-Users-List/<?php echo urlencode($rows['cat_name']); ?>/<?php echo htmlspecialchars($rows['cat_id']); ?>/Teacher">
                                <img src="<?php echo htmlspecialchars(SITEPATH); ?>/upload/thumb/<?php echo htmlspecialchars($rows['logo']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($rows['cat_name']); ?>">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title"><a href="<?php echo htmlspecialchars(SITEPATH); ?>Tutor-Users-List/<?php echo urlencode($rows['cat_name']); ?>/<?php echo htmlspecialchars($rows['cat_id']); ?>/Teacher"><?php echo htmlspecialchars($rows['cat_name']); ?></a></h4>
                                <p class="card-text"><a href="#" class="text-muted"><?php echo htmlspecialchars($rows['url']); ?></a></p>
                                <div class="text-center">
                                    <a href="<?php echo htmlspecialchars(SITEPATH); ?>Tutor-Users-List/<?php echo urlencode($rows['cat_name']); ?>/<?php echo htmlspecialchars($rows['cat_id']); ?>/Teacher" class="btn btn-primary">View Tutor</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <div class="pagination mt-4">
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="<?php if ($page > 1) echo "?page=" . ($page - 1); ?>"><i class="fas fa-arrow-left"></i> Prev</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                            <a class="page-link" href="<?php if ($page < $total_pages) echo "?page=" . ($page + 1); ?>">Next <i class="fas fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /Pagination -->
        </div>
    </div>
    <!-- /Bookmark Content -->

    <!-- Footer -->
    <?php include('common/footer.php'); ?>
</div>