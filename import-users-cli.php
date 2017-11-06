<?php
require __DIR__ . '/vendor/autoload.php';

echo "IMPORTER USERS:\n";
echo "-----------------\n";

array_shift($argv); // Discard the filename
$file = array_shift($argv);

if (empty($file)) {
    die("ERROR: args must contains filepath (es: php import-users-cli.php utenti.csv)");
}

echo "Start to process file: $file\n";

$settings = require __DIR__ . '/src/settings.php';
$db = $settings['settings']['doctrine']['connection'];

if (!file_exists($file)) {
    die("File not found. Make sure you specified the correct path.");
}

try {
    $pdo = new PDO("mysql:host={$db['host']};dbname={$db['dbname']}", $db['user'], $db['password'],
        array(
            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
} catch (PDOException $e) {
    die("database connection failed: " . $e->getMessage());
}

$fh = fopen($file, 'r+');

$stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, username, password, birthday, created_at, updated_at) VALUES (:firstname, :lastname, :email, :username, :password, :birthday, NOW(), NOW())");

$re = '/^(?=.*\d)(?=.*[A-Z])[a-zA-Z0-9\$!-_\*\?\.]{4,}$/';

$header = fgetcsv($fh, 8192);
$i = 0;
$j = 0;
while (($row = fgetcsv($fh, 8192)) !== FALSE) {
    try {
        preg_match_all($re, $row[4], $matches, PREG_SET_ORDER, 0);
        if (empty($matches))
            throw new Exception('Invalid password pattern');
        $pwd = password_hash($row[4], PASSWORD_DEFAULT);

        $params = [
            'firstname' => $row[0],
            'lastname' => $row[1],
            'email' => $row[2],
            'username' => $row[3],
            'password' => $pwd,
            'birthday' => $row[5]
        ];

        $stmt->execute($params);
    } catch (Exception $e) {
        echo "user '{$row[3]}' not inserted: {$e->getMessage()} \n";
        $j++;
        continue;
    }
    echo "user '{$row[3]}' inserted successfully\n";
    $i++;
}

echo "Process end. {$i} users imported\n";
