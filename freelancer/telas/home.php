<?php
require_once "../conection/conection.php";
$con = ConnectFactory::getConection();


?>
<html>

<head>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->

</head>

<body>
    <div class="area">

    </div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="?p=home">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        Home
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="#">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="nav-text">
                        Cadastro Cargos
                    </span>
                </a>

            </li>

        </ul>

        <ul class="logout">
            <li>
                <a href="../index.php">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="conteudo">

        <?php



        @$pagina = $_GET['p'];


        switch ($pagina) {
            case 'pedente':
                include "home.php";
                break;
            case 'parceiro':
                include "parceiro.php";
                break;

            default:
                # code...
                break;
        }
        ?>
        <!-- Formulario -->
        <form action="../telas/home.php" method="POST">
            <div class="form-group row ">
                <div class=" col-md-5">
                    <div class="input-group mb-3">
                        <div class="input-group-active">
                            <label class="input-group-text" for="inputGroupSelect01">FILTRO</label>
                        </div>

                        <?php

                        $sql = "SELECT `cargo_nome` FROM `cargos` ";
                        $select =  $con->prepare($sql);
                        $select->execute();
                        ?> <select class='custom-select' id='inputGroupSelect01' name="select">

                            <?php

                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) {


                                echo "<option selected>" . $row['cargo_nome'] . "</option>";
                            }
                            ?></select>
                        <?php


                        ?>
                    </div>
                </div>


                <div class=" col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-active">
                            <label class="input-group-text" for="inputGroupSelect01">MIN</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="min">
                            <option selected>900,00</option>
                            <option selected>1000,00</option>
                            <option selected>1500,00</option>
                            <option selected>2000,00</option>
                            <option selected>2500,00</option>

                        </select>
                    </div>
                </div>
                <div class=" col-md-3">
                    <div class="input-group mb-3">
                        <div class="input-group-active">
                            <label class="input-group-text" for="inputGroupSelect01">MAX</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="max">
                            <option selected>900,00</option>
                            <option selected>1000,00</option>
                            <option selected>1500,00</option>
                            <option selected>2000,00</option>
                            <option selected>2500,00</option>

                        </select>
                    </div>
                </div>
                <div class=" col-md-1">

                    <input type="submit" value="Pesquisar" class="btn btn-secondary btn-sm">

                </div>
            </div>
        </form>
        <!--  Fim Formulario -->
        <br>

        <!-- Tabela -->
        <table class="table table-hover">
            <thead>
                <tr class="table-active">

                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tel</th>
                    <th scope="col">Pret Salarial</th>
                    <th scope="col">Vaga Interesse</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Curriculo</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php

                    @$select = $_POST["select"];
                    @$max = $_POST['max'];
                    @$min = $_POST['min'];

                 
                    if (empty($select)) {
                        $sql = "select candidato_id,candidato_nome,candidato_email,candidato_telefone,candidato_salario,cargo_nome from candidatos
                        inner join cargos on cargo_id = candidato_cargo where 1" ;
                    } else {

                        $sql = "select candidato_id,candidato_nome,candidato_email,candidato_telefone,candidato_salario,cargo_nome from candidatos
                         inner join cargos on cargo_id = candidato_cargo WHERE cargo_nome = '$select'  ";
                    }
                    $select =  $con->prepare($sql);
                    $select->execute();

                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                <tr>
                    <td><?php echo $row['candidato_nome'] ?> </td>
                    <td><?php echo $row['candidato_email'] ?> </td>
                    <td><?php echo $row['candidato_telefone'] ?> </td>
                    <td><?php echo $row['candidato_salario'] ?> </td>
                    <td><?php echo $row['cargo_nome'] ?> </td>

                    <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['candidato_id'] ?>">Abrir</button></th>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $row['candidato_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['candidato_nome'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <label><b>Nome:</b>&nbsp;</label><?php echo $row['candidato_nome'] ?> </br>
                                    <label><b>Email:</b>&nbsp;</label> <?php echo $row['candidato_email'] ?></br>
                                    <label><b>Telefone:</b>&nbsp;</label><?php echo $row['candidato_telefone'] ?> </br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIM MODAL-->
                    <th><a href="<?php echo $row['candidato_id']; ?>" class="btn btn-success">Baixar</a></th>
                    <th><a href=" <?php echo $row['candidato_id']; ?> " class="btn btn-danger">OFF</a></th>
                </tr>
            <?php

                    }
            ?>
            </tr>
            </tbody>
        </table>

        <!-- Fim Tabela -->
    </div>






    <footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </footer>

</body>

</html>