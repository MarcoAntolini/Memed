# Todo list

## Bug

- [ ] elimina tutte si disabilita in mobile ma non in desktop
- [ ] window.onload overrida se presente in altri file
- [ ] il nuovo post deve uscire per primo
- [ ] niente notifiche se ti commenti da solo
- [ ] fixare preview dell'immagine profilo se è default

## Refactor

- [ ] controllare variabili con iniziali maiuscole
- [ ] controllare variabili, id, name, etc

## Database

- [x] sistemare db: nomi
- [x] sistemare db: id utente
- [ ] sistemare db: id auto_increment
- [x] sistemare db: Read diventa boolean
- [ ] riempire il database con dati veri (soprattutto le date, per controllare l'ordine dei post)

## Php

- [ ] namespace modules con dentro namespace database
- [ ] aggiungere il return type alle funzioni getter
- [ ] aggiungere il tipo ai parametri delle funzioni
- [ ] sistemare database.php (variabili, ordine funzioni e funzioni non usate)
- [ ] aggiustare i return di database.php
- [ ] rimuovere commenti da database.php
- [x] $ddd in functions.php ?
- [ ] sistemare functions.php
- [ ] $templateParams["Username"] diventa $templateParams["LoggedUsername"]
- [ ] sistemare file php (api, checkSesion, etc)

## Javascript

- [ ] sistemare file js
- [ ] rimuovere import jquery

## Css

- [ ] bordo dell'immagine profilo (box-shadow?)
- [ ] css dell'header del login
- [ ] css dell'anteprima del post
- [ ] css del modifica post e modifica profilo
- [ ] css di cerca
- [ ] css generale

## New features

- [ ] alert se pubblico post, modifico profilo o post, cancello post o commento, e se mi registro o faccio login
- [ ] popup in login e register per i requisiti
- [ ] cancellazione commenti
- [ ] reazione media nel profilo
- [ ] categorie nell'anteprima e nel post
- [ ] la notifica del commento ti porta al tuo post
- [ ] le notifche si aggiornano in tempo reale senza refresh
- [ ] bootstrap toast per le notifiche?
- [ ] in esplora si vede il filtro attivo
- [ ] aumentare dimensione massima immagine profilo uploadabile
- [ ] cropperjs per resizare l'immagine profilo a quadrato quando viene pubblicata (anche per i post?)
- [ ] usare floating label e hamburger menu

## Tests

- [ ] controllare input type (<https://www.youtube.com/watch?v=nnZS761ngXE&list=LL&index=1>)
- [ ] validare con w3c validator (<https://validator.w3.org/#validate_by_input>) e achecker (<https://achecker.achecks.ca/checker/index.php>)

## Extra

- [ ] deploy sito e database online
- [ ] .htaccess
