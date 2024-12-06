<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
</head>
<style>
    .search input, .search button{
        padding: 10 0 10 0;
        width: 300px;
    }
    .search form{
        flex-direction: column;
        display: flex;
        align-items: center;
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
            <form method="GET" action="{{ url('employee_info') }}">
                <p><b>Find Employee: </b></p>
                <input name="Esearch" type="number" placeholder="By employee Id" min='1000' max='1099'>
                <input name="Nsearch" type="search" placeholder="By name (first and/or last)">
                <input name="Ssearch" type="search" placeholder="By salary (will show all salaries higher than entered amount">
                <input name="Rsearch" type="search" placeholder="By role">
                <input name="EMsearch" type="email" placeholder="By email">
                <input name="Dsearch" type="date" placeholder="By DOB">
                <input name="Psearch" type="tel" placeholder="By phone #123-4567" pattern="[0-9]{3}-[0-9]{4}">
                <button type="submit">search</button>
            </form>
        </div>
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
                    <td>{{$e->first_name}} {{ $e->last_name }}</td>
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
</body>
</html>