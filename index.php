<?php
require "header.php";
include 'connect.php';

if (isset($_GET['del'])) {
    $delQuery = "DELETE from company WHERE id=" . $_GET['del'];
    $conn->query($delQuery);
    header("Location:index.php?msg=del");
}

if (isset($_POST['btnSave'])) {
    if (isset($_GET['id'])) {
        $query_edit = "UPDATE company SET cpname ='" . $_POST['cpname'] . "', opyear ='". $_POST['opyear'] ."', email ='". $_POST['email'] ."', mobile =". $_POST['mobile'] . ", city ='" . $_POST['city']. "', totalemp='" . $_POST['totalemp'] ."', ctperson='". $_POST['ctperson'] . "' WHERE id=" . $_GET['id'];
        $statement = $conn->query($query_edit);
        header("Location:index.php?msg=upt");
    } else {
        $query = "INSERT INTO `company` (cpname, opyear, email, mobile, city, totalemp, ctperson, isshown) VALUES('" . $_POST['cpname'] . "','" . $_POST['opyear'] . "','" . $_POST['email'] . "'," . $_POST['mobile'] . ", '" . $_POST['city'] . "', " . $_POST['totalemp'] . ", '" . $_POST['ctperson'] . "', 1)";
        //echo $query;exit;
        $result = $conn->query($query);
        if ($result) {
            echo "Record Inserted Successfully";
            header('Location:index.php?msg=save');
        } else {
            die(mysqli_connect_error($conn));
        }
    }
}

// Display Records
$sql_exec = "SELECT * FROM company";
$resultDisplay = $conn->query($sql_exec);
//print_r($resultDisplay); exit;

if (isset($_GET['id'])) {
    //echo "Hi";exit;
    $sel_query = "SELECT * FROM company WHERE id = " . $_GET['id'];
    $result = $conn->query($sel_query);
    $res = mysqli_fetch_assoc($result);
}
?>
<?php
if (isset($_GET['type'])) {
    if (($_GET['type'] == "add") || $_GET['type'] == "edit") {
        ?>

<!-- Company Form -->
<div class="container">
    <form action="" method="post">
        <!--Company Name-->
        <div class="mb-5">
            <label for="cpname">Company Name: </label>
            <input type="text" class=" form-control" name="cpname" placeholder="Enter Company Name" value="<?php if (isset($_GET['id'])) {
                echo $res['cpname'];
            } ?>">
        </div>

        <!--Opening Year-->
        <div class="mb-5">
            <label for="opyear">Opening Year: </label>
            <input type="text" class=" form-control" name="opyear" placeholder="Enter Opening Year" autocomplete="off"
                value="<?php if (isset($_GET['id'])) {
                    echo $res['opyear'];
                } ?>">
        </div>

        <!--Email-->
        <div class="mb-5">
            <label for="email">Email: </label>
            <input type="text" class="form-control" name="email" placeholder="Enter Email" autocomplete="off" value="<?php if (isset($_GET['id'])) {
                echo $res['email'];
            } ?>">
        </div>

        <!--Mobile-->
        <div class="mb-5">
            <label for="mobile">Mobile: </label>
            <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile No" autocomplete="off"
                value="<?php if (isset($_GET['id'])) {
                    echo $res['mobile'];
                } ?>">
        </div>

        <!--City-->
        <div class="mb-5">
            <label for="cname">City: </label>
            <input type="text" class="form-control" name="city" placeholder="Enter City" autocomplete="off" value="<?php if (isset($_GET['id'])) {
                echo $res['city'];
            } ?>">
        </div>

        <!--No. of Employee -->
        <div class="mb-5">
            <label for="totalemp">Total Employees: </label>
            <input type="text" class="form-control" name="totalemp" placeholder="Total Employee" autocomplete="off"
                value="<?php if (isset($_GET['id'])) {
                    echo $res['totalemp'];
                } ?>">
        </div>

        <!--Contact Person-->
        <div class="mb-5">
            <label for="ctperson">Contact Person </label>
            <input type="text" class="form-control" name="ctperson" placeholder="Contact Person" autocomplete="off"
                value="<?php if (isset($_GET['id'])) {
                    echo $res['ctperson'];
                } ?>">
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" name="btnSave">Submit</button>
    </form>
</div>
<?php
    }
} else {
    ?>
<!--showing message when insert OR update OR delete -->
<div class="container">
    <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == "save") {
                ?>
    <div class="alert alert-success">
        <p>Saved Successfully</p>
    </div>
    <?php
            } elseif ($_GET['msg'] == "upt") {
                ?>
    <div class="alert alert-success">
        <p>Updated Successfully</p>
    </div>
    <?php
            } else {
                ?>
    <div class="alert alert-success">
        <p>Deleted Successfully</p>
    </div>
    <?php
            } ?>
</div>
<?php
        } ?>

<!-- Display Records-->
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Opening Year</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Total Employee</th>
                <th>Contact Person</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php while ($row = $resultDisplay->fetch_assoc()): ?>
        <tr>
            <div class="data-display">
                <td>
                    <?php echo $row['cpname']; ?>
                </td>
                <td>
                    <?php echo $row['opyear']; ?>
                </td>
                <td>
                    <?php echo $row['email']; ?>
                </td>
                <td>
                    <?php echo $row['mobile']; ?>
                </td>
                <td>
                    <?php echo $row['city']; ?>
                </td>
                <td>
                    <?php echo $row['totalemp']; ?>
                </td>
                <td>
                    <?php echo $row['ctperson']; ?>
                </td>
                <td>
                    <a href="index.php?type=edit&id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </div>
        </tr>
        <?php
        endwhile; ?>
    </table>
</div>
<?php
}
?>
</body>

</html>
