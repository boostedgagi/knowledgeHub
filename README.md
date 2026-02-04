# Dokumentacija u svrhu zadatka pod nazivom KnowledgeHub u okviru procesa zapošljavanja.

## Opis projekta:
Ovaj projekat je izrađen korišćenjem Laravel framework-a, verzija 12,
uz pomoć PHP programskog jezika, verzija 8.4.

Fokusira se na internu komunikaciju između zaposlenih unutar kompanije, sa ciljem unapređenja timske saradnje.
Platforma omogućava članovima tima da postavljaju pitanja, daju odgovore, glasaju za sadržaj i koriste AI asistenciju.

## Pre instalacije, budite sigurni da imate instalirane sledece zahtevane tehnologije:
- php8.4 
- composer instaliran globalno

## Instalacija
1. `git clone git@github.com:boostedgagi/knowledgeHub.git`
2. `cd /knowledgeHub`
3. Preuzmite `.env` i `compose.yaml` fajlove sa email-a
4. `composer install`
5. `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`
6. `sail build --no-cache`
7. `sail up -d`
8. `mysql -u boostedgagi -p -e "CREATE DATABASE knowledgehub_db;"`
9. `php artisan migrate`
10. `php artisan migrate:fresh --seed`
11. `php artisan serve`

Sve varijable koje se nalaze u `compose.yaml` fajlu ne morate da menjate na bilo kakav način 
jer se povlače iz `.env `fajla, te se tamo vrše promene ukoliko je neki od navedenih portova zauzet i slično.

## Arhitekturalne odluke

Laravel je bio zahtevan od strane samog zadatka,
a Vue sam izabrao jer omogućava brzi razvoj interaktivnog korisničkog interfejsa, 
i on je na frontend strani napravljen
kao samostalna (standalone) aplikacija.

Ovom kombinacijom Laravela i Vue-a razdvojio sam backend i frontend logiku,
što će kasnije samo olakšati održavanje projekta i unapređivanje.

## Zaključak

Zadatak je sam po sebi jako lepo zamišljen, prijalo je raditi na ovakvom projektu iz razloga što su svi zahtevi zadatka
lepo razloženi i smisleni. Obzirom da se prvi put susrećem sa Laravel-om, jedino što bih poboljšao sa više vremena
svakako jeste svoje znanje u istom. :) 





