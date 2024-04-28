<?php
include("connection.php");
?>
<?php
if (isset($_POST['save'])) {
    $name       = $_POST['emp-name'];
    $gender     = $_POST['gender'];
    $email      = $_POST['email'];
    $department = $_POST['department'];
    $address    = $_POST['address'];

    $query = "INSERT INTO emp_management(emp_name,emp_gender,Emp_email,emp_dept,emp_add)
             VALUES('$name','$gender', '$email', '$department', '$address') ";

    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "Data saved into database";
    } else {
        echo "Failed to save data";
    }
}
?>
<?php
if (isset($_POST['search'])) {
    $searchID = $_POST['searchID'];

    $query = "SELECT * from emp_management WHERE id = '$searchID' ";
    $data = mysqli_query($conn, $query);

    $result = mysqli_fetch_array($data, MYSQLI_ASSOC);

    // $name = $result['emp_name'];
    // echo $name;

}
?>

<?php
if (isset($_POST['delete'])) {
    $searchID = $_POST['searchID'];

    $query = "DELETE from emp_management WHERE id = '$searchID' ";
    $data = mysqli_query($conn, $query);

    //    if($data){
    //     echo "Record Deleted";
    //    }
    //    else{
    //     echo "Failed to delete";
    //    }
}
?>
<?php
if (isset($_POST['modify'])) {

    $searchID   = $_POST['searchID'];
    $name       = $_POST['emp-name'];
    $gender     = $_POST['gender'];
    $email      = $_POST['email'];
    $department = $_POST['department'];
    $address    = $_POST['address'];

    $query = "UPDATE emp_management SET emp_name    =   '$name',
                                        emp_gender  =   '$gender',
                                        Emp_email   =   '$email',
                                        emp_dept    =   '$department',
                                        emp_add     =   '$address'
              WHERE id = '$searchID' ";
    $data = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
</head>

<body>
    <form action="#" method="POST">
        <div class="container">
            <h1>Employee Data Entry Automation Software</h1>
            <div class="form">
                <input type="text" name="searchID" id="searchid" placeholder="Search ID" value="<?php
                                                                                                if (isset($_POST['search'])) {
                                                                                                    echo $result['id'];
                                                                                                }
                                                                                                ?>">
                <input type="text" name="emp-name" id="emp-name" placeholder="Employee Name" value="<?php if (isset($_POST['search'])) {
                                                                                                        echo $result['emp_name'];
                                                                                                    } ?>">
                <select id="Gender" name="gender" value=" <?php
                                                            if (isset($_POST['search'])) {
                                                                echo $result['emp_gender'];
                                                            }
                                                            ?>
            ">
                    <option value="Not Selected">Select Gender</option>
                    <option value="<?php
                                    if ($result['emp_gender'] == 'Male') {
                                        echo "Selected";
                                    }
                                    ?> ">Male</option>
                    <option value="<?php
                                    if ($result['emp_gender'] == 'Female') {
                                        echo "Selected";
                                    }
                                    ?>">Female</option>
                    <option value="<?php
                                    if ($result['emp_gender'] == 'Others') {
                                        echo "Selected";
                                    }
                                    ?>">Others</option>
                </select>
                <input type="email" name="email" id="email" placeholder="Email Address" value="
            <?php
            if (isset($_POST['search'])) {
                echo $result['Emp_email'];
            }
            ?>
            ">
                <select id="Department" name="department" value="
            <?php
            if (isset($_POST['search'])) {
                echo $result['emp_dept'];
            }
            ?>
            ">
                    <option value="Not Selected">Select Department</option>
                    <option value="IT">IT</option>
                    <option value="Sales">Sales</option>
                    <option value="Business">Business</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing Department</option>
                    <option value="HR">Human Resources</option>
                    <option value="Administration">Administration</option>
                    <option value="RD">Research and Development</option>
                </select>
                <input type="text" name="address" id="address" placeholder="Address" value="
            <?php
            if (isset($_POST['search'])) {
                echo $result['emp_add'];
            }
            ?>">
                <div class="buttons">
                    <button type="submit" class="button" name="search" style="background:grey">Search</button>
                    <button type="submit" class="button" name="save" style="background:green">Save</button>
                    <button type="submit" class="button" name="modify" style="background:rgb(240, 179, 8)">Modify</button>
                    <button type="submit" class="button" name="delete" style="background:red" onclick="return confirmdelete()">Delete</button>
                    <button type="submit" class="button" name="clear" style="background:blue">Clear</button>
                </div>
            </div>
        </div>
    </form>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <script>
        function confirmdelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>


</body>

</html>