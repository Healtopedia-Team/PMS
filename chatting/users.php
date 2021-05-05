<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM user WHERE user_id = {$_SESSION['user_id']}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <img src="../assets/images/faces/1.jpg" alt="">
                    <div class="details">
                        <span>
                            <?php
                            echo $row['first_name'] . " " . $row['last_name'];
                            ?>
                        </span>
                        <p>
                            <?php
                            echo $row['status'];
                            ?>
                        </p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['user_id'] ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>
    <script src="js/users.js"></script>
</body>

</html>