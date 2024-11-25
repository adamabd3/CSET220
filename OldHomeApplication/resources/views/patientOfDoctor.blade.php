<html>
    <head>
        <title>Patient of Doctor</title>
    </head>

    <body>
        <h1>Patient of Doctor:</h1>
        <h2>{{ $patient->first_name }}</h2>
        <p>{{ $currentDate }}</p>
        <h3>Prescription:</h3>
        <table>
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>Morning</th>
                    <th>Afternoon</th>
                    <th>Night</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meds as $med)
                    <tr>
                        <td>{{ $med->comment }}</td>
                        <td>{{ $med->med_morning ? 'Yes' : 'No' }}</td>
                        <td>{{ $med->med_afternoon ? 'Yes' : 'No' }}</td>
                        <td>{{ $med->med_night ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>New Prescription:</h3>
        <form action="">
            <label>Comment:</label>
            <input><br>
            <label>Morning Med:</label>
            <input><br>
            <label>Afternoon Med:</label>
            <input><br>
            <label>Night Med:</label>
            <input><br>
            <button>Submit</button>
            <button>Clear</button>
        </form>
    </body>
</html>