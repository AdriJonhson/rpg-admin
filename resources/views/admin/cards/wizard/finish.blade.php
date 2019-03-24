<div class="box">
    <div class="box-body box-profile">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group">
                    {{--src="https://i.imgur.com/dGo8DOk.png"--}}
                    {{--<input type="file" class="user dropify"--}}
                           {{--data-default-file="https://i.imgur.com/dGo8DOk.png"--}}
                           {{--data-height="200" id="char_image" disabled>--}}
                    <img class="profile-user-img img-responsive img-circle"
                         src="https://i.imgur.com/dGo8DOk.png"
                         alt="User profile" id="uploadImage">
                </div>
            </div>
        </div>

        <h3 class="profile-username text-center" id="char_name">Nome Personagem</h3>

        <p class="text-muted text-center" id="char_class_race">Raça | Sub-Raça | Classe</p>
        <h4>Status</h4>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Pontos de Vida</b> <a class="pull-right" id="char_hp">20/20</a>
            </li>
            <li class="list-group-item">
                <b>Pontos de Mana</b> <a class="pull-right" id="char_mp">20/20</a>
            </li>
            <li class="list-group-item">
                <b>Classe de Armadura</b> <a class="pull-right" id="char_ca">10</a>
            </li>
        </ul>

        <h4>Atributos</h4>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Força</b> <a class="pull-right" id="char_force">20 | +1</a>
            </li>
            <li class="list-group-item">
                <b>Destreza</b> <a class="pull-right" id="char_skill">20 | +1</a>
            </li>
            <li class="list-group-item">
                <b>Constituição</b> <a class="pull-right" id="char_constitution">20 | +1</a>
            </li>
            <li class="list-group-item">
                <b>Sabedoria</b> <a class="pull-right" id="char_sapience">20 | +1</a>
            </li>
            <li class="list-group-item">
                <b>Carisma</b> <a class="pull-right" id="char_charisma">20 | +1</a>
            </li>
            <li class="list-group-item">
                <b>Inteligência</b> <a class="pull-right" id="char_intelligence">20 | +1</a>
            </li>
        </ul>
        <h4>Equipamentos</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="2">Nenhum Equipamento Selecionado</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4>Magias</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th colspan="2">Nenhum Equipamento Selecionado</th>
                </tr>
                </tbody>
            </table>
        </div>

        <a href="#" class="btn btn-primary btn-block"><b>Finalizar</b></a>
    </div>
    <!-- /.box-body -->
</div>