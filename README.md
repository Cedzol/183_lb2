# LB2 Applikation
Diese Applikation ist bewusst unsicher programmiert und sollte nie in produktiven Umgebungen zum Einsatz kommen. Ziel der Applikation ist es, Lernende für mögliche Schwachstellen in Applikationen zu sensibilisieren, diese anzuleiten, wie die Schwachstellen aufgespürt und geschlossen werden können.

Die Applikation wird im Rahmen der LB2 im [Modul 183](https://gitlab.com/ch-tbz-it/Stud/m183/m183) durch die Lernenden bearbeitet.

## Hinweise zur Installation
Bevor mit `docker compose up` die Applikation gestartet wird, muss der Source-Pfad für's Volume an Ihre Umgebung angepasst werden (dass die todo-list-Applikation auch korrekt in den Container rein gelinkt wird). Wichtig: die DB wird nicht automatisch erzeugt. Verbinden Sie sich dafür mit einem SQL-Client Ihrer Wahl auf den Datenbankcontainer (localhost port 3306) und verwenden Sie [m183_lb2.sql](docker/m183_lb2.sql), um die Datenbank / Datenstruktur zu erzeugen. Beachten Sie, dass die Datenbank nach einem "neu bauen" des Containers wieder weg sein wird und Sie diese nochmals anlegen müssten.

### Datenbank setup

Credentials:

localhost:3306

root

Some.Real.Secr3t

Das Datenbank init sql wird beim erstellen des DB containers ausgeführt.

### Composer

Damit das Projekt läuft muss composer verwendet werden.
Als erstes muss dieser Heruntergeladen/installiert werden. https://getcomposer.org/download/
Es gibt einen Windows installer und für Mac OS kann mit brew gearbeitet werden.

Danach muss man im Projekt im Verzeichnis todo-list `composer install` ausführen. Danach sollte das Projekt laufen.

Die Seite läuft auf https://localhost:8443/