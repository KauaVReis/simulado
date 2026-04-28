<?php
// Inicia a sessão para poder destruí-la
session_start();

// Limpa todas as variáveis de sessão
session_unset();

// Destrói a sessão do usuário
session_destroy();

// Redireciona o usuário para a página de login
header("Location: ../../index.php");
exit();
?>
