<?php

//echo "atualiza_infos";

$tipo_lanc = @$_REQUEST['atualiza_contas']; 

echo '<script>console.log("Tipo do Lanc   ")</script>';
echo "<script>var tipo_lanc = '$tipo_lanc';   </script>";
echo '<script>console.log("Tipo do Lançamento  "+tipo_lanc)</script>';
//echo die();

//desliga_membro

if($tipo_lanc=='inclui_filho'){ 
    echo '<script>console.log("Inclusao de filho sdsdsd "+tipo_lanc)</script>';
    $id_membro = (@$_REQUEST['id_membro']); 
    $nascimento_filho = @$_REQUEST['nascimento_filho'];
    $nome_filho = urldecode( @$_REQUEST['nome_filho'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    
    if ($nascimento_filho !=''){
        
        $aux = DateTime::createFromFormat('d/m/Y', $nascimento_filho)->format('Y-m-d');            
        $nascimento_filho = "$aux";
    } 
    else{$nascimento_filho = "null";}       
    echo "<script>console.log('PONTO DE PARADA $aux')</script>";
    
    echo "<script>var id_membro = '$id_membro';   </script>";
    echo "<script>var nome_filho = '$nome_filho';   </script>";
    echo "<script>var nascimento_filho = \"$nascimento_filho\";   </script>";
    
    
    echo '<script>console.log("AQUI QUE QUERO OS RESULTADOS")</script>';
    echo '<script>console.log("var id do membro  "+id_membro)</script>';
    echo '<script>console.log("var nome do filho  "+nome_filho)</script>';
    echo '<script>console.log("var nascimento do filho  "+nascimento_filho)</script>';    
    
    //echo die();
    //
    //$id_do_grupo=1;
    //include "conexao.php";  
    //$my = new OpenDB();
    //$link = $my->server();
    //$sql = "insert into plano_contas_grupo (grupo_nome) values ('{$nome_grupo}')";
    
    //mysqli_query($link,$sql) or die(mysqli_error($link));
    //header("Location:../x-plano-contas/plano_contas.php");
    //echo '<script>console.log("gravando novo grupo")</script>';

}




if($tipo_lanc=='desliga_membro'){   /// QUANDO EDITA MEMBRO
    
    echo '<script>console.log("gravando desligamento do membro")</script>';
    $id_membro = (@$_REQUEST['id_membro']); 
    $Desliga_membro_data = (@$_REQUEST['dataDesligamento']); 
    $Desliga_membro_ata = (@$_REQUEST['ata_desligamento']); 
    $Desliga_membro_motivo = urldecode( @$_REQUEST['motivoDesligamento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
   // $Desliga_membro_motivo = (@$_REQUEST['motivoDesligamento']); 
    
    echo '<script>console.log("CHEGAMOS PARA GRAVAR DESLIGA MEMBRO")</script>';    
    
    
    echo "<script>var idMembro = '$id_membro';   </script>";
    echo "<script>var DesligaData = '$Desliga_membro_data';   </script>";
    echo "<script>var DesligaAta = '$Desliga_membro_ata';   </script>";
    echo "<script>var DesligaMotivo = '$Desliga_membro_motivo';   </script>";
    
    echo '<script>console.log("ID membro   "+idMembro)</script>';
    echo '<script>console.log("Data   "+DesligaData)</script>';
    echo '<script>console.log("Ata   "+DesligaAta)</script>';
    echo '<script>console.log("Motivo   "+DesligaMotivo)</script>';
    
    if ($Desliga_membro_data !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $Desliga_membro_data)->format('Y-m-d');
        $Desliga_membro_data = "'$aux'";
        } else{$Desliga_membro_data = "null";}    
    
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();        

    $sql = "update membresia set
        uso_ibr_desliga_ata= '{$Desliga_membro_ata}',
        uso_ibr_desligamento={$Desliga_membro_data},
        uso_ibr_desliga_motivo='{$Desliga_membro_motivo}'

        where id_membresia=$id_membro";
                    
    
    mysqli_query($link,$sql) or die(mysqli_error($link));
    echo '<script>console.log("gravando desligamento de membro   ")</script>'; 
    header("Location:../x-membresia/membresia.php");
    echo '<script>console.log("gravando membro editado   ")</script>';        

       
    
}

if($tipo_lanc=='edita_membro'){   /// QUANDO EDITA MEMBRO
    
    echo '<script>console.log("gravando edita membro")</script>';
    $id_membro = (@$_REQUEST['id_membro']); 
    $nome_membro = urldecode( @$_REQUEST['nome_membro'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $nascimento_membro = ( @$_REQUEST['nascimento_membro'] );      
    $membro_nasc_cidade = urldecode( @$_REQUEST['membro_nasc_cidade'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_nasc_estado = urldecode( @$_REQUEST['membro_nasc_estado'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_cep = urldecode( @$_REQUEST['membro_cep'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco = urldecode( @$_REQUEST['membro_Endereco'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Nr = urldecode( @$_REQUEST['membro_Endereco_Nr'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Bairro = urldecode( @$_REQUEST['membro_Endereco_Bairro'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Complemento = urldecode( @$_REQUEST['membro_Endereco_Complemento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Cidade = urldecode( @$_REQUEST['membro_Endereco_Cidade'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Estado = urldecode( @$_REQUEST['membro_Endereco_Estado'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Estado_Civil = @$_REQUEST['membro_Estado_Civil'];  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Grau_Instrucao = @$_REQUEST['membro_grau_instrucao'];  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Telefone = urldecode( @$_REQUEST['membro_Telefone'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Celular = urldecode( @$_REQUEST['membro_Celular'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Email = urldecode( @$_REQUEST['membro_Email'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Rede_social = urldecode( @$_REQUEST['membro_Rede_Social'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Conjuge = urldecode( @$_REQUEST['membroConjuge'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Data_casamento = urldecode( @$_REQUEST['membroDataCasamento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Nome_Pai = urldecode( @$_REQUEST['membroNomePai'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Nome_Mae = urldecode( @$_REQUEST['membroNomeMae'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Local_Trabalho = urldecode( @$_REQUEST['membroLocalTrabalho'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Ramo_Trabalho = urldecode( @$_REQUEST['membroRamoTrabalho'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_BatisadoSN = urldecode( @$_REQUEST['membroBatismoSN'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Data_Batisado = ( @$_REQUEST['membroDataBatismo'] ); 
    $membro_Batismo_Igreja = urldecode( @$_REQUEST['membroBatismoIgreja'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Batismo_Pastor = urldecode( @$_REQUEST['membroBatismoPastor'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Batismo_Cidade = urldecode( @$_REQUEST['membroBatismoCidade'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Batismo_Estado = urldecode( @$_REQUEST['membroBatismoEstado'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Tipo_Recebimento = urldecode( @$_REQUEST['membroTipoRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Data_Recebimento = ( @$_REQUEST['membroDataRecebimento'] ); 
    $membro_Ata_Recebimento = urldecode( @$_REQUEST['membroAtaRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Pastor_Recebimento = urldecode( @$_REQUEST['membroPastorRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Igreja_Recebimento = urldecode( @$_REQUEST['membroIgrejaRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
 //echo die();   
    //membroLocalTrabalho
    
    //echo "<script>CHEGAMOS PARA GRAVAR EDIÇAO DO MEMBRO</script>";
        echo '<script>console.log("CHEGAMOS PARA GRAVAR EDIÇAO DO MEMBRO")</script>';
//    echo die();
    echo "<script>var idMembro = '$id_membro';   </script>";
    echo "<script>var nomeMembro = '$nome_membro';   </script>";
    echo "<script>var nascimentoMembro = '$nascimento_membro';   </script>";
    echo "<script>var MembroNascCidade = '$membro_nasc_cidade';   </script>";
    echo "<script>var MembroNascEstado = '$membro_nasc_estado';   </script>";
    echo "<script>var MembroCep = '$membro_cep';   </script>";
    echo "<script>var MembroEndereco = '$membro_Endereco';   </script>";
    echo "<script>var MembroEnderecoNr = '$membro_Endereco_Nr';   </script>";
    echo "<script>var MembroEnderecoBairro = '$membro_Endereco_Bairro';   </script>";
    echo "<script>var MembroEnderecoComplemento = '$membro_Endereco_Complemento';   </script>";
    echo "<script>var MembroEnderecoCidade = '$membro_Endereco_Cidade';   </script>";
    echo "<script>var MembroEnderecoEstado = '$membro_Endereco_Estado';   </script>";
    echo "<script>var MembroEstadoCivil = '$membro_Estado_Civil';   </script>";
    echo "<script>var MembroGrauInstrucao = '$membro_Grau_Instrucao';   </script>";
    echo "<script>var MembroTelefone = '$membro_Telefone';   </script>";
    echo "<script>var MembroCelular = '$membro_Celular';   </script>";
    echo "<script>var MembroEmail = '$membro_Email';   </script>";
    echo "<script>var MembroRedeSocial = '$membro_Rede_social';   </script>";
    echo "<script>var MembroConjuge = '$membro_Conjuge';   </script>";
    echo "<script>var MembroDataCasamento = '$membro_Data_casamento';   </script>";
    echo "<script>var MembroNomePai = '$membro_Nome_Pai';   </script>";
    echo "<script>var MembroNomeMae = '$membro_Nome_Mae';   </script>";
    echo "<script>var MembroLocalTrabalho = '$membro_Local_Trabalho';   </script>";
    echo "<script>var MembroRamoTrabalho = '$membro_Ramo_Trabalho';   </script>";
    echo "<script>var MembroBatisadoSN = '$membro_BatisadoSN';   </script>";
    echo "<script>var MembroDataBatisado = '$membro_Data_Batisado';   </script>";
    echo "<script>var MembroBatismoIgreja = '$membro_Batismo_Igreja';   </script>";
    echo "<script>var MembroBatismoPastor = '$membro_Batismo_Pastor';   </script>";
    echo "<script>var MembroBatismoCidade = '$membro_Batismo_Cidade';   </script>";
    echo "<script>var MembroBatismoEstado = '$membro_Batismo_Estado';   </script>";
    echo "<script>var MembroTipoRecebimento = '$membro_Tipo_Recebimento';   </script>";
    echo "<script>var MembroAtaRecebimento = '$membro_Ata_Recebimento';   </script>";
    echo "<script>var MembroPastorRecebimento = '$membro_Pastor_Recebimento';   </script>";
    echo "<script>var MembroIgrejaRecebimento = '$membro_Igreja_Recebimento';   </script>";
    
    
        
    echo '<script>console.log("Nome membro   "+nomeMembro)</script>';
    echo '<script>console.log("Nascimento membro    "+nascimentoMembro)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Cidade membro    "+MembroNascCidade)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Estado membro    "+MembroNascEstado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("CEP membro    "+MembroCep)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço membro    "+MembroEndereco)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Numero membro    "+MembroEnderecoNr)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Bairro membro    "+MembroEnderecoBairro)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Complemento membro    "+MembroEnderecoComplemento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Cidade membro    "+MembroEnderecoCidade)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Estado membro    "+MembroEnderecoEstado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Estado Civil membro    "+MembroEstadoCivil)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Grau Instruçao membro    "+MembroGrauInstrucao)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Telefone membro    "+MembroTelefone)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Celular membro    "+MembroCelular)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Email membro    "+MembroEmail)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Rede Social membro    "+MembroRedeSocial)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Conjuge membro    "+MembroConjuge)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Data Casamento membro    "+MembroDataCasamento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Pai membro    "+MembroNomePai)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Mae membro    "+MembroNomeMae)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Local Trabalho membro    "+MembroLocalTrabalho)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Ramo Trabalho membro    "+MembroRamoTrabalho)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batisado? membro    "+MembroBatisadoSN)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismos Data membro    "+MembroDataBatisado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Igreja membro    "+MembroBatismoIgreja)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Pastor membro    "+MembroBatismoPastor)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Cidade membro    "+MembroBatismoCidade)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Estado membro    "+MembroBatismoEstado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Tipo Recebimento membro    "+MembroTipoRecebimento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Ata Recebimento membro    "+MembroAtaRecebimento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Pastor Recebimento membro    "+MembroPastorRecebimento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Igreja Recebimento membro    "+MembroIgrejaRecebimento)</script>'; // Exibindo o valor no console

        
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();
    // Caso tenha data valida
    if ($nascimento_membro !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $nascimento_membro)->format('Y-m-d');
        $nascimento_membro = "'$aux'";
        } else{$nascimento_membro = "null";}

    if ($membro_Data_casamento !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $membro_Data_casamento)->format('Y-m-d');
        $membro_Data_casamento = "'$aux'";
        } else{$membro_Data_casamento = "null";}  

    if ($membro_Data_Batisado !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $membro_Data_Batisado)->format('Y-m-d');
        $membro_Data_Batisado = "'$aux'";
        } else{$membro_Data_Batisado = "null";}  
        
    if ($membro_Data_Recebimento !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $membro_Data_Recebimento)->format('Y-m-d');
        $membro_Data_Recebimento = "'$aux'";
        } else{$membro_Data_Recebimento = "null";}         
        
    $sql = "update membresia set
            nome= '{$nome_membro}',
            nascimento={$nascimento_membro},
            nascimento_cidade='{$membro_nasc_cidade}',
            nascimento_estado= '{$membro_nasc_estado}',
            estado_civil='{$membro_Estado_Civil}',
            conjuge='{$membro_Conjuge}',
            casamento={$membro_Data_casamento},
            nome_pai='{$membro_Nome_Pai}',
            nome_mae='{$membro_Nome_Mae}',
            grau_instrucao='{$membro_Grau_Instrucao}',
            endereco_rua='{$membro_Endereco}',
            endereco_numero='{$membro_Endereco_Nr}',
            endereco_bairo='{$membro_Endereco_Bairro}',
            endereco_cep='{$membro_cep}',
            endereco_complemento='{$membro_Endereco_Complemento}',
            endereco_cidade='{$membro_Endereco_Cidade}',
            endereco_estado='{$membro_Endereco_Estado}',
            telefone='{$membro_Telefone}',
            celular='{$membro_Celular}',
            email='{$membro_Email}',
            rede_social='{$membro_Rede_social}',
            trabalho_local='{$membro_Local_Trabalho}',
            trabalho_ramo='{$membro_Ramo_Trabalho}',
            batismo='{$membro_BatisadoSN}',
            batismo_igreja='{$membro_Batismo_Igreja}',
            batismo_data={$membro_Data_Batisado},
            batismo_pastor='{$membro_Batismo_Pastor}',
            batismo_cidade='{$membro_Batismo_Cidade}',
            batismo_estado='{$membro_Batismo_Estado}',
            uso_ibr_membresia='{$membro_Tipo_Recebimento}',
            uso_ibr_data={$membro_Data_Recebimento},
            uso_ibr_ata='{$membro_Ata_Recebimento}',
            uso_ibr_pastor='{$membro_Pastor_Recebimento}',
            uso_ibr_igreja='{$membro_Igreja_Recebimento}'                 

                where id_membresia=$id_membro";
                    
    
    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location:../x-membresia/membresia.php");
    echo '<script>console.log("gravando membro editado   ")</script>';        

    //mysqli_query($link,$sql) or die(mysqli_error($link));
    //header("Location:../x-membresia/membresia.php");
    //echo '<script>console.log("gravando membro editado   ")</script>';

}






if($tipo_lanc=='novo_membro'){   /// QUANDO MEMBRO FOR NOVO
    
    echo '<script>console.log("gravando novo membro")</script>';
    
    $nome_membro = urldecode( @$_REQUEST['nome_membro'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $nascimento_membro = ( @$_REQUEST['nascimento_membro'] );
        
    $membro_nasc_cidade = urldecode( @$_REQUEST['membro_nasc_cidade'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_nasc_estado = urldecode( @$_REQUEST['membro_nasc_estado'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_cep = urldecode( @$_REQUEST['membro_cep'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco = urldecode( @$_REQUEST['membro_Endereco'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Nr = urldecode( @$_REQUEST['membro_Endereco_Nr'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Bairro = urldecode( @$_REQUEST['membro_Endereco_Bairro'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Complemento = urldecode( @$_REQUEST['membro_Endereco_Complemento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Cidade = urldecode( @$_REQUEST['membro_Endereco_Cidade'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Endereco_Estado = urldecode( @$_REQUEST['membro_Endereco_Estado'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Estado_Civil = @$_REQUEST['membro_Estado_Civil'];  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Grau_Instrucao = @$_REQUEST['membro_grau_instrucao'];  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Telefone = urldecode( @$_REQUEST['membro_Telefone'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Celular = urldecode( @$_REQUEST['membro_Celular'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Email = urldecode( @$_REQUEST['membro_Email'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Rede_social = urldecode( @$_REQUEST['membro_Rede_Social'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Conjuge = urldecode( @$_REQUEST['membroConjuge'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Data_casamento = urldecode( @$_REQUEST['membroDataCasamento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Nome_Pai = urldecode( @$_REQUEST['membroNomePai'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Nome_Mae = urldecode( @$_REQUEST['membroNomeMae'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Local_Trabalho = urldecode( @$_REQUEST['membroLocalTrabalho'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Ramo_Trabalho = urldecode( @$_REQUEST['membroRamoTrabalho'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_BatisadoSN = urldecode( @$_REQUEST['membroBatismoSN'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Data_Batisado = ( @$_REQUEST['membroDataBatismo'] ); 
    $membro_Batismo_Igreja = urldecode( @$_REQUEST['membroBatismoIgreja'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Batismo_Pastor = urldecode( @$_REQUEST['membroBatismoPastor'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Batismo_Cidade = urldecode( @$_REQUEST['membroBatismoCidade'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Batismo_Estado = urldecode( @$_REQUEST['membroBatismoEstado'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Tipo_Recebimento = urldecode( @$_REQUEST['membroTipoRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Data_Recebimento = ( @$_REQUEST['membroDataRecebimento'] ); 
    $membro_Ata_Recebimento = urldecode( @$_REQUEST['membroAtaRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Pastor_Recebimento = urldecode( @$_REQUEST['membroPastorRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $membro_Igreja_Recebimento = urldecode( @$_REQUEST['membroIgrejaRecebimento'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    
    
    //membroLocalTrabalho
    
    
    echo "<script>var nomeMembro = '$nome_membro';   </script>";
    echo "<script>var nascimentoMembro = '$nascimento_membro';   </script>";
    echo "<script>var MembroNascCidade = '$membro_nasc_cidade';   </script>";
    echo "<script>var MembroNascEstado = '$membro_nasc_estado';   </script>";
    echo "<script>var MembroCep = '$membro_cep';   </script>";
    echo "<script>var MembroEndereco = '$membro_Endereco';   </script>";
    echo "<script>var MembroEnderecoNr = '$membro_Endereco_Nr';   </script>";
    echo "<script>var MembroEnderecoBairro = '$membro_Endereco_Bairro';   </script>";
    echo "<script>var MembroEnderecoComplemento = '$membro_Endereco_Complemento';   </script>";
    echo "<script>var MembroEnderecoCidade = '$membro_Endereco_Cidade';   </script>";
    echo "<script>var MembroEnderecoEstado = '$membro_Endereco_Estado';   </script>";
    echo "<script>var MembroEstadoCivil = '$membro_Estado_Civil';   </script>";
    echo "<script>var MembroGrauInstrucao = '$membro_Grau_Instrucao';   </script>";
    echo "<script>var MembroTelefone = '$membro_Telefone';   </script>";
    echo "<script>var MembroCelular = '$membro_Celular';   </script>";
    echo "<script>var MembroEmail = '$membro_Email';   </script>";
    echo "<script>var MembroRedeSocial = '$membro_Rede_social';   </script>";
    echo "<script>var MembroConjuge = '$membro_Conjuge';   </script>";
    echo "<script>var MembroDataCasamento = '$membro_Data_casamento';   </script>";
    echo "<script>var MembroNomePai = '$membro_Nome_Pai';   </script>";
    echo "<script>var MembroNomeMae = '$membro_Nome_Mae';   </script>";
    echo "<script>var MembroLocalTrabalho = '$membro_Local_Trabalho';   </script>";
    echo "<script>var MembroRamoTrabalho = '$membro_Ramo_Trabalho';   </script>";
    echo "<script>var MembroBatisadoSN = '$membro_BatisadoSN';   </script>";
    echo "<script>var MembroDataBatisado = '$membro_Data_Batisado';   </script>";
    echo "<script>var MembroBatismoIgreja = '$membro_Batismo_Igreja';   </script>";
    echo "<script>var MembroBatismoPastor = '$membro_Batismo_Pastor';   </script>";
    echo "<script>var MembroBatismoCidade = '$membro_Batismo_Cidade';   </script>";
    echo "<script>var MembroBatismoEstado = '$membro_Batismo_Estado';   </script>";
    echo "<script>var MembroTipoRecebimento = '$membro_Tipo_Recebimento';   </script>";
    echo "<script>var MembroAtaRecebimento = '$membro_Ata_Recebimento';   </script>";
    echo "<script>var MembroPastorRecebimento = '$membro_Pastor_Recebimento';   </script>";
    echo "<script>var MembroIgrejaRecebimento = '$membro_Igreja_Recebimento';   </script>";
    
    
        
    echo '<script>console.log("Nome membro   "+nomeMembro)</script>';
    echo '<script>console.log("Nascimento membro    "+nascimentoMembro)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Cidade membro    "+MembroNascCidade)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Estado membro    "+MembroNascEstado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("CEP membro    "+MembroCep)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço membro    "+MembroEndereco)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Numero membro    "+MembroEnderecoNr)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Bairro membro    "+MembroEnderecoBairro)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Complemento membro    "+MembroEnderecoComplemento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Cidade membro    "+MembroEnderecoCidade)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Endereço Estado membro    "+MembroEnderecoEstado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Estado Civil membro    "+MembroEstadoCivil)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Grau Instruçao membro    "+MembroGrauInstrucao)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Telefone membro    "+MembroTelefone)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Celular membro    "+MembroCelular)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Email membro    "+MembroEmail)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Rede Social membro    "+MembroRedeSocial)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Conjuge membro    "+MembroConjuge)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Data Casamento membro    "+MembroDataCasamento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Pai membro    "+MembroNomePai)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Mae membro    "+MembroNomeMae)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Local Trabalho membro    "+MembroLocalTrabalho)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Ramo Trabalho membro    "+MembroRamoTrabalho)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batisado? membro    "+MembroBatisadoSN)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismos Data membro    "+MembroDataBatisado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Igreja membro    "+MembroBatismoIgreja)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Pastor membro    "+MembroBatismoPastor)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Cidade membro    "+MembroBatismoCidade)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Batismo Estado membro    "+MembroBatismoEstado)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Tipo Recebimento membro    "+MembroTipoRecebimento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Ata Recebimento membro    "+MembroAtaRecebimento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Pastor Recebimento membro    "+MembroPastorRecebimento)</script>'; // Exibindo o valor no console
    echo '<script>console.log("Igreja Recebimento membro    "+MembroIgrejaRecebimento)</script>'; // Exibindo o valor no console

        
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();
    // Caso tenha data valida
    if ($nascimento_membro !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $nascimento_membro)->format('Y-m-d');
        $nascimento_membro = "'$aux'";
        } else{$nascimento_membro = "null";}

    if ($membro_Data_casamento !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $membro_Data_casamento)->format('Y-m-d');
        $membro_Data_casamento = "'$aux'";
        } else{$membro_Data_casamento = "null";}  

    if ($membro_Data_Batisado !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $membro_Data_Batisado)->format('Y-m-d');
        $membro_Data_Batisado = "'$aux'";
        } else{$membro_Data_Batisado = "null";}  
        
    if ($membro_Data_Recebimento !==''){
        $aux = DateTime::createFromFormat('d/m/Y', $membro_Data_Recebimento)->format('Y-m-d');
        $membro_Data_Recebimento = "'$aux'";
        } else{$membro_Data_Recebimento = "null";}         
        
        
    $sql = "insert into membresia (nome, 
                nascimento, 
                nascimento_cidade, 
                nascimento_estado, 
                estado_civil,
                conjuge,
                casamento,
                nome_pai,
                nome_mae,
                grau_instrucao,
                endereco_rua,
                endereco_numero,
                endereco_bairo,
                endereco_cep,
                endereco_complemento,
                endereco_cidade,
                endereco_estado,
                telefone,
                celular,
                email,
                rede_social,
                trabalho_local,
                trabalho_ramo,
                batismo,
                batismo_igreja,
                batismo_data,
                batismo_pastor,
                batismo_cidade,
                batismo_estado,
                uso_ibr_membresia,
                uso_ibr_data,
                uso_ibr_ata,
                uso_ibr_pastor,
                uso_ibr_igreja) 
            values ('{$nome_membro}',
                {$nascimento_membro},
                '{$membro_nasc_cidade}',
                '{$membro_nasc_estado}',
                '{$membro_Estado_Civil}',
                '{$membro_Conjuge}',
                {$membro_Data_casamento},
                '{$membro_Nome_Pai}',
                '{$membro_Nome_Mae}',
                '{$membro_Grau_Instrucao}',
                '{$membro_Endereco}',
                '{$membro_Endereco_Nr}',
                '{$membro_Endereco_Bairro}',
                '{$membro_cep}',
                '{$membro_Endereco_Complemento}',
                '{$membro_Endereco_Cidade}',
                '{$membro_Endereco_Estado}',
                '{$membro_Telefone}',
                '{$membro_Celular}',
                '{$membro_Email}',
                '{$membro_Rede_social}',
                '{$membro_Local_Trabalho}',    
                '{$membro_Ramo_Trabalho}',
                '{$membro_BatisadoSN}', 
                '{$membro_Batismo_Igreja}',
                {$membro_Data_Batisado},
                '{$membro_Batismo_Pastor}',
                '{$membro_Batismo_Cidade}',
                '{$membro_Batismo_Estado}',
                '{$membro_Tipo_Recebimento}',
                {$membro_Data_Recebimento},
                '{$membro_Ata_Recebimento}',
                '{$membro_Pastor_Recebimento}',
                '{$membro_Igreja_Recebimento}'
                )";
    
    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location:../x-membresia/membresia.php");
    echo '<script>console.log("gravando novo membro")</script>';

}



if($tipo_lanc=='novo_grupo'){   /// QUANDO GRUPO FOR NOVO
    $nome_grupo = urldecode( @$_REQUEST['grupo_conta'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $id_do_grupo=1;
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();
    $sql = "insert into plano_contas_grupo (grupo_nome) values ('{$nome_grupo}')";
    
    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location:../x-plano-contas/plano_contas.php");
    echo '<script>console.log("gravando novo grupo")</script>';

}

if($tipo_lanc=='edita_grupo'){   /// QUANDO EDITA GRUPO
    $nome_grupo = urldecode( @$_REQUEST['grupo_conta'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $id_do_grupo=@$_REQUEST['id_grupo'];
    //echo '<script>console.log("atualizando grupo") </script>';
    //echo "die()";
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();
    //$sql = "UPDATE usuarios SET nome='$novoNome', email='$novoEmail' WHERE id=1"
    $sql = "update plano_contas_grupo set  grupo_nome='$nome_grupo' where id_grupo=$id_do_grupo";

    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location:../x-plano-contas/plano_contas.php");
    echo '<script>console.log("gravando novo grupo")</script>';

}

if($tipo_lanc=='edita_conta'){   /// QUANDO EDITA CONTA
    $nome_conta = urldecode( @$_REQUEST['nome_conta'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $id_da_conta=@$_REQUEST['id_conta'];
    echo '<script>console.log("atualizando CONTA") </script>';
   // echo '<script>console.log($nome_conta) </script>';
   // echo '<script>console.log($id_da_conta) </script>';
    //echo "die()";
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();
    //$sql = "UPDATE usuarios SET nome='$novoNome', email='$novoEmail' WHERE id=1"
    $sql = "update plano_contas_conta set  nome='$nome_conta' where id_contas=$id_da_conta";

    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location:../x-plano-contas/plano_contas.php");
    echo '<script>console.log("gravando edita conta")</script>';

}





if($tipo_lanc=='nova_conta'){   /// QUANDO CONTA FOR NOVA
    $nome_conta = urldecode( @$_REQUEST['nome_conta'] );  //DECODIFICA O CARACTER ESPACO DENTRO DO INPUT
    $id_do_grupo = @$_REQUEST['id_do_grupo'];
    include "conexao.php";  
    $my = new OpenDB();
    $link = $my->server();
    $sql = "insert into plano_contas_conta (grupo, nome) values ('{$id_do_grupo}','{$nome_conta}')";
    
    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location:../x-plano-contas/plano_contas_info.php?nrid=$id_do_grupo");
    echo "<script type='text/javascript'>
            alert('Cadastro Concluido!');
         </script>";
    
}
?>