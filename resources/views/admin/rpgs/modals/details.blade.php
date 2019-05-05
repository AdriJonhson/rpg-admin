<div class="modal fade" id="modal-details" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <div class="modal-title">
                    <h4 id="player_name">Jogador X </h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="tab-item active" id="tab_01_link">
                            <a href="#tab_1" data-toggle="tab">Informações</a>
                        </li>

                        <li class="tab-item">
                            <a href="#tab_2" data-toggle="tab">Atributos</a>
                        </li>

                        <li class="tab-item disabled" {!! $controlRpg ? 'style="display: block"' : 'style="display: none"' !!} id="inventory">
                            <a href="#tab_3" data-toggle="tab">Inventário</a>
                        </li>

                        <li class="tab-item disabled" {!! $controlRpg ? 'style="display: block"' : 'style="display: none"' !!} id="spells">
                            <a href="#tab_4" data-toggle="tab">Magias</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <p>
                                <strong>Nome: </strong> <span id="char_name"></span>
                            </p>
                            <p>
                                <strong>Raça: </strong> <span id="race"></span>
                            </p>
                            <p>
                                <strong>Sub-Raça: </strong> <span id="sub_race"> </span>
                            </p>
                            <p>
                                <strong>Classe: </strong> <span id="class"></span>
                            </p>
                            <p>
                                <strong>Nível: </strong> <span id="level">00</span>
                            </p>
                            <p>
                                <strong>Experiência: </strong> <span id="experience">00</span>
                            </p>
                            <p>
                                <strong>Descrição: </strong> <span id="description"></span>
                            </p>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Atributo</th>
                                    <th>Valor</th>
                                    <th>Modificador</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Força</td>
                                    <td id="force_value">14</td>
                                    <td id="force_modify">+2</td>
                                </tr>
                                <tr>
                                    <td>Destreza</td>
                                    <td id="skill_value">14</td>
                                    <td id="skill_modify">+2</td>
                                </tr>
                                <tr>
                                    <td>Constituição</td>
                                    <td id="constitution_value">14</td>
                                    <td id="constitution_modify">+2</td>
                                </tr>
                                <tr>
                                    <td>Sabedoria</td>
                                    <td id="sapience_value">14</td>
                                    <td id="sapience_modify">+2</td>
                                </tr>
                                <tr>
                                    <td>Carisma</td>
                                    <td id="charisma_value">14</td>
                                    <td id="charisma_modify">+2</td>
                                </tr>
                                <tr>
                                    <td>Inteligência</td>
                                    <td id="intelligence_value">14</td>
                                    <td id="intelligence_modify">+2</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">

                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_4">

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->