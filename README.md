# Istruzioni per l'uso del progetto

Per utilizzare il progetto è necessario attivate tramite **Xampp** il server Apache e il server MySQL.

Per creare il database dirigersi al link `http://localhost/phpmyadmin`, cliccare su *'nuovo'* e successivamente su *'importa'* per importare i file `create_database.sql` (per creare il database) e `init_database.sql` (per inizializzare il database con alcuni dati di esempio). Entrambi i file si trovano all'interno della cartella `modules\database` del progetto.
*(Le email e le password degli utenti di prova sono del formato tipo `userX@gmail.com` e `userX` rispettivamente, con X che va da 1 a 5. Altrimenti è naturalmente possibile creare nuovi utenti, post, ecc...)*

Per abilitare l'upload dei file aprire il client di **Xampp**, cliccare su *'Explorer'* per aprire la cartella di Xampp, aprire la cartella *'php'* e modificare il file `php.ini` cercando la riga `;extension=gd` e togliendo il punto e virgola iniziale per abilitare l'estensione. Successivamente salvare il file e riavviare il server Apache per attuare le modifiche.

Infine per aprire il progetto basta aprire il browser e digitare `http://localhost/Memed/modules/` per accedere alla pagina principale.
