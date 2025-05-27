<head>
    <link rel="stylesheet" href="style/nav.css">

    <style>
        .nav-left,
        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .dropdown {
            position: relative;
        }

        .dropbtn {
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            border: 2px solid black;
            padding: 5px;
            width: 200px;
            text-align: center;
            border-radius: 5px;
            background-color: rgba(53, 52, 52, 0.5);
            font-size: 16px;
            cursor: pointer;
        }

        .dropbtn:hover {
            background-color: rgb(17, 17, 17);
            box-shadow: 0 0 8px rgb(243, 243, 243);
            color: #fff;
            transform: scale(1.05);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #222;
            min-width: 180px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1;
            top: 100%;
            padding-top: 10px;
        }

        .dropdown-content a {
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: rgb(17, 17, 17);
            box-shadow: 0 0 8px rgb(243, 243, 243);
            color: red;
            border-radius: 5px;

        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .logout-btn {
            color: #ffffff;
            text-decoration: none;
            border: 2px solid black;
            padding: 5px;
            width: 200px;
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            background-color: rgba(53, 52, 52, 0.5);
            transition: 0.5s ease;
            flex: 1 1 auto;
        }

        .logout-btn:hover {
            background-color: rgb(17, 17, 17);
            box-shadow: 0 0 8px rgb(243, 243, 243);
            color: rgb(149, 247, 247);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-left,
            .nav-right {
                flex-direction: column;
                width: 100%;
                gap: 10px;
                margin-top: 10px;
            }

            .dropdown {
                width: 100%;
            }

            .dropdown-content {
                position: static;
                width: 100%;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropbtn {
                text-align: center;
                width: 100%;
            }

            .logout-btn {
                align-self: flex-start;
                width: 100%;
            }
        }
    </style>
</head>
<nav>
    <div class="logo"><span style="letter-spacing: 10px; font-size:3rem">RIDESYNC</span></div>
    <div class="nav-left">
        <div class="dropdown">
            <button class="dropbtn">Registrations</button>
            <div class="dropdown-content">
                <a href="register_owner.php">Register Bus Owner</a>
                <a href="register_driver.php">Register Driver</a>
                <a href="register_bus.php">Register Bus</a>
                <a href="register_route.php">Register Route</a>
                <a href="PD9waHAgZWNobyAiUklERVNZTkMgQWRtaW4gU2lnbnVwIjsgPz4=.php">Register Admin</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Viewings</button>
            <div class="dropdown-content">
                <a href="view_routes.php">View Routes</a>
                <a href="view_bookings.php">View Bookings</a>
                <a href="view_records.php">View Records</a>
                <a href="view_users.php">View Users</a>
                <a href="view_admins.php">View Admins</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Other</button>
            <div class="dropdown-content">
                <a href="book_route_admin.php">Book a Route</a>
                <a href="post_message.php">Post Message</a>
                <a href="contact_message.php">Contact Messages</a>
                <a href="signin.php">User</a>
            </div>
        </div>
    </div>

    <div class="nav-right">
        <button class="logout-btn" onclick="window.location.href='admin_logout.php'">Logout</button>
    </div>
</nav>
</nav>