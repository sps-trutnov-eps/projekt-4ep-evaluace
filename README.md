# Projekt třídy 4.EP, systém pro studentskou evaluaci výuky

## Deployment

1. Obsah složky ```www/``` zkopírujte do složky na vašem serveru.
2. Vedle složky s obsahem ```www/``` umístěte soubor ```config.php```.
3. Do souboru ```config.php``` doplňte:
	- ```const dbhost = "adresa_sql_serveru";```
	- ```const dbuser = "uzivatelske_jmeno";```
	- ```const dbpass = "uzivatelske_heslo";```
	- ```const dbname = "jmeno_sql_databaze";```
4. Na SQL serveru vytvořte novou databázi pojmenovanou ve shodě s bodem 3.
5. Do nově vytvořené databáze importujte soubor ```databaze/eval_db.sql```.
6. Do tabulky ```eval_ucitele``` ručně doplňte e-mailové adresy učitelů.
