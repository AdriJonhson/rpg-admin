<form action="" method="POST" data-toggle="validator">
    @csrf
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
                {{--src="https://i.imgur.com/dGo8DOk.png"--}}
                <input type="file" class="user dropify"
                       data-default-file="https://i.imgur.com/dGo8DOk.png"
                       data-height="200">
            </div>
        </div>
    </div>
    <div id="form-step-0" role="form" data-toggle="validator">
        <div class="form-group">
            <label for="name" class="col-sm-2">Nome do Personagem</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Nome do seu personagem para essa aventura" required>
            </div>
        </div>
        <br><br><br>

        <div class="form-group">
            <label for="race" class="col-sm-2">Raça</label>
            <div class="col-sm-10">
                <select name="race" id="race" class="form-control" required>
                    <option value="" selected disabled>Raça do seu personagem</option>
                    @foreach($races as $race)
                        <option value="{{$race}}">{{$race}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br><br>

        <div class="form-group">
            <label for="race" class="col-sm-2">Sub-Raça</label>
            <div class="col-sm-10">
                <select name="sub-race" id="sub-race" class="form-control" disabled required>
                    <option value="" selected disabled>Selecione primeiramente uma raça</option>
                </select>
            </div>
        </div>
        <br><br>

        <div class="form-group">
            <label for="race" class="col-sm-2">Classe</label>
            <div class="col-sm-10">
                <select name="class" id="class" class="form-control" required>
                    <option value="" selected disabled>Selecione a classe do seu personagem</option>
                    @foreach($classes as $class)
                        <option value="{{$class}}">{{$class}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br><br>

        <div class="form-group">
            <label for="personalidade" class="col-sm-2">Personalidade</label>
            <div class="col-sm-10">
                <textarea name="personalidade" id="personalidade" cols="30" rows="10" class="form-control" placeholder="Personalidade" required></textarea>
            </div>
        </div>
        <br><br>
    </div>