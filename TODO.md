# Todo list

## Bug

- [x] elimina tutte si disabilita in mobile ma non in desktop
- [x] window.onload overrida se presente in altri file (provare con window.addEventListener("load", function() { ... }) e testare con dei console.log oppure mettendo gli script in fondo al body)
- [x] niente notifiche se ti commenti da solo
- [x] fixare preview dell'immagine profilo se è default
- [x] i post nella home sono sbagliati (mostra i miei anzi che dei seguiti)
- [x] foto profilo follower e seguiti non si vede
- [x] username già esistente se ti registri con un username nuovo
- [x] la foto profilo non si aggiorna se la foto è fuori dalla cartella upload
- [x] anteprima del post non funziona
- [x] i controlli quando pubblichi un post non funzionano bene
- [x] le reazioni non si aggiornano bene
- [x] errore da console per il setTimeout delle notifiche
- [x] le notifiche da mobile non si vedono
- [x] i bottoni delle notifiche non si aggiornano senza il refresh
- [ ] il nuovo post deve uscire per primo

## Improvements

- [x] in esplora si vede il filtro attivo
- [ ] il redirect al post funziona ma scrolla giù solo se sei già in quella pagina
- [ ] se submitti vuoto il controllo deve essere dal js e fare prevent default
- [ ] se segui o smetti deve aggiornarsi il pezzo tramite js e non l'intera pagina tramite php (come fa già nella search)
- [ ] alert se pubblico o modifico post, cancello post o commento
- [ ] bootstrap utility in login e register per i requisiti

## Refactor

- [x] controllare variabili con iniziali maiuscole
- [ ] controllare variabili, id, name, etc

## Database

- [x] sistemare db: nomi
- [x] sistemare db: id utente
- [x] sistemare db: id auto_increment
- [ ] riempire il database con dati veri (soprattutto le date, per controllare l'ordine dei post)
- [ ] non passare l'id alle colonne autoincrementate in database_populate
- [ ] scrivere bene le notifiche dei commenti

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
- [x] rinominare file php
- [x] usare le funzioni nel modo giusto (es. se tornano array e non bool)
- [x] insertReactionOfPost(), deletePostById(), getPostReactionByPostIdAndUsername() todo
- [x] aggiungere postId al link della notifica
- [x] rimuovere i [0] dalle function call
- [ ] sistemare funzioni di login/register/logout

## Javascript

- [x] sistemare file js
- [x] rimuovere import jquery

## Css

- [x] usare calc() per le altezze
- [x] bordo dell'immagine profilo (box-shadow?)
- [x] css dei toast
- [ ] css dell'header del login
- [ ] css dell'anteprima del post
- [ ] css del modifica post e modifica profilo
- [ ] css di cerca
- [ ] css generale
- [ ] usare floating label e hamburger menu

## New features

- [ ] cancellazione commenti
- [ ] reazione media nel profilo (deve essere castata a int e se non esiste non deve essere 0)
- [ ] categorie nell'anteprima e nel post
- [ ] cropperjs per resizare l'immagine profilo a quadrato quando viene pubblicata (anche per i post?)
- [x] offcanvas per le notifiche desktop
- [x] aumentare dimensione massima immagine profilo uploadabile
- [x] la notifica del commento ti porta al tuo post
- [x] le notifche si aggiornano in tempo reale senza refresh
- [x] bootstrap toast per le notifiche?
- [x] alert se modifico profilo (redirect al profilo)
- [x] alert se mi registro o faccio login

## Tests

- [ ] controllare input type (<https://www.youtube.com/watch?v=nnZS761ngXE&list=LL&index=1>)
- [ ] validare con w3c validator (<https://validator.w3.org/#validate_by_input>) e achecker (<https://achecker.achecks.ca/checker/index.php>)

## Extra

- [ ] deploy sito e database online
- [ ] .htaccess
