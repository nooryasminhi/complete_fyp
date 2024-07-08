<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="style.css">

        <title>G&G</title>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="Index.html" class="nav__logo">GIVE & GATHER</a>

                <div class="nav__donor" id="nav-donor">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="manageUser.html" class="nav__link">Manage User</a></li>
                        <li class="nav__item"><a href="manageCharity.html" class="nav__link">Manage Charity</a></li>
                        <li class="nav__item"><a href="adminDashboard.html" class="nav__link">Dashboard</a></li>
                        <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-donor'></i>
                </div>
            </nav>
        </header>
        

        <?php
        Session::CheckSession();
        $sId = Session::get('roleid');
        if ($sId === '1') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
                $userAdd = $users->addNewUserByAdmin($_POST);
            }

            if (isset($userAdd)) {
                echo $userAdd;
            }
        ?>

        <section class="userManage-details">
            <h1 style="text-align: center;">User Management</h1>

            <!-- Add New User Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class='text-center'>Add New User</h3>
                </div>
                <div class="card-body">
                    <div style="width:600px; margin:0px auto">
                        <form action="" method="post">
                            <div class="form-group pt-3">
                                <label for="name">Your name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username">Your username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="roleid">Select user Role</label>
                                <select class="form-control" name="roleid" id="roleid">
                                    <option value="1">Admin</option>
                                    <option value="2">Editor</option>
                                    <option value="3">User only</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="addUser" class="btn btn-success">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- User Management Table -->
            <table style="width: 100%; margin-top: 20px;">
                <tr style="height: 50px;">
                    <th style="width: 25%;">Name</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 25%;">Phone Number</th>
                    <th style="width: 25%;">Action</th>
                </tr>
                <?php
                include 'db.php';

                $sql = "SELECT UserID, Name, Email, Phone FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["Name"] . "</td>
                                <td>" . $row["Email"] . "</td>
                                <td>" . $row["Phone"] . "</td>
                                <td>
                                    <a href='editUser.php?id=" . $row["UserID"] . "' class='btn btn-primary'>Edit</a>
                                    <a href='deleteUser.php?id=" . $row["UserID"] . "' class='btn btn-danger'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </section>

        <?php
        } else {
            header('Location:index.php');
        }
        ?>

        <?php include 'inc/footer.php'; ?>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--========== MAIN JS ==========-->
        <script src="javascript.js"></script>

        <style>
            .userManage-details {
                margin: 50px;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
                padding: 10px;
            }
        </style>
    </body>
</html>
