<?php

namespace GraphAware\Neo4j\GraphUnit\Tests\Integration;

use GraphAware\NeoClient\Formatter\Tests\Integration\IntegrationBaseTest;

class ResultIntegrationTest extends IntegrationBaseTest
{
    public function setUp()
    {
        $this->emptyDatabase();
    }

    /**
     * @group result
     */
    public function testSingleResult()
    {
        $q = 'CREATE (n:User {name:"Michael"})';
        $this->conn->sendCypherQuery($q);

        $query = 'MATCH (n:User) WITH n LIMIT 1 RETURN n';
        $result = $this->conn->sendCypherQuery($query)->getSingleResult();

        $this->assertCount(1, $result->get('n'));
        $this->assertInstanceOf('Graphaware\NeoClient\Formatter\Graph\Node', $result->get('n', true));
    }

    /**
     * @group result
     */
    public function testResultWithRelationships()
    {
        $g = '(m:User {name:"Michael"})-[:FOLLOWS]->(:User {name:"Vince"}),
        (m)-[:FOLLOWS]->(:User {name:"Luanne"}),
        (m)-[:FOLLOWS]->(:User {name:"Adam"})';
        $this->prepareDatabase($g);

        $q = 'MATCH (m:User {name:"Michael"}) WITH m LIMIT 1
        OPTIONAL MATCH (m)-[r:FOLLOWS]->(other)
        RETURN m, r, other';

        $result = $this->conn->sendCypherQuery($q)->getSingleResult();

        $this->assertCount(1, $result->get('m'));
        $this->assertCount(3, $result->get('other'));
    }
}