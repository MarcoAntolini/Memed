# Todo list

## Bug

- [x] elimina tutte si disabilita in mobile ma non in desktop
- [ ] window.onload overrida se presente in altri file (provare con window.addEventListener("load", function() { ... }) e testare con dei console.log oppure mettendo gli script in fondo al body)
- [ ] il nuovo post deve uscire per primo
- [x] niente notifiche se ti commenti da solo
- [ ] fixare preview dell'immagine profilo se è default
- [ ] se submitti vuoto il controllo deve essere dal js e fare prevent default

## Refactor

- [ ] controllare variabili con iniziali maiuscole
- [ ] controllare variabili, id, name, etc

## Database

- [x] sistemare db: nomi
- [x] sistemare db: id utente
- [x] sistemare db: id auto_increment
- [x] sistemare db: Read diventa boolean
- [ ] riempire il database con dati veri (soprattutto le date, per controllare l'ordine dei post)
- [ ] non passare l'id alle colonne autoincrementate in database_populate

## Php

- [ ] namespace modules con dentro namespace database
- [x] migliorare i return statement
- [x] aggiungere il return type alle funzioni getter
- [x] aggiungere il tipo ai parametri delle funzioni
- [x] sistemare ordine parametri nelle funzioni del database
- [x] (e le rispettive call)
- [x] sistemare database.php (variabili, ordine funzioni e funzioni non usate)
- [x] rimuovere commenti da database.php
- [x] $ddd in functions.php ?
- [x] sistemare functions.php (dividere in login e upload)
- [x] $templateParams["loggedUsername"] diventa $templateParams["LoggedUsername"]
- [x] sistemare file php (api, checkSession, etc)
- [ ] rinominare file php
- [x] usare le funzioni nel modo giusto (es. se tornano array e non bool)
- [x] insertReactionOfPost(), deletePostById(), getPostReactionByPostIdAndUsername() todo
- [ ] aggiungere postId al link della notifica
- [ ] sistemare funzioni di login/register/logout
- [x] rimuovere i [0] dalle function call

## Javascript

- [ ] sistemare file js
- [x] rimuovere import jquery

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
