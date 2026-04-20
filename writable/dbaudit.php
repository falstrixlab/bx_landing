<?php
$pdo = new PDO('mysql:host=localhost;dbname=admbxsea_bxsea;charset=utf8', 'root', '');
$rows = $pdo->query('SELECT masterdesc_id, masterdesc_title, masterdesc_position, masterdesc_menu FROM tbl_masterdesc ORDER BY masterdesc_id')->fetchAll(PDO::FETCH_ASSOC);
echo "=== MASTERDESC ROWS ===\n";
foreach ($rows as $r) {
    echo str_pad($r['masterdesc_id'],3) . ' | ' . str_pad($r['masterdesc_position'],30) . ' | ' . str_pad($r['masterdesc_menu'],15) . ' | ' . substr($r['masterdesc_title'],0,40) . "\n";
}

echo "\n=== SHOW TYPE CHECK ===\n";
$cols = $pdo->query('SHOW COLUMNS FROM tbl_exploreshow')->fetchAll(PDO::FETCH_ASSOC);
foreach ($cols as $c) { echo $c['Field'] . "\n"; }
