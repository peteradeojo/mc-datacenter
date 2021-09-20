<?php

try {
	$db->updateRecord(
		[
			'documentations' => [
				// 'id' => $id,
				'total_bill' => $_POST['total_bill'],
				'amount_paid' => $_POST['amount_paid'],
				'deposit' => $_POST['deposit']
			]
		],
		where: "id='$id'"
	);
} catch (Exception $e) {
	flash(['message' => $e->getMessage(), 'mode' => 'danger']);
}
header("Location: /doc.php?id=$id");
