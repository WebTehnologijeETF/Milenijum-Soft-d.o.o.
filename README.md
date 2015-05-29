# Milenijum-Soft-d.o.o.
Informatičko preduzeće orjentisano prema izradi vlasitith rješenja za mala i srednja preduzeća u oblasti poslovno-informacionih sistema.

Opće napomene:
- jesam koristio JQuery biblioteku (iako je rečeno da se ne smije koristiti), međutim ona nije korištena za rješavanje ijednog od zadataka sa spirala, već sam ja želio vježbati istu nevezano za spirale.

Spirala prva napomene:
- stranica kontakti radi potpuno ispravno na Google Chrome pretraživaču (tj. njeni HTML5 tagovi)
- tabela je iskorištena na podstranici Proizvodi (zaobljeni su rubovi unutrašnjih polja)

Spirala druga napomene:
- kod validacije nisam iskoristio sličicu ili uskličnih sa strane, umjesto toga sam bojio pozadinu polja unosa
- padajući meni je implementiran na polju Proizvodi

Spirala treća napomene:
- servis koji sam koristio je srednja_skola.php
- servis /wt/proizvodi.php je iskorišten na stranici kojoj se može pristupiti preko Proizvodi -> Administracija

Cetvrta spirala napomene:
- promjene su uradjene na cijelom projektu, ali samo u vidu smanjivanja ponavljanja koda koristeći php skriptu header.php (u folderu dijelovi)
- dodatne male promjene su uradjene kao ispravka bug-ova, a dodane su i nove funkcionalnost kako bi zadovoljio spiralu

Peta spirala napomene:
- modul za izmjenu administratora sam realizovao tako što svaki administrator može samo sebe mjenati (nema slisla da nekom drugom password promjeni)
- ograničenje da uvijek postoji bar jedan administrator u sistemu sam realizovao tako što administrator ne može sebe obrisati
- na stranici je postavljen jedan administrator, Username = admin i Password = adminadmin