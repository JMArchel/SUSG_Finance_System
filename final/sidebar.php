<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/sidebar.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="images/susg-finance-icon.png">
    </head>
<body>
    <div class="sidebar close">
        <div class="logo-details" style="padding-bottom: 3px;">
            <i class='bx bx-menu' ></i>
            <span class="links_name"><a class="sidebar-title" href="general_information">SUSG Finance System</a></span>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                <a>
                    <i class='bx bx-group' ></i>
                    <span class="link_name">Committees</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name">Committees</a></li>
                    <li><a href="com_advocacy">Advocacy</a></li>
                    <li><a href="com_cheering">Cheering</a></li>
                    <li><a href="com_comso">COMSO</a></li>
                    <li><a href="com_dorm_life">Dorm Life</a></li>
                    <li><a href="com_educational_services">Educational Services</a></li>
                    <li><a href="com_environment">Environment</a></li>
                    <li><a href="com_finance">Finance</a></li>
                    <li><a href="com_health">Health</a></li>
                    <li><a href="com_hert">HERT</a></li>
                    <li><a href="com_high_school_affairs">High School Affairs</a></li>
                    <li><a href="com_infomedia">Infomedia</a></li>
                    <li><a href="com_marketing">Marketing</a></li>
                    <li><a href="com_miss_silliman">Miss Silliman</a></li>
                    <li><a href="com_research">Research</a></li>
                    <li><a href="com_resolutions">Resolutions</a></li>
                    <li><a href="com_secretariat">Secretariat</a></li>
                    <li><a href="com_social_services">Social Services</a></li>
                    <li><a href="com_socio_cultural">Socio-Cultural</a></li>
                    <li><a href="com_special_projects">Special Projects</a></li>
                    <li><a href="com_spiritual_life">Spiritual Life</a></li>
                    <li><a href="com_sports">Sports</a></li>
                    <li><a href="com_straw">STRAW</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="link_name">Funds</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name">Funds</a></li>
                    <li><a href="fund_initial_susg">Initial SUSG</a></li>
                    <li><a href="fund_assembly_general">Assembly General</a></li>
                    <li><a href="fund_assembly_sponsorship">Assembly Sponsorship</a></li>
                    <li><a href="fund_comelec">COMELEC</a></li>
                    <li><a href="fund_gender_inclusivity">Gender Inclusivity</a></li>
                    <li><a href="fund_president_discretionary">President Discretionary</a></li>
                    <li><a href="fund_vice_president_discretionary">Vice President Discretionary</a></li>
                </ul>
            </li>
            <br>
            <li>
                <div class="iocn-link">
                <a href="general_information">
                    <i class='bx bx-home-alt'></i>
                    <span class="link_name">General Information</span>
                </a>
            </li>
            <li>
                <a href="cash_advances">
                    <i class='bx bx-credit-card-alt' ></i>
                    <span class="link_name">Cash Advances</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-money-withdraw' ></i>
                    <span class="link_name">Reimbursements</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-notepad' ></i>
                    <span class="link_name">Requisitions</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-coin-stack'></i>
                    <span class="link_name">Petty Cash</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-money' ></i>
                    <span class="link_name">Cash Generated</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-body' ></i>
                    <span class="link_name">Sponsorship</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                    <header class="img"><a class="prof" href="profile_info"><?php echo ucwords(htmlspecialchars($_SESSION["profile"])); ?></a></header>
                    </div>
                    <div class="name-job">
                        <div class="profile_name"><?php echo ucwords(htmlspecialchars($_SESSION["last_name"])); ?></div>
                        <div class="job"><?php echo ucwords(htmlspecialchars($_SESSION["first_name"])); ?></div>
                    </div>
                    <a href="account_logout">
                        <i class='bx bx-log-out'></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <script src="js/sidebar.js"></script>
</body>
</html>