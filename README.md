# **Questly** - Request and Reply
*Vprašanja in odgovori - Projekt iz spletnega programiranja*

Na voljo na spletni strani [https://zanozbot.github.io/questly/site/>datoteka<](https://zanozbot.github.io/questly/site/home.html), kjer ima >datoteka< eno izmed naslednjih vrednosti: *home.html, login,html, new.html, question.html, register.html, search.html, user.html*

## Opis
**Questly** je spletna aplikacija, kjer si uporabniki izmenjujejo znanje, informacije, mnenja, itd. preko *vprašanj in odgovorov*. 

Uporabnik lahko zastavi katerokoli vrsto vprašanj, zato **ciljna publika** ni točno definirana. Oziroma povedano drugače, **ciljno publiko** sestavlja vsak, ki bi se želel nekaj novega naučiti ali pa je naletel na težave pri svojem delu in potrebuje pomoč.

Če se želimo povezati s še več uporabniki, moramo aplikacijo zasnovati tako, da bo podprta s strani več naprav. Prikaz spletne strani bo moral biti odziven *(angl. responsive)* kar pomeni, da se bo samodejno prilagodil velikosti naprave.

## Minimalni izvedljiv produkt
+ Spletna stran mora omogočati, da vprašanje postavimo tudi anonimno;
+ Odgovori morajo biti nekako točkovani, bolje točkovani odgovori se morajo prikazati višje;
+ Spraševalec lahko za posamezni odgovor označi ali je ta rešil njegov problem;
+ Vsako vprašanje in odgovor nanj je možno komentirati

## Sitemap
Za organizacijo spletišča smo uporabili hierarhično organizacijo (*docs/SITEMAP.pdf*). Takšna organizacija je bila izbrana
zato, ker so uporabniki zelo dobro seznanjeni s hierarhičnimi diagrami in se bodo z lahkoto pomikali po spletni strani ter
tako hitreje našli kar iščejo. Predlagana organizacija spletišča upošteva oba principa hierarhične organizacije. Hierarhična organizacija spletišča poskrbi tudi za konsistentnost, saj večina današnjih spletnih strani temelji na tej organizaciji, in tako ne zmede nove uporabnike.

## Poročilo o težavah v različnih brskalnikih
Brskalnik Microsoft Edge drugače prikaže mobilno glavo (*angl. header*), vendar ne pokvari izgleda spletne strani.

## Zmogljivosti in posebni gradniki spletne strani
* Na straneh *new.html* in *question.html* lahko poleg navadnega besedila dodajamo povezave in kodo, ki se v predogledu dinamično obarvajo.
![Dinamično polje](https://raw.githubusercontent.com/zanozbot/questly/master/gifs/dynamicfield.gif)
* Validacija vnosa registracijskega polja za geslo na strani odjemalca, ki se nahaja na strani *registration.html*