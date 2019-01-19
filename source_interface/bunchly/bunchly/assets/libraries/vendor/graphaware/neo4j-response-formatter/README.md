## Neo4j Response Formatter Service for NeoClient

Advanced formatting based on the Neo4j Rest API Http Response format.

### Features

* Response object bootstrapped by a `PSR-7` Http Message
* In-memory graph representation with nodes and relationships objects
* Table format
* Smart getter

### Usage

The current usage in NeoClient is optional for avoiding backwards incompatible changes, this will become the default formatting
service in NeoClient v4.

Enabling the GraphAware's formatting service:

```php
$client = ClientBuilder::create()
	->addDefaultLocalConnection()
	->setAutoFormatResponse(true)
	->enableNewFormattingService()
	->build();
```

From now, all the responses you will receive will be instances of `GraphAware\NeoClient\Formatter\Response`.

#### Getting results

```php
$response = $client->sendCypherQuery('MATCH (n) OPTIONAL MATCH (n)-[r]-() RETURN n,r');
// here we only expect one result
$result = $response->getResult();

// The result object holds nodes, relationships and table format

$nodes = $result->getNodes();
$relationships = $result->getRelationships();

// If you expect multiple results, like for preparedTransactions

$results = $response->getResults();

// Using the table

$table = $result->getTable();
$rows = $table->getRows();
print_r($rows);

```

More doc to come...

--- 

License MIT

---