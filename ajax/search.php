<?php

include_once dirname(__DIR__) . '/includes/autoload.php';

$database = new Database();
$db = $database->dbConnect();

$keyword = $_POST['keyword'];
$query = "SELECT categories.name, categories.id, 'category' as type FROM categories WHERE categories.name LIKE '%{$keyword}%' UNION
           SELECT products.name, products.id, 'product' as type FROM products WHERE products.name LIKE '%{$keyword}%'";
$stmt = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

if (count($stmt) > 0):

?>

<ul>

<?php
foreach ($stmt as $result):

if ($result['type'] == 'category'):

?>

  <li><a href="products.php?cat_id=<?= $result['id'] ?>"><?= $result['name'] ?> <span class="department">Department</span></a></li>

<?php else: ?>

  <li><a href="product.php?id=<?= $result['id'] ?>"><?= $result['name'] ?> </a></li>

<?php

endif;
endforeach;

?>

</ul>

<?php endif; ?>
