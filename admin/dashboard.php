<html>

<head>
    <title>
        Dashboard - GREYHOUND RACING
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <a class="btn btn-solid btn-outline circle">Profile</a>
            <a class="btn btn-solid btn-outline circle">Game Settings</a>
            <a class="btn btn-solid btn-outline circle" href="/greyhound_racing/admin/bet_panel.php">Bet Panel</a>
            <a class="btn btn-solid btn-outline circle active" href="/greyhound_racing/admin/dashboard.php">Game</a>
            <a class="btn btn-solid btn-outline circle" href="/greyhound_racing/admin">Log out</a>
        </div>
        <div class="main-panel">
            <div class="row">
                <label>From:</label>
                <input type="date" />
                <label>To:</label>
                <input type="date" />
                <a class="btn btn-outline">Today</a>
                <a class="btn btn-outline">Yesterday</a>
                <a class="btn btn-outline">Last week</a>
                <a class="btn btn-outline">Last Month</a>
            </div>
            <div class="row page-nation-info">
                Showing 5 results.
            </div>
            <div class="row table-content text-center">
                <table class="main-table">
                    <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td>
                                Account
                            </td>
                            <td>
                                Sale Amount
                            </td>
                            <td>
                                Win Amount
                            </td>
                            <td>
                                Jackpot Win
                            </td>
                            <td>
                                Time
                            </td>
                            <td>
                                Details
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                158
                            </td>
                            <td>
                                user1
                            </td>
                            <td>
                                $10.0
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                2022-07-02 05:22:44
                            </td>
                            <td>
                                <a href="#" target="popup" onclick="window.open('details.php','name','width=1024,height=768')">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                157
                            </td>
                            <td>
                                user1
                            </td>
                            <td>
                                $112.0
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                2022-07-02 01:58:02
                            </td>
                            <td>
                                <a href="#" target="popup" onclick="window.open('details.php','name','width=1024,height=768')">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                156
                            </td>
                            <td>
                                user1
                            </td>
                            <td>
                                $111.0
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                2022-07-02 01:57:23
                            </td>
                            <td>
                                <a href="#" target="popup" onclick="window.open('details.php','name','width=1024,height=768')">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                155
                            </td>
                            <td>
                                user1
                            </td>
                            <td>
                                $10.0
                            </td>
                            <td>
                                $37.7
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                2022-07-02 01:56:59
                            </td>
                            <td>
                                <a href="#" target="popup" onclick="window.open('details.php','name','width=1024,height=768')">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                154
                            </td>
                            <td>
                                user1
                            </td>
                            <td>
                                $11.0
                            </td>
                            <td>
                                $41.47
                            </td>
                            <td>
                                $0.0
                            </td>
                            <td>
                                2022-07-02 01:16:15
                            </td>
                            <td>
                                <a href="#" target="popup" onclick="window.open('details.php','name','width=1024,height=768')">View</a>
                            </td>
                        </tr>
                        <tr style="background-color:aqua;">
                            <td>
                                Page Total
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                $254
                            </td>
                            <td>
                                $79.17
                            </td>
                            <td>
                                $0
                            </td>
                            <td>
                                -
                            </td>
                            <td>
                                -
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>