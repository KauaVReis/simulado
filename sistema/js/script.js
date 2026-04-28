/**
 * Função para buscar produtos na listagem.
 * Captura o valor do input e redireciona a página com o parâmetro de busca na URL.
 */
function buscarProduto() {
    // Obtém o valor digitado pelo usuário no campo de busca
    let item_buscar = document.getElementById("input_buscar_produto").value;
    
    // Se o campo não estiver vazio, redireciona com o parâmetro 'itemProduto'
    if (item_buscar != "") {
        window.location.href = "listar_produtos.php?itemProduto=" + item_buscar;
    } else {
        // Se estiver vazio, apenas recarrega a listagem completa
        window.location.href = "listar_produtos.php";
    }
}