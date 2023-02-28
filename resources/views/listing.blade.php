<h1>{{$heading}}</h1>
<br>

@foreach ($job_list as $collection)
    <p><b>Title: </b>{{$collection['title']}}</p>
    <p><b>Discription: </b>{{$collection['discription']}}</p>
@endforeach