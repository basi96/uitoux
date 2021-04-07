<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <title>Students</title>

    </head>
    <body>

    <div class="container">  

        <div>
            
            <h1 style="text-align:center">Students List<h1>

        </div>         

        <table id="cart_container" class="table table-hover">
            <thead>
                <tr>
                    <th>S No</th>
                    <th>Name</th>
                    <th>Mark 1</th>
                    <th>Mark 2</th>
                    <th>Mark 3</th>
                    <th>Total</th>
                    <th>Rank</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($students))
                    @foreach ($students as $students)
                        <tr id="row_{{ $students->id }}">
                            <td>{{ $slNo++ }}</td>
                            <td id="studentName_{{ $students->id }}">{{ $students->student_name }}</td>
                            <td id="mark1_{{ $students->id }}">{{ $students->mark_1 }}</td>
                            <td id="mark2_{{ $students->id }}">{{ $students->mark_2 }}</td>
                            <td id="mark3_{{ $students->id }}">{{ $students->mark_3 }}</td>
                            <td>{{ $students->total }}</td>
                            <td>{{ $students->rank }}</td>
                            <td>
                                <button id="edit_{{ $students->id }}" class="edit" onclick="edit_row( {{ $students->id }} )"><span class="glyphicon glyphicon-pencil"></span></button>
                                <button id="save_{{ $students->id }}" style="display: none" onclick="update_row( {{ $students->id }} )"><span class="glyphicon glyphicon-ok"></span></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <button type="button" id="add" class="btn btn-primary" style="margin-left: 75vw;" onclick="add_row()">Add</button> 
    </div>
    
    </body>
</html>

<script>

    function add_row(no)
        {
            var str='<tr>';
            str+='<td></td>';
            str+='<td><input type="text" id="studentName_text" class="form-control"></td>';
            str+='<td><input type="number" id="mark1_text" class="form-control"></td>';
            str+='<td><input type="number" id="mark2_text" class="form-control"></td>';
            str+='<td><input type="number" id="mark3_text" class="form-control"></td>';
            str+='<td></td>';
            str+='<td></td>';
            str+='<td><button type="button" onclick="save_row()"><span class="glyphicon glyphicon-ok"></span></button></td>';
            str+='</tr>';

            $('#cart_container tr:last').after(str);
            $(".edit").attr("disabled", true);
            $("#add").attr("disabled", true);
        }

    function edit_row(no)
        {
            var studentName = $("#studentName_"+no+"").html();
            var mark1 = $("#mark1_"+no+"").html();
            var mark2 = $("#mark2_"+no+"").html();
            var mark3 = $("#mark3_"+no+"").html();

            $("#studentName_"+no+"").html("<input type='text' id='studentName_text_"+no+"' class='form-control' value='"+studentName+"'>");
            $("#mark1_"+no+"").html("<input type='number' id='mark1_text_"+no+"' class='form-control' value='"+mark1+"'>");
            $("#mark2_"+no+"").html("<input type='number' id='mark2_text_"+no+"' class='form-control' value='"+mark2+"'>");
            $("#mark3_"+no+"").html("<input type='number' id='mark3_text_"+no+"' class='form-control' value='"+mark3+"'>");
            $("#save_"+no+"").show();
            $("#edit_"+no+"").hide();
            $(".edit").attr("disabled", true);
            $("#add").attr("disabled", true);
        }

    function save_row()
        {
            var studentName = $("#studentName_text").val();
            var mark1 = $("#mark1_text").val();
            var mark2 = $("#mark2_text").val();
            var mark3 = $("#mark3_text").val();
            var error = 0;

            if(!studentName){
                error = 1;
            }
            if(!mark1){
                error = 1;
            }
            if(!mark2){
                error = 1;
            }
            if(!mark3){
                error = 1;
            }
            if(error != 1){
                $(document).ready(function(){
                $.ajax({
                    type: "POST",
                    url: "{{route('student.store')}}",
                    data:{	
                        "_token": "{{ csrf_token() }}",
                        "studentName":studentName,
                        "mark1":mark1,
                        "mark2":mark2,
                        "mark3":mark3
                    },
                    dataType: 'json',
                    success: function(data){
                        location.reload();
                    }
                    });   
                }); 
            }
            else{
                alert("Please enter values");
            }            
        }

    function update_row(no)
        {
            var studentName = $("#studentName_text_"+no+"").val();
            var mark1 = $("#mark1_text_"+no+"").val();
            var mark2 = $("#mark2_text_"+no+"").val();
            var mark3 = $("#mark3_text_"+no+"").val();
            var error = 0;

            if(!studentName){
                error = 1;
            }
            if(!mark1){
                error = 1;
            }
            if(!mark2){
                error = 1;
            }
            if(!mark3){
                error = 1;
            }
            if(error != 1){

                $(document).ready(function(){
                    $.ajax({
                        type: "POST",
                        url: "{{route('student.update')}}",
                        data:{	
                            "_token": "{{ csrf_token() }}",
                            "id":no,
                            "studentName":studentName,
                            "mark1":mark1,
                            "mark2":mark2,
                            "mark3":mark3
                        },
                        dataType: 'json',
                        success: function(data){
                            location.reload();
                        }
                    });   
                }); 
            }
            else{
                alert("Please enter values");
            }
        }

</script>