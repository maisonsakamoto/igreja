var Menu = class Menu {
    constructor() {
        this.moveRelogio1();
        this.eventos();
    }

    eventos() {
        // Ao clicar na logo, abrir a página home
        $(".logo").click(function() {
            window.location.href = "index.php";
            //principal.abrirPagina("home.php");
        });

        // Ao clicar no botão do menu, abrir ou fechar o menu
        $(".menu-button").click(function(){
            $(".menu-bar").toggleClass( "open" );
        });
    }

    // Função para atualizar o relógio
    moveRelogio1() {

        let momentoAtual = new Date();
        let hora = momentoAtual.getHours();
        let minuto = momentoAtual.getMinutes();
        let segundo = momentoAtual.getSeconds();
        let str_minuto = new String(minuto);

        if (minuto < 10) {
            minuto = str_minuto = "0" + new String(minuto);
        }

        let str_segundo = new String(segundo);
        if (str_segundo.length == 1) {
            segundo = "0" + segundo;
        }

        // colocar 0 antes dos segundos
        str_segundo = new String(segundo);
        if (segundo < 10) {
            str_segundo = "0" + segundo;
        }

        let horaImprimivel = hora + ":" + minuto + ":" + segundo;
        $("#relogio").val(horaImprimivel);

        setTimeout(() => this.moveRelogio1(), 1000);
    }
}

// Instanciando a classe no final do arquivo
var menu = new Menu();
