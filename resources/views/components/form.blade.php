<form action="{{ $action }}" id="{{ $id }}" enctype="multipart/form-data" method="{{ $method }}">
    @csrf
    @method($bajak)
    <?= $slot?>
</form>
