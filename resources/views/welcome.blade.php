@extends('layouts.app')

@section('content')
<h1>Updated User</h1>
    @foreach($returnedUser as $key => $value)
     <p>{{ $key . ' => ' . $value }}</p>
    @endforeach
@endsection
{{--{{ url('welcome') }}--}}

{{--<script type="text/javascript">
    $(document).ready(function() {
        var ul = $('<ul id="menuList"></ul>').appendTo('#peopleList');
        console.log(ul);
        $.ajax({
            method: "GET",
            url: 'people.php',
            dataType: 'json',
            success: function(data){
                var people = data;
                console.log(people);
                for (var i = 0; i < people.length; i++) {
                    var content = '<img src="' + people[i].image + '"> ' + people[i].name;
                    var li = $('<li/>').html(content).addClass("avatarPicture").appendTo(ul);
                }
            },
        });
        $('#peopleList').on('click', 'li', function(){
            var element = $(this).index();
            $.ajax({
                url: 'people.php',
                method: "POST",
                dataType: 'json',
                data: {selected: element },
                success: function(data){
                    var people = data;
                    $('#personDetails').html('');
                    var picture = '<img src="' + people.image + '">';
                    var image = $('<div id="detailImage"></div>').addClass('personDetails').html(picture).appendTo('#personDetails');
                    var name = $('<p>' + people.name + '</p>').appendTo('#personDetails');
                    var occupation = $('<p>' + people.occupation + '</p>').appendTo('#personDetails');
                    var birthDate = $('<p>' + people.birthDate + '</p>').appendTo('#personDetails');
                    var gender = $('<p>' + people.gender + '</p>').appendTo('#personDetails');
                }
            })
        });
    });
</script>--}}
