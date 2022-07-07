<?php require_once('./includes/header.php'); ?>

<div class="container">
    <h2 class="pt-4">User Update</h2>

    <!-- This section is for editing (Edit) -->
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header("Location: index.php");
    } else {
        $user_id = $_POST['val'];
        $sql = 'SELECT * FROM users WHERE user_id = ?';
        $stmt = mysqli_stmt_init($link);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Query failed");
        } else {
            mysqli_stmt_bind_param($stmt, 'i', $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_email = $row['user_email'];
                $user_password = $row['user_password'];
            }
        }
    }

    ?>

    <!-- This section is for updating (Update) -->
    <?php

    if (isset($_POST['submit'])) {
        $id = $_POST['val'];
        $user_name = trim($_POST['username']);
        $user_email = trim($_POST['email']);
        $user_password = trim($_POST['password']);

        if (empty($user_name) || empty($user_email) || empty($user_password)) {
            echo "<div class='alert alert-danger'> Field cannot be empty! </div>";
        } else {
            $sql = 'UPDATE `users` SET `user_name`=?,`user_email`=?,`user_password`=? WHERE `user_id` = ?';
            $stmt = mysqli_stmt_init($link);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("Query Failed");
            } else {
                mysqli_stmt_bind_param($stmt, 'sssi', $user_name, $user_email, $user_password, $id);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'> User updated successfully! <a href='index.php'>Back</a></div>";
            }
        }
    }

    ?>

    <form class="py-2" action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?php echo "$user_name"; ?>">
            <input type="hidden" name="val" value="<?php echo $user_id ?>">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo "$user_email"; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="<?php echo "$user_password"; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href="index.php">Back</a>
    </form>
</div>

<?php require_once('./includes/footer.php'); ?>