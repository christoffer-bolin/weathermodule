<article class="article" style="
    text-align:center;
    min-height:300px;">
    <h1>Väderprognoser</h1>
    <p>Skriv in en ip eller koordinater för att se en väderprognos för platsen.</p>
    <form method="GET" action="weather/checkWeather">
        <input name="location" type="text"><br>
        <label><input type="radio" name="type" value="prognos" checked>Prognos</label><br>
        <label><input type="radio" name="type" value="history">Historik</label><br><br>
        <input type="submit" value="Skicka">
    </form>

    <h3>Validera fast med resultat i JSON-format</h3>

    <form method="GET" action="weatherapi/checkWeatherRest">
        <input name="location" type="text"><br>
        <label><input type="radio" name="type" value="prognosAPI" checked>Prognos</label><br>
        <label><input type="radio" name="type" value="historyAPI">Historik</label><br><br>
        <input type="submit" value="Validera JSON">
    </form>

    <h3>Väderprognos och historik, hur funkar det?</h3>
    <p class="saucetext">På denna sida har ni möjlighet att se historiskt väder eller en prognos för kommande väder genom olika IP-adresser eller koordinater. Resultatet visas antingen som 'vanlig' info eller i JSON-format.
    När ni väljer att få resultat i JSON-format så anropas ett API, och det går att utläsa i url:en efter er sökning. Ni kan också anropa det direkt via url:en, då används följande struktur:
    htdocs/weatherapi/checkWeatherRest?location=<b>LATITUDE</b>%2C<b>LONGITUDE</b>&type=prognosAPI. För in era koordinater vid de utmäkrerade latitude och longitude.<br><br>
    Ovan exempel visar en prognos för väder, önskar ni se historik används följande exempelstruktur: htdocs/weatherapi/checkWeatherRest?location=<b>LATITUDE</b>%2C<b>LONGITUDE</b>&type=prognosAPI.</p>


</article>
