<?php
/*
- File: manage.php
- Author: Bach Gia Huy & Duy (manage.php co-owners)
- Jira Task: RWP-161 (Huy), RWP-162(Duy), RWP-163(Huy)
- COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03 Sustainable Energy Solutions
 *
- GenAI Usage Disclosure:
- Tool Used: Gemini
- Prompt Used: "Give me the full code for manage.php listing EOIs with filters and allow-list sorting."
 */


session_start();

// 1. SESSION CHECK (Security matching An's login.php)
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page_title = "Manage EOIs | Solstice Community Energy";
$page_description = "Manage Expressions of Interest";
$page_author = "Bach Gia Huy & Duy - Group 03 (Webdev67)";
$body_class = "page-manage";
$page_css = ""; 

require_once "settings.php";
require_once "functions.inc";
$conn = db_connect($host, $user, $pwd, $sql_db);

if (!function_exists('e')) {
    function e($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

include "header.inc";
include "nav.inc";

// --- FILTER & SORT LOGIC (RWP-163) ---
$job_ref_filter = isset($_GET['job_ref']) ? trim($_GET['job_ref']) : "";
$first_name_filter = isset($_GET['first_name']) ? trim($_GET['first_name']) : "";
$last_name_filter = isset($_GET['last_name']) ? trim($_GET['last_name']) : "";
$user_sort = isset($_GET['sort_by']) ? $_GET['sort_by'] : "eoi_id";

// Allow-list for secure sorting
$safe_sort_columns = ["eoi_id", "job_ref", "first_name", "last_name", "status"];
$order_column = in_array($user_sort, $safe_sort_columns) ? $user_sort : "eoi_id";
?>

<main id="main">
  <div class="container page-section">
    
    <header class="manage-header">
      <div>
        <h1>Manage Expressions of Interest</h1>
        <p>Review, filter, and manage incoming applications.</p>
      </div>
      <a href="logout.php" class="button" style="background-color: #dc3545; border-color: #dc3545; color: white;">Log Out</a>
    </header>

    <!-- Filter Form (RWP-163) -->
    <section class="manage-filters">
        <form action="manage.php" method="GET">
            <div class="filter-group">
                <div class="filter-item">
                    <label for="job_ref">Job Ref:</label>
                    <input type="text" name="job_ref" id="job_ref" value="<?php echo e($job_ref_filter); ?>" placeholder="e.g. SCE01">
                </div>
                <div class="filter-item">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" value="<?php echo e($first_name_filter); ?>">
                </div>
                <div class="filter-item">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" value="<?php echo e($last_name_filter); ?>">
                </div>
                <div class="filter-item">
                    <label for="sort_by">Sort By:</label>
                    <select name="sort_by" id="sort_by">
                        <option value="eoi_id" <?php if($order_column == 'eoi_id') echo 'selected'; ?>>EOI ID</option>
                        <option value="job_ref" <?php if($order_column == 'job_ref') echo 'selected'; ?>>Job Reference</option>
                        <option value="first_name" <?php if($order_column == 'first_name') echo 'selected'; ?>>First Name</option>
                        <option value="last_name" <?php if($order_column == 'last_name') echo 'selected'; ?>>Last Name</option>
                        <option value="status" <?php if($order_column == 'status') echo 'selected'; ?>>Status</option>
                    </select>
                </div>
                <div class="filter-item">
                    <button type="submit" class="button">Search</button>
                    <a href="manage.php" class="button btn-clear">Clear</a>
                </div>
            </div>
        </form>
    </section>

    <!-- Data Table (RWP-161 & RWP-163) -->
    <section class="manage-results">
        <?php
        if (!$conn) {
            echo "<p class='db-notice'>Database connection failed.</p>";
        } else {
            // Dynamic SQL Query using Prepared Statements (RWP-163)
            $sql = "SELECT * FROM eoi WHERE 1=1";
            $params = [];
            $types = "";

            if ($job_ref_filter !== "") {
                $sql .= " AND job_ref = ?";
                $params[] = $job_ref_filter;
                $types .= "s";
            }
            if ($first_name_filter !== "") {
                $sql .= " AND first_name LIKE ?";
                $params[] = "%" . $first_name_filter . "%";
                $types .= "s";
            }
            if ($last_name_filter !== "") {
                $sql .= " AND last_name LIKE ?";
                $params[] = "%" . $last_name_filter . "%";
                $types .= "s";
            }

            $sql .= " ORDER BY " . $order_column . " ASC";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                if (!empty($params)) {
                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                }
                
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='table-wrap'>";
                    echo "<table class='data-table'>";
                    echo "<thead>
                            <tr>
                                <th>ID</th>
                                <th>Job Ref</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                          </thead><tbody>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . e($row['eoi_id']) . "</td>";
                        echo "<td>" . e($row['job_ref']) . "</td>";
                        echo "<td>" . e($row['first_name']) . "</td>";
                        echo "<td>" . e($row['last_name']) . "</td>";
                        echo "<td>" . e($row['email']) . "</td>";
                        echo "<td><strong>" . e($row['status']) . "</strong></td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    echo "</div>";
                } else {
                    echo "<p>No Expressions of Interest found matching your criteria.</p>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Error preparing database query.</p>";
            }
        }
        ?>
    </section>

    <!-- DUY'S SECTION (RWP-162) -->
    <section class="manage-actions" style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--line);">
        <h2>Manager Actions</h2>
        <p><em>(Duy - RWP-162: Your forms to delete EOIs and change EOI statuses go here)</em></p>
    </section>
  </div>
</main>

<?php 
if ($conn) mysqli_close($conn);
include "footer.inc"; 
?>