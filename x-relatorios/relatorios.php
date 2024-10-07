<div id="relatorios">

    <div class="row">
        <div class="col s12">
            <div class="font01">LANÇAMENTOS DA CONTA</div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="row">

                    <div class="col s3">
                        <fieldset>
                            <legend>Data inicial:</legend>
                            <input type="date" id="data_inicial" value="<?= date('Y-m-d', strtotime('-1 month')) ?>">
                        </fieldset>
                    </div>

                    <div class="col s3">
                        <fieldset>
                            <legend>Data final:</legend>
                            <input type="date" id="data_final" value="<?= date('Y-m-d') ?>">
                        </fieldset>
                    </div>

                    <div class="col s3">
                        <fieldset>
                            <legend>Selecione:</legend>
                            <select id="tipo_lancamento">
                                <option value="RECEITAS">Receitas</option>
                                <option value="DESPESAS">Despesas</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col s3">
                        <button class="btn waves-effect waves-light" id="btn_buscar">BUSCAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card colunas">
                <div id="div_lancamentos"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    principal.carregarArquivo('x-relatorios/relatorios.css');
    principal.carregarArquivo('x-relatorios/relatorios.js');
</script>