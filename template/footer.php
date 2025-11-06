<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>footer</title>
   <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<style>
   .site-footer {
      text-align: center;
      background: #d9d9d9;
      padding: 16px 0;
      z-index: 10;
   }

   .footer-p {
      color: #000;
      text-align: center;
      font-family: 'Segoe UI', Arial, sans-serif;
   }
</style>

<body>
   <footer class="site-footer">
      <p class="footer-p">&copy;2025 Satuan Pelayanan Pemenuhan Gizi. All rights reserved<?php if (isset($show_admin_login_in_footer) && $show_admin_login_in_footer): ?> | <a href="admin/login.php" style="color: #000; text-decoration: none;">Login Admin</a><?php endif; ?></p>
   </footer>
</body>

</html>