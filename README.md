# GEOSPOT2

Es una aplicación crítica de Spot que optiene el precio agregado (promedio, mínimo y máximo) por
m2 un código postal de la alcaldía Gustavo A. Madero utilizando datos del Gobierno de la Ciudad de
México, los cuales puedes descargar aquí: https://sig.cdmx.gob.mx/datos/#d_datos_cat,

## Installation
Use los comandos de [php artisan](https://laravel.com/docs/9.x/migrations#main-content) para realizar las migraciones.

```bash
php artisan migrate:fresh --seed
```

## Usage

Llamar GET /price-m2/zip-codes/{zip_code}/aggregate/{max|min|avg}?construction_type={1-7}

```php
Donde construction_type es “uso_construccion” en la base de datos y los valores pueden ser:
1) Áreas verdes
2) Centro de barrio
3) Equipamiento
4) Habitacional
5) Habitacional y comercial
6) Industrial
7) Sin Zonificación


Brinda dos resultados:
● price_unit: Uno basado en la “superficie_terreno” / “valor_suelo” - “subsidio”.
● price_unit_construction: Otro basado en la “superficie_construccion” / “valor_suelo” -
“subsidio”.


Donde
● type: tipo de operación agregada como promedio, mínimo y máximo.
● price_unit: es el precio unitario.
● price_unit_construction: es el precio unitario contemplando terreno de construcción.
● elements: valores sobre los que se realizó la operación.
```

[MIT](https://choosealicense.com/licenses/mit/)