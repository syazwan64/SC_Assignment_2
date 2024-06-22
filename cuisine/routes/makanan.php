<?php
use Slim\Http\Request;
use Slim\Http\Response;

require 'vendor/autoload.php';

$app = new Slim\App();

class db {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'webtechw9';

    public function connect() {
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}

$app->get('/', function () {
    return 'This is the food page';
});

$app->get('/collectionskuih', function (Request $request, Response $response) {
    try {
        $db = new db();
        $connection = $db->connect();
        $statement = $connection->query('SELECT * FROM collectionskuih');
        $makanan = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Check the category parameter
        $category = $request->getQueryParam('category');

        if ($category === 'All Malaysian Foods') {
            return $response->withJson($makanan);
        } elseif ($category !== 'All Malaysian Foods') {
            $kategori = $category;
            $matchingCollection = findCollectionByKategori($makanan, $kategori);
            if ($matchingCollection) {
                return $response->withJson($matchingCollection);
            } else {
                return $response->withJson(['error' => 'No collection with such category found'], 404);
            }
        } else {
            return $response->withJson(['error' => 'Invalid category parameter'], 400);
        }
    } catch (PDOException $e) {
        $data = array("error" => "Failed to retrieve user records: " . $e->getMessage());
        return $response->withJson($data, 500);
    }
});

// Function to find a collection by kategori
function findCollectionByKategori($makanan, $kategori)
{
    $matchingCollection = [];
    foreach ($makanan as $collection) {
        if ($collection['kategori'] === $kategori) {
            $matchingCollection[] = $collection;
        }
    }
    return $matchingCollection;
}

$app->post('/addfood', function (Request $request, Response $response) {
    $requestData = $request->getParsedBody();
    $kategori = $requestData["kategori"];
    $name = $requestData["nama"];
    $description = $requestData["description"];
    $ingredients = $requestData["resepi"];
    $image = $requestData["gambar"];

    if (!$kategori || !$name || !$description || !$ingredients || !$image) {
        $data = array("status" => "fail", "error" => "Missing required fields");
        return $response->withJson($data, 400);
    }

    try {
        $db = new db();
        $sql = "INSERT INTO collectionskuih (kategori, nama, description, resepi, gambar) VALUES (:kategori, :nama,
        :description, :resepi, :gambar)";
        $connection = $db->connect();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':kategori', $kategori);
        $stmt->bindValue(':nama', $name);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':resepi', $ingredients);
        $stmt->bindValue(':gambar', $image);
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
        $data = array("status" => "success", "rowcount" => $count);
        return $response->withJson($data);
    } catch (PDOException $e) {
        $data = array("status" => "fail", "error" => $e->getMessage());
        return $response->withJson($data, 500);
    }
});

$app->put('/updatefood/{id}', function (Request $request, Response $response) {
    $requestData = $request->getParsedBody();
    $id = $request->getAttribute('id');
    $name = $requestData["nama"];
    $kategori = $requestData["kategori"];
    $description = $requestData["description"];
    $ingredients = $requestData["resepi"];
    $image = $requestData["gambar"];

    try {
        $db = new db();
        $connection = $db->connect();
        $query = "UPDATE collectionskuih SET kategori = :kategori, nama = :nama, description = :description , resepi = :resepi, gambar = :gambar WHERE id = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':nama', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':resepi', $ingredients);
        $statement->bindParam(':gambar', $image);
        $statement->bindParam(':kategori', $kategori);
        $statement->execute();
        $rowCount = $statement->rowCount();

        if ($rowCount > 0) {
            $data = array("message" => "Makanan updated successfully");
            return $response->withJson($data);
        } else {
            $data = array("error" => "No food with such cuisine found");
            return $response->withJson($data, 404);
        }
    } catch (PDOException $e) {
        $data = array("error" => "Failed to update food: " . $e->getMessage());
        return $response->withJson($data, 500);
    }
});

$app->delete('/deletefood/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    try {
        $db = new db();
        $connection = $db->connect();
        $statement = $connection->prepare('DELETE FROM collectionskuih WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
        $count = $statement->rowCount();
        $db = null;
        $data = array("status" => "success", "rowcount" => $count);
        return $response->withJson($data);
    } catch (PDOException $e) {
        $data = array("status" => "fail");
        return $response->withJson($data, 500);
    }
});

$app->run();
?>
