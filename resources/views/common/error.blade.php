@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            <h4>有错误发生:</h4>
            @foreach($errors->all() as $error)
                <li>
                    <i class="glyphicon glyphicon-remove"></i>{{ $error }}
                </li>
            @endforeach
        </ul>

    </div>
@endif