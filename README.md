<h1>Oddaja naloge z Doctrine ORM</h1>

Da sem lahko pravilno ustvaril tabelo uporabnikov, sem vašo .sql datoteko najprej nekoliko popravil. 
V originalni datoteki sta bili dve polji 'id'. Enega sem izbrisal. Datoteko sem nato preimenoval v 'dump.sql'.

<h3>Uporaba</h3>

<strong>Baza</strong>

1. Zaženemo MySql server.
2. Kreiramo MySql bazo in jo poimenujemo 'mojabaza'.
3. Na bazi dodamo uporabnika 'rok' z geslom '123' (Ker so taki podatki hardcoded v PHP kodi.).
4. Na bazi 'mojabaza' poženemo skripto 'dump.sql'.

<strong>Spletni strežnik</strong>

5. Ustvarimo mapo, do katere Apache strežnik dostopa preko naslova 'test.local'.
6. Vsebino tega repositorija kopiramo v to mapo.
7. Do delujoče PHP skripte dostopamo v brskalniku na naslovu 'test.local'.

<h3>Opombe</h3>

V tem commitu so opravljene stvari, ki so naštete pod glavne naloge in prva dodatna naloga (Doctrine ORM).
Dodan je tudi form validation in errorji.
V naslednjem commitom bom dodal še login formo z passwordom.
