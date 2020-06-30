<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home - Bytecell</title>
	
</head>
<body>


<form action="/mp" method="POST">
  <script
   src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
   data-preference-id="<?php echo $id; ?>">
  </script>
</form>
	
</body>
</html>