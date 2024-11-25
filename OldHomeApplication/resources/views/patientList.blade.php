<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Patient Info</title>
    </head>
    <style>
        .search{
            display: flex;
            flex-direction: column;
            padding: 40 0 40 0;
            margin: 0 150 0 150;
        }
        .search input{
            width: 89%;
            height: 30px;
        }
        .table{
        border-collapse: collapse;
        margin: 25px 0px;
        width: 780px;
        overflow: auto;
        max-height: 300px;
        margin-left: 200px;
        border: 5px solid blue;
        }
        td, th {
            padding: 12px 15px;
            border: solid 2px blue;
        }
        thead{
            background-color: blue;
        }

        tbody tr:hover{
            background-color: #ddd;
        }
        span{
            color: blue;
            padding: 10px;
        }
        .role{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: solid 5px black;
        }
    </style>
    <body>
        <div class="role">
            <p>Role: <span>Admin/Supervisor/Caregiver/Doctor</span></p>
            <p>Emp Id: <span>1</span></p>
            <p style="color: gray;">Fix when registration and login are implemented</p>
        </div>

        <div class="search">
            <form method="GET" action="{{ url('patient_info') }}">
                <p><b>Find Patient: </b><input name="search" type="text" placeholder="search by Attribute"><button type="submit">search</button></p>
            </form>
        </div>
        <div class="table">
            <table>
                <tr>
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>Date of Birth</th>
                        <th>Admission</th>
                        <th>Group #</th>
                        <th>Family Code</th>
                        <th>Emergency contact</th>
                        <th>Relation</th>
                    </thead>
                </tr>
                <tbody>
                    @foreach ($patients as $p)
                    <tr>
                        <td>{{$p->patient_id}}</td>
                        <td>{{$p->first_name}} {{ $p->last_name }}</td>
                        <td>{{$p->email}}</td>
                        <td>{{$p->phone}}</td>
                        <td>{{$p->dob}}</td>
                        <td>{{$p->admission_date}}</td>
                        <td>${{$p->group_number}}</td>
                        <td>{{$p->family_code}}</td>
                        <td>{{$p->emergency_contact}}</td>
                        <td>{{$p->relation_to_contact}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>