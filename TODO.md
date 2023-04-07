# Todo list

## Bug

- [x] elimina tutte si disabilita in mobile ma non in desktop
- [x] window.onload overrida se presente in altri file (provare con window.addEventListener("load", function() { ... }) e testare con dei console.log oppure mettendo gli script in fondo al body)
- [x] niente notifiche se ti commenti da solo
- [x] fixare preview dell'immagine profilo se è default
- [x] i post nella home sono sbagliati (mostra i miei anzi che dei seguiti)
- [x] foto profilo follower e seguiti non si vede
- [ ] il nuovo post deve uscire per primo
- [ ] username già esistente se ti registri con un username nuovo

## Improvements

- [ ] il redirect al post funziona ma scrolla giù solo se sei già in quella pagina
- [ ] se submitti vuoto il controllo deve essere dal js e fare prevent default
- [ ] se segui o smetti deve aggiornarsi il pezzo tramite js e non l'intera pagina tramite php (come fa già nella search)

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

- [ ] usare calc() per le altezze
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
- [ ] reazione media nel profilo (deve essere castata a int e se non esiste non deve essere 0)
- [ ] categorie nell'anteprima e nel post
- [x] la notifica del commento ti porta al tuo post
- [ ] le notifche si aggiornano in tempo reale senza refresh (
  setInterval(
  axios.get("notificationApi.php").then(Response => {
  const notification = generatenotification(Response.data)
  const main = document.getElementById("notification-section")
  if (main && notification) main.innerHTML = notification
  }),
  10000
  )
)
- [ ] bootstrap toast per le notifiche?
- [ ] in esplora si vede il filtro attivo
- [x] aumentare dimensione massima immagine profilo uploadabile
- [ ] cropperjs per resizare l'immagine profilo a quadrato quando viene pubblicata (anche per i post?)
- [ ] usare floating label e hamburger menu

## Tests

- [ ] controllare input type (<https://www.youtube.com/watch?v=nnZS761ngXE&list=LL&index=1>)
- [ ] validare con w3c validator (<https://validator.w3.org/#validate_by_input>) e achecker (<https://achecker.achecks.ca/checker/index.php>)

## Extra

- [ ] deploy sito e database online
- [ ] .htaccess
