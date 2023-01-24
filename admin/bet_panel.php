<html>

<head>
    <title>
        Dashboard - GREYHOUND RACING
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bet_panel.css">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <a class="btn btn-solid btn-outline circle">Profile</a>
            <a class="btn btn-solid btn-outline circle">Game Settings</a>
            <a class="btn btn-solid btn-outline circle active" href="/greyhound_racing/admin/bet_panel.php">Bet Panel</a>
            <a class="btn btn-solid btn-outline circle" href="/greyhound_racing/admin/dashboard.php">Game</a>
            <a class="btn btn-solid btn-outline circle" href="/greyhound_racing/admin">Log out</a>
        </div>
    </div>
    <div class="bet-panel">
        <div class="container text-center">
            <div class="bet-item">
                <div class="form-group">
                    <h3>Dog Number:</h3>
                    <input type="number" class="bet_value"/>
                </div>
            </div>
            <div class="bet-item">
                <div class="form-group">
                    <h3>Bet Amount ($):</h3>
                    <input type="number" class="bet_value"/>
                </div>
            </div>
            <div class="bet-item">
                <a class="btn btn-solid btn-outline circle">Place Bet</a>
                <a class="btn btn-solid btn-outline circle">Clear Bets</a>
            </div>
        </div>
    </div>
    <div class="bet-panel">
        <div class="container text-center">
            <div class="bet-item">
                <h1>Placed Bets (Total: 0$)</h1>
            </div>
            <div class="bet-item">
                <h3>Max: $200 Min: $10</h3>
            </div>
            <div class="bet-item">
                <h3>Balance: $423.20</h3>
            </div>
            <div class="bet-item table-body">
                <table class="bert-main-table">
                    <thead>
                        <tr>
                            <td>
                                Dog No
                            </td>
                            <td>
                                Dog Name
                            </td>
                            <td>
                                Amount
                            </td>
                            <td>
                                Multiplier
                            </td>
                            <td>
                                Win
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="bet-item">
                <a class="btn btn-solid btn-outline circle" disabled>START RACE</a>
                <a class="btn btn-solid btn-outline circle" disabled>CONTINUE</a>
            </div>
        </div>
    </div>
</body>

</html>