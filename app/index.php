<?php
// 連接到 SQLite 資料庫
$db_file = getenv('PHP_DATABASE_PATH');
$pdo = new PDO("sqlite:$db_file");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 建立一個資料表（如果不存在）
$pdo->exec("CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY, content TEXT)");

// 插入一條訊息
$content = "Hello from PHP and SQLite! - " . date('Y-m-d H:i:s');
$stmt = $pdo->prepare("INSERT INTO messages (content) VALUES (:content)");
$stmt->execute([':content' => $content]);

echo "<h1>PHP + Nginx + SQLite 環境測試成功！</h1>";
echo "<h2>資料庫連線成功，並插入了一條訊息。</h2>";
echo "<h3>訊息內容: '$content'</h3>";

// 顯示所有訊息
echo "<h2>所有歷史訊息：</h2>";
$stmt = $pdo->query("SELECT * FROM messages ORDER BY id DESC");
echo "<ul>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li>ID: " . htmlspecialchars($row['id']) . " - Content: " . htmlspecialchars($row['content']) . "</li>";
}
echo "</ul>";
?>