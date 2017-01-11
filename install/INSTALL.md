# Postopek namestitve Questly

Na oblačni storitvi [Cloud9](https://c9.io/) ustvarimo nov projekt, izberemo `PHP` in v terminal prepišemo naslednje ukaze:
```
rm README.md php.ini hello-world.php
sudo composer self-update
```

Kloniramo git repozitorij in z naslednjim ukazom spremenimo, da se bodo datoteke stregle iz `public` direktorija:
```
sudo nano /etc/apache2/sites-enabled/001-cloud9.conf
```

```
// Change this line
DocumentRoot /home/ubuntu/workspace

// To following
DocumentRoot /home/ubuntu/workspace/questly/laravel/public
```

Preden zaženemo projekt moramo nastaviti MySQL bazo. To naredimo z naslednjimi ukazi:
```
mysql-ctl cli
use c9;
select @@hostname;
exit
```

V naslednjem koraku zaženemo zagonsko skripto za vzpostavitev baze:
```
mysql-ctl cli
mysql> source PATH_TO_SQL_FILE.sql
```

Če se želimo prepričati, da je vse tako kot mora biti:
```
mysql> show tables;
```

Za konec nam ostane še, da v Laravel-ovi konfiguracijski datoteki `.env` spremenimo podatke o kreirani bazi:
```
DB_HOST=localhost
DB_DATABASE=questly
DB_USERNAME=USERNAME
DB_PASSWORD=
````

Za uporabo migracij moramo zgornje nastavitve nastaviti tudi v `config\database.php` v tabeli `connections` pod ključem `mysql`.

Z ukazom:
```
PATH=~/workspace/questly/laravel/vendor/bin:$PATH
```
lahko `phpunit` zaženenemo kjerkoli v terminalu. 