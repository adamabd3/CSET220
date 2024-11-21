<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
</head>
<style>
    .search{
        display: flex;
        flex-direction: column;
        padding: 40 0 40 0;
    }
    .table{
        border-collapse: collapse;
        margin: 25px 0;
        width: 780px;
        overflow: auto;
        max-height: 300px;
    }
    td, th {
        padding: 12px 15px;
    }
    thead{
        background-color: blue;
    }

    tbody tr{
        border-bottom: 100px solid lightgrey;
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
    }

    button{
        color: black;
    }
</style>
<body>
    <div class="role">
        
        <p>Role: <span>Admin</span></p><br><p style="color: gray;"> if role = supervisor only the table and search bar should be below this </p>

        <p>Employee Id: </p><input type="text" placeholder="EmployeeId" value="1"><p style="color: gray;">default value is 1 it should be the employee id</p>

        <p>Employee Current salary: <span>$100,000</span>
        <input type="text" placeholder="new salary"><p style="color: gray;">"Employee" should be name of the actual employee</p>
        </p><br>

        <button type="submit">Enter</button>
        <br>

        <button type="submit">Cancel</button>

    </div>

    <div class="search">
        <input type="search" placeholder="search">
    </div>
    <p style="color: gray;">Fake data \/</p>
    <div class="table">
        <table>

            <tr>
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Salary</th>
                    <th>Email</th>
                    <th>Phone#</th>
                    <th>Date of birth</th>
                </thead>
            </tr>
            <tbody>
                @foreach ($employee as $e)
                <tr>
                    <td>{{$e->employee_id}}</td>
                    <td>{{$e->first_name}}</td>
                    <td>{{$e->role}}</td>
                    <td>${{$e->salary}}</td>
                    <td>{{$e->email}}</td>
                    <td>{{$e->phone}}</td>
                    <td>{{$e->dob}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- @foreach ($employee as $e)
    <li>{{$e->employee_id}}</li>
    @endforeach -->
</body>
</html>