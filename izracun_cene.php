<html>
<head>
    
    <title>Izračun končne cene izdelka</title>
</head>
<body>
    <h2>Izračun končne cene izdelka</h2>

 
    <form method="post">
        <label for="cena_izdelka">Cena izdelka (v EUR): </label>
        <input type="number" id="cena_izdelka" name="cena_izdelka" step="0.01" required>
        <br><br>
        <label for="znizanje_odstotek">Odstotek znižanja: </label>
        <input type="number" id="znizanje_odstotek" name="znizanje_odstotek" step="0.1" required>
        <br><br>
        <input type="submit" value="Izračunaj končno ceno">
    </form>

    <?php
    // Preveri, če je obrazec oddan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pridobi vnesene podatke
        $cena_izdelka = $_POST['cena_izdelka'];
        $znizanje_odstotek = $_POST['znizanje_odstotek'];

        // Preveri, če je odstotek popusta znotraj sprejemljivih vrednosti (0% - 100%)
        if ($znizanje_odstotek < 0 || $znizanje_odstotek > 100) {
            echo "<p style='color: red;'>Odstotek popusta mora biti med 0% in 100%!</p>";
        } else {
            // Izračun znižanja in končne cene
            $znizanje = ($znizanje_odstotek / 100) * $cena_izdelka;
            $koncna_cena = $cena_izdelka - $znizanje;

            // Dodaj sporočila za posebne primere (0% ali 100% popust)
            if ($znizanje_odstotek == 0) {
                echo "<p>Izdelek ni znižan. Končna cena je enaka začetni ceni: " . number_format($koncna_cena, 2) . " EUR.</p>";
            } elseif ($znizanje_odstotek == 100) {
                echo "<p>Izdelek je brezplačen! Končna cena je: 0.00 EUR.</p>";
            } else {
                echo "<p>Končna cena izdelka po $znizanje_odstotek% znižanju je: " . number_format($koncna_cena, 2) . " EUR</p>";
            }
        }
    }
    ?>
</body>
</html>
