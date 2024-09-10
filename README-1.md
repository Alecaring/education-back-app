___
# Laravel API Project

## Introduzione

Comprende i passaggi per installare il progetto, collegarlo a un database, creare e gestire migrazioni e seeders, e configurare le API.

___

## Sommario

- [Installazione del Progetto](#installazione-del-progetto)
- [Collegare il Database](#collegare-il-database)
- [Creazione e Modifica del Database](#creazione-e-modifica-del-database)
- [Creazione delle API](#creazione-delle-api)
- [Abilitare CORS](#abilitare-cors)
- [Paginazione](#paginazione)
- [Ottimizzazione del Database](#ottimizzazione-del-database)
- [Comandi SQL più Utilizzati e Best Practices](#comandi-sql-piu-utilizzati-e-best-practices)
- [Conclusione](#conclusione)

---

## Installazione del Progetto

### 1. Installazione di Composer

Composer è uno strumento per la gestione delle dipendenze in PHP. Per installare tutte le dipendenze del progetto, esegui il seguente comando:

```bash
composer i || composer install
```
### 2. Installazione di npm

npm è il gestore di pacchetti per Node.js. Per installare tutte le dipendenze JavaScript necessarie per il progetto, esegui il seguente comando:


```bash
npm i || npm install
```
### 3. Copia del File .env

Il file `.env` contiene tutte le variabili di ambiente necessarie per configurare l'applicazione. Copia il file di esempio `.env.example` e rinominalo in `.env`:


```bash
cp .env.example .env
```
### 4. Generazione della Chiave dell'Applicazione

Laravel richiede una chiave univoca per cifrare i dati sensibili. Genera questa chiave eseguendo il seguente comando:


```bash
php artisan key:generate
```
### 5. Avvio dei Server

Per avviare l'applicazione, devi eseguire due server:

-Terminale 1: Avvia il server PHP per eseguire Laravel:

```bash
php artisan serve
```
-Terminale 2: Avvia il server npm per eseguire le risorse frontend:

```bash
npm run dev
```

### 6. Accedere all'Applicazione

Apri il link fornito dal comando `php artisan serve` nel tuo browser per visualizzare l'applicazione.
___
## Collegare il Database

### 1. Creare il Model

Il modello è una rappresentazione di una tabella del database. Creare un modello corrispondente alla tabella permette di interagire con essa usando Eloquent ORM. Esegui il seguente comando per creare un modello:

```bash
php artisan make:model Nome
```
### 2. Creare la View

Le view sono i file che contengono il codice HTML e Blade per visualizzare i dati.

- In `resources/views`, crea il file `nome-pagina.blade.php`.
- Aggiungi il layout e la sezione content:


```php
@extends('layouts.app')

@section('content')
<!-- Contenuto specifico della pagina -->
@endsection
```
### 3. Creare il Controller

Il controller gestisce le richieste HTTP e restituisce le risposte appropriate. Creare un controller permette di organizzare la logica dell'applicazione. Esegui il seguente comando per creare un controller:


```bash
php artisan make:controller NomeController
```
### 4. Aggiungere la Logica nel Controller

Modifica il controller per aggiungere la funzione `index()` che recupera i dati dal modello e li passa alla view.


```php
// app/Http/Controllers/NomeController.php

namespace App\Http\Controllers;

use App\Models\Nome;
use Illuminate\Http\Request;

class NomeController extends Controller
{
    public function index()
    {
        // Recupera tutti i dati dal modello
        $nomes = Nome::all();
        // Passa i dati alla view
        return view('nome-pagina', compact('nomes'));
    }
}
```
### 5. Aggiungere la Rotta

Le rotte definiscono gli URL dell'applicazione e associano ogni URL a un metodo del controller. Aggiungi la rotta nel file `routes/web.php` per collegare l'URL alla funzione `index` del controller:


```php
use App\Http\Controllers\NomeController;

Route::get('/', [NomeController::class, 'index'])->name('home.index');
```
___
## Creazione e Modifica del Database

### 1. Creare la Migrazione

Le migrazioni sono una forma di versionamento del database. Creano e modificano le tabelle del database. Esegui il seguente comando per creare una migrazione:


```bash
php artisan make:migration create_nome_tabella_table
```
### 2. Modificare la Migrazione

Modifica il file di migrazione generato in `database/migrations` per definire la struttura della tabella:


```php
public function up()
{
    Schema::create('nome_tabella', function (Blueprint $table) {
        $table->id();
        $table->string('colonna1');
        $table->text('colonna2');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('nome_tabella');
}
```
### 3. Eseguire la Migrazione

Esegui la migrazione per creare la tabella nel database:


```bash
php artisan migrate
```
### 4. Creare il Seeder

I seeders permettono di popolare il database con dati di esempio. Esegui il seguente comando per creare un seeder:

```bash
php artisan make:seeder NomeTabellaSeeder
```
### 5. Popolare i Dati nel Seeder

Modifica il file seeder in `database/seeders` per aggiungere i dati di esempio:

```php
use Illuminate\Database\Seeder;
use App\Models\Nome;
use Faker\Factory as Faker;

class NomeTabellaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('it_IT');

        for ($i = 0; $i < 10; $i++) {
            Nome::create([
                'colonna1' => $faker->word,
                'colonna2' => $faker->paragraph,
            ]);
        }
    }
}
```
### 6. Eseguire il Seeder

Esegui il seeder per popolare il database:

```bash
php artisan db:seed --class=NomeTabellaSeeder
```
___
## Creazione Resource

### 1. Creare il Controller --resource

Il controller --resource gestisce le richieste HTTP. Esegui il seguente comando per creare un controller `--resource`:

```bash
php artisan make:controller ComicController --resource
```
### 2. Accedere alle liste

```bash
php artisan route:list
```
___
## Creazione delle API

### 1. Creare il Controller API

Il controller API gestisce le richieste HTTP per le API RESTful. Esegui il seguente comando per creare un controller API:

```bash
php artisan make:controller API/NomeController --api
```
### 2. Aggiungere i Metodi CRUD nel Controller API

Modifica il controller per aggiungere i metodi CRUD (Create, Read, Update, Delete):

```php
// app/Http/Controllers/API/NomeController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Nome;
use Illuminate\Http\Request;

class NomeController extends Controller
{
    public function index()
    {
        return Nome::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'colonna1' => 'required|string|max:255',
            'colonna2' => 'required|string',
        ]);

        $nome = Nome::create($request->all());

        return response()->json($nome, 201);
    }

    public function show($id)
    {
        $nome = Nome::find($id);

        if (is_null($nome)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($nome);
    }

    public function update(Request $request, $id)
    {
        $nome = Nome::find($id);

        if (is_null($nome)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $request->validate([
            'colonna1' => 'sometimes|required|string|max:255',
            'colonna2' => 'sometimes|required|string',
        ]);

        $nome->update($request->all());

        return response()->json($nome);
    }

    public function destroy($id)
    {
        $nome = Nome::find($id);

        if (is_null($nome)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $nome->delete();

        return response()->json(null, 204);
    }
}
```
### 3. Definire le Rotte API

Le rotte API collegano gli URL ai metodi del controller API. Aggiungi le rotte API nel file `routes/api.php`:

```php
use App\Http\Controllers\API\NomeController;

Route::apiResource('nomi', NomeController::class);
```
___
## Abilitare CORS

CORS (Cross-Origin Resource Sharing) permette di controllare quali risorse possono essere richieste da domini esterni.

### 1. Installare il Pacchetto CORS

Esegui il seguente comando per installare il pacchetto CORS:

```bash
composer require fruitcake/laravel-cors
```
### 2. Pubblicare la Configurazione

Pubblica il file di configurazione CORS eseguendo il seguente comando:

```bash
php artisan vendor:publish --provider="Fruitcake\Cors\CorsServiceProvider"
```
### 3. Configurare CORS

Modifica il file ´config/cors.php` per abilitare CORS per le rotte API:

```php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
```

___
## Paginazione

La paginazione permette di suddividere i risultati di una query in pagine. Laravel offre metodi semplici per implementare la paginazione.

### 1. Implementare la Paginazione

Nel controller, usa il metodo `paginate` invece di `get`:

```php
public function index()
{
    $nomes = Nome::paginate(10); // 10 risultati per pagina
    return view('nome-pagina', compact('nomes'));
}
```
### 2. Aggiungere i Link di Paginazione nella View

Nella view, aggiungi i link di paginazione:

```php
{{ $nomes->links() }}
```
Puoi personalizzare lo stile della paginazione usando Bootstrap:
```php
{{ $nomes->links('pagination::bootstrap-4') }}
```
___
## Ottimizzazione del Database

### 1. Utilizzare Indici

Gli indici possono migliorare significativamente le prestazioni delle query. Aggiungi indici nelle colonne che vengono frequentemente utilizzate nelle clausole WHERE, JOIN e ORDER BY.

```php
Schema::table('nome_tabella', function (Blueprint $table) {
    $table->index('colonna1');
});
```

### 2. Eager Loading

L'eager loading riduce il numero di query eseguite quando si recuperano relazioni. Usa il metodo with per specificare le relazioni da caricare in anticipo.

```php
$nomes = Nome::with('relazione')->get();
```

### 3. Cache delle Query

Usa la cache per memorizzare i risultati delle query che non cambiano frequentemente.

```php
$nomes = Cache::remember('nomes', 60, function () {
    return Nome::all();
});
```
___
## Comandi SQL più Utilizzati e Best Practices

### 1. Comandi SQL più Utilizzati

**Selezionare Dati**

Per selezionare tutti i dati da una tabella:

```SQL
SELECT * FROM nome_tabella;
```
Per selezionare dati con una condizione specifica:


```SQL
SELECT * FROM nome_tabella WHERE colonna = 'valore';
```

**Inserire Dati**

Per inserire nuovi dati in una tabella:

```SQL
INSERT INTO nome_tabella (colonna1, colonna2) VALUES ('valore1', 'valore2');
```
**Aggiornare Dati**

Per aggiornare dati esistenti in una tabella:

```SQL
UPDATE nome_tabella SET colonna1 = 'nuovo_valore' WHERE colonna2 = 'condizione';
```

**Eliminare Dati**

Per eliminare dati da una tabella:

```SQL
DELETE FROM nome_tabella WHERE colonna = 'condizione';
```
## 2. Best Practices

### Normalizzazione del Database
- **1NF (Prima Forma Normale):** Assicurati che ogni colonna contenga solo valori atomici (indivisibili).
- **2NF (Seconda Forma Normale):** Elimina la ridondanza dei dati assicurandoti che ogni attributo non chiave dipenda dall'intera chiave primaria.
- **3NF (Terza Forma Normale):** Elimina la dipendenza transitiva degli attributi non chiave.

### Indici

Utilizza indici per migliorare le prestazioni delle query sui campi frequentemente utilizzati nelle clausole WHERE, JOIN e ORDER BY. Tuttavia, evita di creare troppi indici, poiché possono rallentare le operazioni di inserimento, aggiornamento ed eliminazione.

```SQL
CREATE INDEX nome_indice ON nome_tabella (colonna);
```
### Backup Regolari

Esegui backup regolari del database per prevenire la perdita di dati. Automatica il processo di backup e verifica regolarmente l'integrità dei backup.

**Sicurezza**
- **Usa Prepared Statements:** Previeni le iniezioni SQL utilizzando query preparate.

- **Controlla i Permessi:** Assegna i permessi minimi necessari agli utenti del database.

- **Cripta Dati Sensibili:** Utilizza la crittografia per proteggere i dati sensibili memorizzati nel database.


### Monitoraggio e Ottimizzazione

Monitora le prestazioni del database utilizzando strumenti di monitoraggio e ottimizza le query lente. Utilizza strumenti come EXPLAIN per analizzare e ottimizzare le query.

```SQL
EXPLAIN SELECT * FROM nome_tabella WHERE colonna = 'valore';
```







___



## Conclusione

Questa guida fornisce una panoramica dettagliata su come configurare un progetto Laravel, collegarlo a un database, creare migrazioni, seeders e API, e ottimizzare le prestazioni del database. Segui questi passaggi per creare un'applicazione robusta e scalabile. Se hai ulteriori domande o necessiti di chiarimenti, non esitare a chiedere.

