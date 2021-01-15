Instructiuni de instalare a aplicatiei:

1. Se extrage arhiva in folderul dorit pe serverul web
2. Se editeaza fisierul CONFIG.PHP si se introduc numele de utilizator al bazei de date, parola acestuia si numele bazei de date, astfel:
    $db_user = "numele de utilizator";
    $db_pass = "parola";
    $db_name = "numele bazei de date";

3. Se salveaza si se inchide fisierul CONFIG.PHP

4. Se acceseaza din browser fisierul install.php

5. La apasarea butonului "Instalare", aplicatia va crea in baza de date tabelele necesare si va redirectiona catre pagina de inregistrare si autentificare